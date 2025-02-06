<?php
App::uses('AppController', 'Controller');
/**
 * Deliverydetails Controller
 *
 * @property Deliverydetail $Deliverydetail
 * @property PaginatorComponent $Paginator
 */
class DeliverydetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Deliverydetail->recursive = 0;
		$this->set('deliverydetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Deliverydetail->exists($id)) {
			throw new NotFoundException(__('Invalid deliverydetail'));
		}
		$options = array('conditions' => array('Deliverydetail.' . $this->Deliverydetail->primaryKey => $id));
		$this->set('deliverydetail', $this->Deliverydetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Deliverydetail->create();
			if ($this->Deliverydetail->save($this->request->data)) {
				$this->Session->setFlash(__('The deliverydetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deliverydetail could not be saved. Please, try again.'));
			}
		}
		$measures = $this->Deliverydetail->Measure->find('list');
		$deliveries = $this->Deliverydetail->Delivery->find('list');
		$this->set(compact('measures', 'deliveries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Deliverydetail->exists($id)) {
			throw new NotFoundException(__('Invalid deliverydetail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Deliverydetail->save($this->request->data)) {
				$this->Session->setFlash(__('The deliverydetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deliverydetail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Deliverydetail.' . $this->Deliverydetail->primaryKey => $id));
			$this->request->data = $this->Deliverydetail->find('first', $options);
		}
		$measures = $this->Deliverydetail->Measure->find('list');
		$deliveries = $this->Deliverydetail->Delivery->find('list');
		$this->set(compact('measures', 'deliveries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Deliverydetail->id = $id;
		if (!$this->Deliverydetail->exists()) {
			throw new NotFoundException(__('Invalid deliverydetail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Deliverydetail->delete()) {
			$this->Session->setFlash(__('The deliverydetail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The deliverydetail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function report() {
		$this->loadmodel('Product');
		
			$this->loadmodel('User');
		$products=$this->Product->find('list',array('fields'=>array('id','name')));
		$users=$this->User->find('list',array('fields'=>array('id','name')));
		$this->set('products',$products);
		$this->set('users',$users);
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

				if($param_name == "frommonth" ){
					$frommonth=$value;
				}
				if($param_name == "tomonth" ){
					$tomonth=$value;
				}
				if(!in_array($param_name, array('page','sort','direction','limit'))){
					if($param_name == "frommonth" || $param_name == "tomonth"){
						if(!empty($tomonth)){
							$conditions['OR'] = array(
							   array("DATE_FORMAT(Delivery.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$tomonth ."'")
						    );
						}
						else{
							$conditions['OR'] = array(
								array("DATE_FORMAT(Delivery.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$frommonth ."'")
							);
						}
					}elseif($param_name =='productname') {
						 $conditions['Deliverydetail.product_id'] = $value;
					}elseif($param_name =='productname') {
						 $conditions['Requisition.user_id'] = $value;
					}else{
						 $conditions['Deliverydetail..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->Deliverydetail->recursive = 0;
		$this->paginate = array(
		        'fields'=>array(
		            'Deliverydetail.*',
		            'Delivery.*',
		            'Requisition.*',
		            'User.*',
		            'Productname.*'
		            
		           
		         ),
		         'joins'=>array(
		           array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.deliveries_id=Delivery.id'
					 ),
					 array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisition.id'
					 ),
					 array(
					   'table'=>'products',
					   'alias'=>'Productname',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.product_id=Productname.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'Requisition.user_id=User.id'
					 )
		         ),
				'limit' => 10,
				'conditions' => $conditions,
			);


		$this->set('deliveries', $this->paginate());
	}
}
