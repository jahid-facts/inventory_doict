<?php
App::uses('AppController', 'Controller');
/**
 * Requisitionreturns Controller
 *
 * @property Requisitionreturn $Requisitionreturn
 * @property PaginatorComponent $Paginator
 */
class RequisitionreturnsController extends AppController {

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
		$district_id=$this->Auth->user(['district_id']);

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
				if($param_name =='user_id') {
						 $conditions['Requisition.user_id'] = $value;
					}elseif($param_name =='returnNo') {
						 $conditions['Requisitionreturn.rrnumber'] = $value;
					}else{
						 $conditions['Requisitionreturn.'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->paginate = array( 
				'fields'=>array(
					 
					'Requisitionreturn.*',
					'Requisition.*',
					'User.name',
					'User.mobile',
					'User.email',
					
					),
				'joins'=>array(
					 
					 
					 array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisitionreturn.requisition_id'
					 ),

					 array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisition.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'User.id=Requisition.user_id'
					 )
					  
				),
 				
				'recursive'=>-1,
				'group'=>'Requisitionreturn.rrnumber',
				'conditions'=>array($conditions,'Requisitionreturn.district_id'=>$district_id),
							 
			);
		$this->set('returnviews', $this->paginate());
		 
 		$storekeeperuserindex = $this->User->find('list',array('fields'=>array('User.name'),'conditions'=>array('User.role_id'=>2,'User.district_id'=>$district_id),'recursive'=>-1)); 
		$requsers=$this->User->find('list',array('fields'=>array('id','name'),'order'=>'User.name ASC','conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id)));
         $this->set(compact('storekeeperuserindex','requsers'));

		 
		 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$district_id=$this->Auth->user(['district_id']);
		$this->loadModel('User');
		$ext="Requisitionreturn.rrnumber='".$id."'";
		 
		$returnviews=$this->Requisitionreturn->find('all',
			array(
				 
				'fields'=>array(
					'Products.*',
					'Requisitionreturn.*',
					'Requisition.*',
					'User.name',
					'User.mobile',
					'User.email',
					'Designation.name',
					'Department.name', 
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitionreturn.product_id=Products.id'
					 ),
					 
					 array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisitionreturn.requisition_id'
					 ),

					 array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisition.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'User.id=Requisition.user_id'
					 ),
					 array(
					   'table'=>'designations',
					   'alias'=>'Designation',
					   'type'=>'LEFT',
					   'conditions'=>'User.designation_id=Designation.id'
					),array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					)
					  
				),
 				'conditions'=>array($ext,'Requisitionreturn.district_id'=>$district_id),
				'recursive'=>-1,
				'group'=>'Requisitionreturn.id'
			)
		);
		$this->set(compact('returnviews')); 
		$storekeeperuserindexs = $this->User->find('list',array('fields'=>array('User.name'),'conditions'=>array('User.role_id'=>2,'User.district_id'=>$district_id),'recursive'=>-1));
		$this->set(compact('storekeeperuserindexs'));
 		

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) { 
			$this->Requisitionreturn->create();
			if ($this->Requisitionreturn->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been returned.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be returned. Please, try again.'));
			}
		}
		$products = $this->Requisitionreturn->Product->find('list');
		$measures = $this->Requisitionreturn->Measure->find('list');
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
		if (!$this->Requisitionreturn->exists($id)) {
			throw new NotFoundException(__('Invalid requisitionreturn'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Requisitionreturn->save($this->request->data)) {
				$this->Session->setFlash(__('The product return has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product return could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requisitionreturn.' . $this->Requisitionreturn->primaryKey => $id));
			$this->request->data = $this->Requisitionreturn->find('first', $options);
		}
		$products = $this->Requisitionreturn->Product->find('list');
		$measures = $this->Requisitionreturn->Measure->find('list');
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
		$this->Requisitionreturn->id = $id;
		if (!$this->Requisitionreturn->exists()) {
			throw new NotFoundException(__('Invalid requisitionreturn'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requisitionreturn->delete()) {
			$this->Session->setFlash(__('The requisitionreturn has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requisitionreturn could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
