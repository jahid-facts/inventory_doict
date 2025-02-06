<?php
App::uses('AppController', 'Controller');
/**
 * Requisitions Controller
 *
 * @property Requisition $Requisition
 * @property PaginatorComponent $Paginator
 */
class RequisitionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Email');

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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
	
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               if($role_id==1){
                   $ext="1=1 AND Requisition.status=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                    $ext="Requisition.status=2";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));             

	}
	
 public function requisitionreport() {
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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               
               
               if($role_id==1){
                   $ext="1=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                   $ext="Requisition.status=1";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name')));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));

                

	}
	
 

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $this->loadModel('Department');
        $this->loadModel('Designation');
		if (!$this->Requisition->exists($id)) {
			throw new NotFoundException(__('Invalid requisition'));
		}
		$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
		
		$requisitiondetails=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
					'Products.*',
					'Category.name',
					'SubCategory.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Products.id'
					 ),
					array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
						),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 )
				),
			)
		);
		 

		 $this->request->data['Requisition']['requisitionno']=rand(99999,11111);

        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
        
        //                echo p($departments);
		// die();
 		$this->set('requisition',$this->Requisition->find('first', $options));
 		$this->set(compact('departments','designations'));
		$this->set('requisitiondetails',$requisitiondetails);


	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Measure');
		$this->loadModel('Product');
		if ($this->request->is('post')) {

			$reqSendId=$this->request->data['Requisition']['id'];
 				
 			$this->sendMailAdmin($reqSendId);
 				
			$this->Requisition->create();
			$this->request->data['Requisition']['user_id']=$this->Auth->user('id');
			$this->request->data['Requisition']['requisitionno']=rand(99999,11111);
			
			$detail=$this->request->data['Requisitiondetail'];
			
			foreach($detail as $key=>$details){
				unset($this->request->data['Requisitiondetail'][$key]['valid']);
				unset($this->request->data['Requisitiondetail'][$key]['purposeothers']);
				
				if($details['purpose']==5){
					unset($this->request->data['Requisitiondetail'][$key]['purpose']);
					$this->request->data['Requisitiondetail'][$key]['purpose']=$details['purposeothers'];
				}else{
					$this->request->data['Requisitiondetail'][$key]['product_id']=$details['product_id'];
					$this->request->data['Requisitiondetail'][$key]['quantity']=$details['quantity'];
					$this->request->data['Requisitiondetail'][$key]['measure_id']=$details['measure_id'];
				}
				
			}

			if ($this->Requisition->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The requisition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisition could not be saved. Please, try again.'));
			}
		}
		$users = $this->Requisition->User->find('list');
		$measures = $this->Measure->find('list');
		$products = $this->Product->find('list');
		$this->set(compact('users','measures','products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		if (!$this->Requisition->exists($id)) {
			throw new NotFoundException(__('Invalid requisition'));
		}



		if ($this->request->is(array('post', 'put'))) {
                $this->request->data['Requisition']['status']=2;
                         
                $this->request->data['Requisition']['dateupdate']=date('Y-m-d H:i:s');
            
                        
			if ($this->Requisition->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The requisition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
			$this->request->data = $this->Requisition->find('first', $options);
		}
                $this->loadModel('Measure');
		        $this->loadModel('Product');
                $this->loadModel('Department');
                $this->loadModel('Designation');
                

           $measures = $this->Measure->find('list');
           $products=$this->Product->find('list',array('fields'=>array('id','name')));
           $departments=$this->Department->find('list',array('fields'=>array('id','name')));
           $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 
	
       $this->set(compact('measures','products','departments','designations'));
               
	}

	public function getreject(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
		 	$id=$_REQUEST['id'];
		 	
		 		$sql="UPDATE requisitions SET status=3 WHERE id='$id'";
		 		$this->Requisition->query($sql);
		 }
		
	}

	public function getapprove(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
		 	$id=$_REQUEST['id'];
				$date=date('Y-m-d H:i:s');
		 		$sql="UPDATE `requisitions` SET `status` ='2' WHERE `requisitions`.`id` = $id";
		 		$this->Requisition->query($sql);
		 		$sql1="UPDATE `requisitions` SET `dateupdate` = '$date' WHERE `requisitions`.`id` = $id";
		 		$this->Requisition->query($sql1);

		 		$this->sendMail($id);
		 		$this->sendMailStorekeeper($id);
		 
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
		$this->Requisition->id = $id;
		if (!$this->Requisition->exists()) {
			throw new NotFoundException(__('Invalid requisition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requisition->delete()) {
			$this->Session->setFlash(__('The requisition has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requisition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
 

	public function delivery($id = null) {
		if (!$this->Requisition->exists($id)) {
			throw new NotFoundException(__('Invalid requisition'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->loadModel('Delivery');

            $this->Requisition->query("UPDATE requisitions SET status=4 WHERE id='$id'");
			$this->request->data['Delivery']['user_id']=$this->Auth->user('id');
            $this->request->data['Delivery']['orderid']=$this->Auth->user('id'); 

			if ($this->Delivery->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The delivery has been saved.'));
				return $this->redirect(array('controller'=>'deliveries','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery could not be saved. Please, try again.'));
			}  
		}else {
			$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
			$this->request->data = $this->Requisition->find('first', $options);
		}
                $this->loadModel('Measure');
                $this->loadModel('Product');
                $this->loadModel('Department');
                $this->loadModel('Designation');
                
                $requisitiondetails=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
	 				 

					'Products.*',
					'Category.name',
					'SubCategory.name',
					) ,

				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Products.id'
					 ),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 ),
					 array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
						),
				),
			)
		);

		$this->set('stocks',$requisitiondetails);
		
             
            $measures = $this->Measure->find('list');
            $products=$this->Product->find('list',array('fields'=>array('id','name')));
            $departments=$this->Department->find('list',array('fields'=>array('id','name')));
            $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 
            $this->set(compact('measures','products','departments','designations'));
		   
	}
        public function dashboard() {
          
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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
	
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               
               
               if($role_id==1){
                   $ext="1=1 AND Requisition.status=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                   $ext="Requisition.status=2";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));

                

	}
	
        public function dashboardstorekeeper() {
          
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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
	
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               
               
               if($role_id==1){
                   $ext="1=1 AND Requisition.status=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                   $ext="Requisition.status=2";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));

                

	}


	private function sendMailAdmin($id) {
		$this->loadModel('Requisition');
		$this->loadModel('Requisitiondetail');
		$this->loadModel('Department');
        $this->loadModel('Designation');

		$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
		
		$requisitiondetails=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
					'Products.*',
					'Category.name',
					'SubCategory.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Products.id'
					 ),
					array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
						),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 )
				),
			)
		);
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 		
   


		$this->Email->smtpOptions = array(
            'host' => 'mail.ipsitasoft.com',
			'port' => '25',
			'username' => 'institution@ipsitasoft.com',
    		'password' => 'S}*fi[y;%ov2'
           );
	   
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
       
    	$this->Email->from     = 'institution@ipsitasoft.com';
   		$this->Email->to       = "mansuranishu2@gmail.com";
   	   	$this->Email->cc       = array('monir.cyber@gmail.com');
   		$this->Email->subject ='Requisition Submitted';
		$this->Email->template ='admin';
		$this->Email->sendAs = 'html';
	
		$this->set('requisition',$this->Requisition->find('first', $options));
		$this->set('departments',$departments);
		$this->set('designations',$designations);
		$this->set('requisitiondetails',$requisitiondetails);

		

		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
	}


	private function sendMail($id) {
		$this->loadModel('Requisition');
		$this->loadModel('Requisitiondetail');
		$this->loadModel('Department');
        $this->loadModel('Designation');

		$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
		
		$requisitiondetails=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
					'Products.*',
					'Category.name',
					'SubCategory.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Products.id'
					 ),
					array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
						),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 )
				),
			)
		);
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 		
   


		$this->Email->smtpOptions = array(
            'host' => 'mail.ipsitasoft.com',
			'port' => '25',
			'username' => 'institution@ipsitasoft.com',
    		'password' => 'S}*fi[y;%ov2'
           );
	   
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
       
    	$this->Email->from     = 'institution@ipsitasoft.com';
   		$this->Email->to       = $requisition['User']['email'];
   	   	$this->Email->cc       = array('monir.cyber@gmail.com');
   		$this->Email->subject ='Requisition Approved';
		$this->Email->template ='requisitoner';
		$this->Email->sendAs = 'html';
	
		$this->set('requisition',$this->Requisition->find('first', $options));
		$this->set('departments',$departments);
		$this->set('designations',$designations);
		$this->set('requisitiondetails',$requisitiondetails);

		

		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
	}


	private function sendMailStorekeeper($id) {
		$this->loadModel('Requisition');
		$this->loadModel('Requisitiondetail');
		$this->loadModel('Department');
        $this->loadModel('Designation');

		$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
		
		$requisitiondetails=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
					'Products.*',
					'Category.name',
					'SubCategory.name',
					),
				'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Products',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Products.id'
					 ),
					array(
					   'table'=>'categories',
					   'alias'=>'SubCategory',
					   'type'=>'LEFT',
					   'conditions'=>'Product.pcid=SubCategory.id'
						),
					 array(
					   'table'=>'categories',
					   'alias'=>'Category',
					   'type'=>'LEFT',
					   'conditions'=>'Products.category_id=Category.id'
					 )
				),
			)
		);
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 		
   


		$this->Email->smtpOptions = array(
            'host' => 'mail.ipsitasoft.com',
			'port' => '25',
			'username' => 'institution@ipsitasoft.com',
    		'password' => 'S}*fi[y;%ov2'
           );
	   
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
       
    	$this->Email->from     = 'institution@ipsitasoft.com';
   		$this->Email->to       = "mansuranishu2@gmail.com";
   	   	$this->Email->cc       = array('monir.cyber@gmail.com');
   		$this->Email->subject ='Request For Delivery';
		$this->Email->template ='storekeeper';
		$this->Email->sendAs = 'html';
	
		$this->set('requisition',$this->Requisition->find('first', $options));
		$this->set('departments',$departments);
		$this->set('designations',$designations);
		$this->set('requisitiondetails',$requisitiondetails);

		

		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
	}
        
    public function requisitionapprove(){
        {
          
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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
	
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               if($role_id==1){
                   $ext="1=1 AND Requisition.status=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                    $ext="Requisition.status=2";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));             

	}
    }
    
    public function requisitionreject(){
        {
          
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
						 $conditions['Requisition..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
	
		$this->loadModel('User');
		$this->Requisition->recursive = 1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
               $role_id= $this->Auth->user('role_id');
               $id= $this->Auth->user('id');
               if($role_id==1){
                   $ext="1=1 AND Requisition.status=1"; 
               }elseif($role_id==3){
                     $ext="Requisition.user_id='".$id."'";
               }else{
                    $ext="Requisition.status=2";
               }
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3)));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate(array($ext)));
	    //$this->set('requisitions', $this->Paginator->paginate(array($ext)));             

	}
    }

}
