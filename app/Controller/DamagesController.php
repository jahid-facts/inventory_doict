<?php
App::uses('AppController', 'Controller');
/**
 * Damages Controller
 *
 * @property Damage $Damage
 * @property PaginatorComponent $Paginator
 */
class DamagesController extends AppController {

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
	public function index($type=null) {
		$distid=$this->Auth->user(); 
		$authdis=$distid['district_id'];
		$this->loadModel('User');   
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
				if($param_name =='dnumber') {
						 $conditions['Damage.dnumber'] = $value;
					}elseif($param_name =='approvedrefNo') {
						 $conditions['Damage.rnumber'] = $value;
					}else{
						 $conditions['Damage.'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}

		//$conditions['Damage.type']=$type;
		$this->Damage->recursive = 0;
		$this->paginate = array('limit' => 15,'conditions'=>array($conditions,'Damage.district_id'=>$authdis));
		$this->set('damages', $this->paginate());
			 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) { 
		$ext="Damage.dnumber='".$id."'";
		$damagedetail=$this->Damage->find('all',array(
			'fields'=>array(
			'Product.finalcode',
			'Product.name',
			'Damage.quantity',
			'Damage.type',
			'Damage.dnumber',
			'Damage.rnumber',
			'Damage.ddate',
			'Damage.ext',
			'Damage.appBye',
			'Damage.adjBye',
			'Measure.name',
			),
			'joins'=>array(
				array(
				   'table'=>'products',
				   'alias'=>'Product',
				   'type'=>'LEFT',
				   'conditions'=>'Damage.product_id=Product.id'
				 ),
				array(
				   'table'=>'measures',
				   'alias'=>'Measure',
				   'type'=>'LEFT',
				   'conditions'=>'Damage.measure_id=Measure.id'
				 )
				 
			),
			 'conditions'=>array(
				$ext
			),
			'recursive'=>-1,
			'group'=>'Damage.id'
    	)); 
		$this->set('damagedetails',$damagedetail); 	
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Damage->create();
			if ($this->Damage->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been adjusted.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be adjusted. Please, try again.'));
			}
		}
		$products = $this->Damage->Product->find('list');
		$measures = $this->Damage->Measure->find('list');
		$this->set(compact('products', 'measures'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Damage->exists($id)) {
			throw new NotFoundException(__('Invalid damage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Damage->save($this->request->data)) {
				$this->Session->setFlash(__('The damage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The damage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Damage.' . $this->Damage->primaryKey => $id));
			$this->request->data = $this->Damage->find('first', $options);
		}
		$products = $this->Damage->Product->find('list');
		$measures = $this->Damage->Measure->find('list');
		$this->set(compact('products', 'measures'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Damage->id = $id;
		if (!$this->Damage->exists()) {
			throw new NotFoundException(__('Invalid damage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Damage->delete()) {
			$this->Session->setFlash(__('The damage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The damage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
