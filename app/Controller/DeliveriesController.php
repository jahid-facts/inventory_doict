<?php
App::uses('AppController', 'Controller');
/**
 * Deliveries Controller
 *
 * @property Delivery $Delivery
 * @property PaginatorComponent $Paginator
 */
class DeliveriesController extends AppController {

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
	    $this->loadmodel('User');
	    $this->Delivery->order = "Delivery.id DESC";

	    $allusers=$this->User->find('list',array('fields'=>array('id','name'),'recursive'=>-1,'conditions'=>array('User.district_id'=>$district_id)));
	    $this->set(compact('allusers'));

	  	$users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC')); 
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
					}elseif($param_name =='user_id') {
						 $conditions['Requisition.user_id'] = $value;
					}elseif($param_name =='supplier_id') {
						 $conditions['Delivery.user_id'] = $value;
					}elseif($param_name =='deliveryNo') {
						 $conditions['Delivery.orderid'] = $value;
					}elseif($param_name =='requisitionNo') {
						 $conditions['Requisition.requisitionNo'] = $value;
					}else{
						 $conditions['Delivery..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
        $this->Delivery->recursive = 0; 
        $role_id= $this->Auth->user('role_id'); 
        $this->paginate = array('limit' => 15,'conditions' =>array($conditions,'Delivery.district_id'=>$district_id));  
        $this->set('deliveries', $this->paginate());
	}

	public function returnrequisition() {
		$district_id=$this->Auth->user(['district_id']);
	    $this->loadmodel('User');
	    $this->Delivery->order = "Delivery.id DESC";

	    $allusers=$this->User->find('list',array('fields'=>array('id','name'),'recursive'=>-1,'conditions'=>array('User.district_id'=>$district_id)));
	    $this->set(compact('allusers'));

	  	$users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC')); 
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
				if($param_name =='user_id') {
						 $conditions['Requisition.user_id'] = $value;
					}elseif($param_name =='requisitionNo') {

						$ext="Requisition.requisitionNo='" .$value."' OR Delivery.orderid='" .$value ."'";

						 $conditions['OR'] = array(
							   array($ext)
						    );
					}else{
						 $conditions['Delivery.'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
            $this->Delivery->recursive = 0;

            $role_id= $this->Auth->user('role_id');
	

             $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
            //$this->set('deliveries', $this->Paginator->paginate());
             
        $this->set('deliveries', $this->paginate());
	}
	
  public function report() {
  	$this->loadmodel('User');
  	$users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
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
					}elseif($param_name =='user_id') {
						 $conditions['Requisition.user_id'] = $value;
					}else{
						 $conditions['Delivery..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->Delivery->recursive = 2;
		$this->paginate = array(
				'limit' => 10,
		        'conditions'=>$conditions,
			);
		$this->set('deliveries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Delivery->exists($id)) {
			throw new NotFoundException(__('Invalid delivery'));
		}
		$options = array('conditions' => array('Delivery.' . $this->Delivery->primaryKey => $id));
		$this->set('delivery', $this->Delivery->find('first', $options));
	}

	public function proreturn($id = null) {
		$district_id=$this->Auth->user(['district_id']);

       	$this->loadModel('Measure');
        $this->loadModel('Product');
        $this->loadModel('Department');
        $this->loadModel('Designation');
        $this->loadModel('Requisition');
        $this->loadModel('User'); 

		if ($this->request->is('post')) {  
			$this->loadModel('Requisitionreturn');
			$data=$this->request->data['Requisitionreturn'];
			$bool=false;

			$rrnumber=$this->request->data['Requisition']['dnumber'];
			unset($this->request->data['Requisition']['dnumber']);
			foreach($data as $datas){ 
				if($datas['quantity']>0){
					$datas['rrnumber']=$rrnumber;
					$datas['ddate']=date('Y-m-d');
					$datas['user_id']=$this->Auth->user('id'); 
					$this->Requisitionreturn->create();
					if($this->Requisitionreturn->save($datas)){
						$bool=true;
					}
				} 
			} 
			if($bool){
	
				$this->Session->setFlash(__('The product has been returned.'));
				return $this->redirect(array('controller'=>'requisitionreturns','action' => 'view',$rrnumber,'success'));
			}else{
				$this->Session->setFlash(__('The product return could not be returned. Please, try again.'));
			} 
			
		}

	 	$deliveryviews=$this->Delivery->Deliverydetail->find('all',
			array(
				'conditions'=>array(
				'Deliverydetail.deliveries_id'=>$id,
				'Deliverydetail.district_id'=>$district_id
				),
				'fields'=>array(
	 				'Deliverydetail.*',
					'Products.*',
					'Delivery.*',
					'Deliveryuser.name',
					'Requisition.*',
					'User.name',
					'User.mobile',
					'User.email',
					'Designation.name',
					'Department.name',
					'Category.name',
					'SubCategory.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.product_id=Products.id'
					 ),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 ),
					 array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.deliveries_id=Delivery.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'Deliveryuser',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.user_id=Deliveryuser.id'
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
					   'conditions'=>'Requisition.user_id=User.id'
					), 
					 array(
					   'table'=>'designations',
					   'alias'=>'Designation',
					   'type'=>'LEFT',
					   'conditions'=>'User.designation_id=Designation.id'
					),
					 array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					),
					 array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
					)
				),
			)
		);

       	$measures = $this->Measure->find('list');
       	$products=$this->Product->find('list',array('fields'=>array('id','name')));
       	$departments=$this->Department->find('list',array('fields'=>array('id','name')));
       	$designations=$this->Designation->find('list',array('fields'=>array('id','name')));
       	$users=$this->User->find('list',array('fields'=>array('id','name'),'User.district_id'=>$district_id)); 
       	$this->set(compact('measures','products','departments','designations','deliveryviews','users'));  
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$district_id=$this->Auth->user(['district_id']);

		if (!empty($this->request->data)) { 
			$reqId=$this->request->data['Delivery']['requisitionId']; 

            $this->request->data['Delivery']['user_id']=$this->Auth->user('id');
            $this->request->data['Delivery']['created']=date('Y-m-d');
            $delivery=$this->Delivery->find('first', array('order'=>'orderid DESC','recursive'=>-1));
            $rno=0; 

			if(!empty($delivery['Delivery']['orderid'])){
				$rno=$delivery['Delivery']['orderid']+1;
			}else{
				$rno=10000000001;
			} 
			$id=$this->request->data['Delivery']['requisition_id']; 
			$sql="UPDATE requisitions SET status=4 WHERE id='$id'";
			
            $this->Delivery->query( $sql); 

			$this->request->data['Delivery']['orderid']=$rno;
			$this->request->data['Delivery']['district_id']=$district_id; 
			$ddetails=$this->request->data['Deliverydetail'];

            foreach($ddetails as $key=>$ddetail){   
            	$this->request->data['Deliverydetail'][$key]['district_id']=$district_id;
            	$this->request->data['Deliverydetail'][$key]['ddate']=date('Y-m-d');
            	$reqId=$this->request->data['Deliverydetail'][$key]['r_id']; 

            	$this->Delivery->query("UPDATE requisitiondetails SET status=4 WHERE id=$reqId");
            	unset($this->request->data['Deliverydetail'][$key]['r_id']); 
            } 
            unset($this->request->data['Delivery']['requisitionId']);

			$this->Delivery->create();
			if ($this->Delivery->saveAssociated($this->request->data)) { 
				$id = $this->Delivery->getInsertID ();
				$this->Session->setFlash(__('The delivery has been successfully completed.')); 
				return $this->redirect(array('controller'=>'deliveries','action' => 'deliveryview',$id,'deliver'));
			} else {
				$this->Session->setFlash(__('The delivery could not be saved. Please, try again.'));
			}
		}
		$users = $this->Delivery->User->find('list'); 
		$this->loadModel('Product');
		$products = $this->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Delivery->exists($id)) {
			throw new NotFoundException(__('Invalid delivery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Delivery->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Delivery.' . $this->Delivery->primaryKey => $id));
			$this->request->data = $this->Delivery->find('first', $options);
		}
		$users = $this->Delivery->User->find('list');
		$products = $this->Delivery->Product->find('list');
		$this->set(compact('users', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Delivery->id = $id;
		if (!$this->Delivery->exists()) {
			throw new NotFoundException(__('Invalid delivery'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Delivery->delete()) {
			$this->Session->setFlash(__('The delivery has been deleted.'));
		} else {
			$this->Session->setFlash(__('The delivery could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
	public function deliveryview($id = null) { 
		$district_id=$this->Auth->user(['district_id']);
        $this->loadModel('Measure');
        $this->loadModel('Product');
        $this->loadModel('Department');
        $this->loadModel('Designation');
        $this->loadModel('Requisition');
        $this->loadModel('User');					 
		$deliveryviews=$this->Delivery->Deliverydetail->find('all',
			array(
				'conditions'=>array(
				'Deliverydetail.deliveries_id'=>$id,
				'Deliverydetail.district_id'=>$district_id
				),
				'fields'=>array(
	 				'Deliverydetail.*',
					'Products.*',
					'Delivery.*',
					'Deliveryuser.name',
					'Requisition.*',
					'User.name',
					'User.mobile',
					'User.email',
					'Designation.name',
					'Department.name',
					'Category.name',
					'SubCategory.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.product_id=Products.id'
					 ),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 ),
					 array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.deliveries_id=Delivery.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'Deliveryuser',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.user_id=Deliveryuser.id'
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
					   'conditions'=>'Requisition.user_id=User.id'
					), 
					 array(
					   'table'=>'designations',
					   'alias'=>'Designation',
					   'type'=>'LEFT',
					   'conditions'=>'User.designation_id=Designation.id'
					),
					 array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					),
					 array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
					),array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
					),
				),
			)
		);
 				    
       $measures = $this->Measure->find('list');
       $products=$this->Product->find('list',array('fields'=>array('id','name')));
       $departments=$this->Department->find('list',array('fields'=>array('id','name')));
       $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
       $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.district_id'=>$district_id)));
 
       	$this->set(compact('measures','products','departments','designations','deliveryviews','users'));   
	}

	public function centralview($id = null,$iduser=null,$iddist=null) {  
        $this->loadModel('Measure');
        $this->loadModel('Product');
        $this->loadModel('Department');
        $this->loadModel('Designation');
        $this->loadModel('Requisition');
        $this->loadModel('User');					 
		$deliveryviews=$this->Delivery->Deliverydetail->find('all',
			array(
				'conditions'=>array(
				'Deliverydetail.deliveries_id'=>$id,
				'Deliverydetail.district_id'=>$iddist
				),
				'fields'=>array(
	 				'Deliverydetail.*',
					'Products.*',
					'Delivery.*',
					'Deliveryuser.name',
					'Requisition.*',
					'User.name',
					'User.mobile',
					'User.email',
					'Designation.name',
					'Department.name',
					'Category.name',
					'SubCategory.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.product_id=Products.id'
					 ),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 ),
					 array(
					   'table'=>'deliveries',
					   'alias'=>'Delivery',
					   'type'=>'LEFT',
					   'conditions'=>'Deliverydetail.deliveries_id=Delivery.id'
					 ),
					 array(
					   'table'=>'users',
					   'alias'=>'Deliveryuser',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.user_id=Deliveryuser.id'
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
					   'conditions'=>'Requisition.user_id=User.id'
					), 
					 array(
					   'table'=>'designations',
					   'alias'=>'Designation',
					   'type'=>'LEFT',
					   'conditions'=>'User.designation_id=Designation.id'
					),
					 array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					),
					 array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
					),array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
					),
				),
			)
		);
 				    
       $measures = $this->Measure->find('list');
       $products=$this->Product->find('list',array('fields'=>array('id','name')));
       $departments=$this->Department->find('list',array('fields'=>array('id','name')));
       $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
       $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.district_id'=>$iddist))); 
 
       	$this->set(compact('measures','products','departments','designations','deliveryviews','users','iduser','iddist'));   
	}
	

}
