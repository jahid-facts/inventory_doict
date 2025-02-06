<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Email');
	
public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow ('add','viewprint');
	
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
	$conditions = array();
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['Report'])){
			$filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
			$filter_url['page'] = 1;
			foreach($this->request->data['Report'] as $name => $value){
				if($value){
					//$filter_url[$name] = urlencode($value);
					$filter_url[$name] = trim($value);
				}
			}	
			return $this->redirect($filter_url);
		} else {
			foreach($this->params['named'] as $param_name => $value){
				if(!in_array($param_name, array('page','sort','direction','limit'))){
					if($param_name == "created"){
						$conditions['OR'] = array(
							array("DATE_FORMAT(Order.created,'%Y-%m-%d')='".trim($value)."'")
						);
					} else {
						 $conditions['Order.'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$date=date('Y-m-d');
		$this->Order->recursive = 0;
		if(empty($this->request->data['Report'])){
			$conditions['DATE_FORMAT(Order.created,"%Y-%m-%d")']=$date;
		}
		$this->paginate = array(
			'limit' => 20,
			'conditions' => $conditions,
		'order' =>'Order.id DESC'
		);
		$this->set('orders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		$this->set('order', $this->Order->find('all',array('conditions' => array('Order.id'=> $id),'recursive'=>2)));
		
	}
	   public function viewprint($id = null) {
   	
   	   $this->layout="public";
 		 
		$this->loadModel('Product');
		  
if(!empty($_REQUEST['product_id'])){
			$product_id = $this->Session->read('Id');
			if(empty($product_id)){
				$this->Session->write('Id',array());
			}
			$product = $this->Session->read('Id');
			
			$product[$_REQUEST['product_id']] = $_REQUEST['product_id'];
			$this->Session->write('Id',$product);
			$product_id=$this->Session->read('Id');
			foreach($product_id as $p_id){
				$product_data[] = $this->Product->find('all',array('fields'=>array('Product.*','Category.name'),'conditions'=>array('Product.id'=>$p_id),'recursive'=>0));
			}
			$this->set('itemcart', sizeof($product_data));
			$this->set('product_data', $product_data);

		}
		$this->set(compact('badgessliders','badgesliders','eproducts','eproductscat')); 		$this->set('order', $this->Order->find('all',array('conditions' => array('Order.id'=> $id),'recursive'=>2)));
		
	}
	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			unset($this->request->data['Orderdetail']['total_pro_price']);
			unset($this->request->data['Orderdetail']['gptotal_mat_price']);
			
			$fromemail=$this->request->data['Order']['email'];
			
			/*echo"<pre>";
			print_r($this->request->data);
			echo"</pre>";
			die();*/
			 
			$this->Order->create();
			if ($this->Order->saveAssociated($this->request->data)) {
					$id= $this->Order->getInsertID();
				$this->Session->setFlash(__('The order has been saved.'));
				
				$this->sendMail($this->request->data,"order",$fromemail);
				
				return $this->redirect(array('controller'=>'orders','action' =>'viewprint',$id));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		}
	}
	
	private function sendMail($data,$template,$fromemail) {
		$this->loadModel('Setting');
		$datas = $this->Setting->find('first');
		$this->loadModel('Product');
		$list = $this->Product->find('list');
		
		/*$this->Email->smtpOptions = array(
                'host' => 'exceptionalmind.org',
				'port' => '25',
				'username' => 'monir@exceptionalmind.org',
    			'password' => 'dev420'
           ); */
 
 		$this->Email->from     = $fromemail;
   		$this->Email->to       = $datas['Setting']['adminEmail'];
   		//$this->Email->cc = array('monir.cyber@gmail.com','atique.siddique1@gmail.com');
   		$this->Email->bcc = array('monir.cyber@gmail.com');
		$this->Email->subject = $data['Order']['address'];
		$this->Email->template = $template;
		$this->Email->sendAs = 'html';
		$this->set('data',$data);
		$this->set('list',$list);
		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
		
		
	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				//$this->Flash->success(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Order->delete()) {
			//$this->Flash->success(__('The order has been deleted.'));
		} else {
			$this->Flash->error(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
