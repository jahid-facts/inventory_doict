<?php
App::uses('AppController', 'Controller');
/**
 * Requisitiondetails Controller
 *
 * @property Requisitiondetail $Requisitiondetail
 * @property PaginatorComponent $Paginator
 */
class RequisitiondetailsController extends AppController {

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
		$this->Requisitiondetail->recursive = 0;
		$this->set('requisitiondetails', $this->Paginator->paginate());
	}
	
   public function requisitionreport() {
   	$this->loadmodel('Product');
		$products=$this->Product->find('list',array('fields'=>array('id','name')));
		$this->set('products',$products);
   	$this->loadmodel('User');
 	$users=$this->User->find('list',array('fields'=>array('id','username')));
 	$this->set(compact('users'));
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
							   array("DATE_FORMAT(Requisition.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$tomonth ."'")
						    );
						}
						else{
							$conditions['OR'] = array(
								array("DATE_FORMAT(Requisition.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$frommonth ."'")
							);
						}
					}elseif($param_name =='productname') {
						 $conditions['Requisitiondetail.product_id'] = $value;
					}else{
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		
		$this->Requisitiondetail->recursive = 1;
		
        $this->paginate = array(
		        'fields'=>array(
		            'Requisitiondetail.*',
		            'Requisitionname.*',
		            'Productname.*',
		            'User.*'
		           
		         ),
		         'joins'=>array(
		           array(
					   'table'=>'requisitions',
					   'alias'=>'Requisitionname',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.requisition_id=Requisitionname.id'
					 ),
					 
					 array(
					   'table'=>'products',
					   'alias'=>'Productname',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Productname.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitionname.user_id=User.id'
					 )
		         ),
				'limit' => 10,
				'conditions' => $conditions,
			);      
       
		$this->set('requisitions', $this->paginate());
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));

                

	}


	public function requisitionreject(){  
		$this->loadmodel('User');    
		$district_id=$this->Auth->user(['district_id']); 
   		
 		$users=$this->User->find('list',array('fields'=>array('id','name'),'order'=>'User.name ASC','conditions'=>array('User.district_id'=>$district_id)));
 		$this->set(compact('users'));

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
							   array("DATE_FORMAT(Requisition.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$tomonth ."'")
						    );
						}
						else{
							$conditions['OR'] = array(
								array("DATE_FORMAT(Requisition.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$frommonth ."'")
							);
						}
					}elseif($param_name =='status') {
						 $conditions['Requisition.status'] = $value;
					}else{
						 $conditions['Requisition.'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		
		$this->Requisitiondetail->recursive = 1; 
		$id= $this->Auth->user('id');
		$role_id= $this->Auth->user('role_id');
		if($role_id==1 || $role_id==4){
			
		}else{
			$conditions['Requisition.user_id']=$id;
		}

		$conditions['Requisitiondetail.status']=3;
		
        $this->paginate = array(
		        'fields'=>array(
		            'Requisitiondetail.*',
		            'Requisitionname.*',
		            'Productname.*',
		            'User.*'
		           
		         ),
		         'joins'=>array(
		           array(
					   'table'=>'requisitions',
					   'alias'=>'Requisitionname',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.requisition_id=Requisitionname.id'
					 ),
					 
					 array(
					   'table'=>'products',
					   'alias'=>'Productname',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Productname.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitionname.user_id=User.id'
					 )
		         ),
				'limit' => 10,
				'conditions' => array($conditions,'Requisitiondetail.district_id'=>$district_id)
			);   
		$this->set('requisitions', $this->paginate()); 
		$measures = $this->Requisitiondetail->Measure->find('list');
		$this->set('measures',$measures); 
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Requisitiondetail->exists($id)) {
			throw new NotFoundException(__('Invalid requisitiondetail'));
		}
		$options = array('conditions' => array('Requisitiondetail.' . $this->Requisitiondetail->primaryKey => $id));
		$this->set('requisitiondetail', $this->Requisitiondetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Requisitiondetail->create();
			if ($this->Requisitiondetail->save($this->request->data)) {
				$this->Session->setFlash(__('The requisitiondetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisitiondetail could not be saved. Please, try again.'));
			}
		}

		$requisitions = $this->Requisitiondetail->Requisition->find('list');
		$measures = $this->Requisitiondetail->Measure->find('list');
		$products = $this->Requisitiondetail->Product->find('list');
		$this->set(compact('requisitions', 'measures','products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Requisitiondetail->exists($id)) {
			throw new NotFoundException(__('Invalid requisitiondetail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Requisitiondetail->save($this->request->data)) {
				$this->Session->setFlash(__('The requisitiondetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisitiondetail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requisitiondetail.' . $this->Requisitiondetail->primaryKey => $id));
			$this->request->data = $this->Requisitiondetail->find('first', $options);
		}
		$requisitions = $this->Requisitiondetail->Requisition->find('list');
		$measures = $this->Requisitiondetail->Measure->find('list');
		$products = $this->Requisitiondetail->Product->find('list');
		$this->set(compact('requisitions', 'measures','products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Requisitiondetail->id = $id;
		if (!$this->Requisitiondetail->exists()) {
			throw new NotFoundException(__('Invalid requisitiondetail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requisitiondetail->delete()) {
			$this->Session->setFlash(__('The requisitiondetail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requisitiondetail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
