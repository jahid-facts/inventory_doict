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
       	$district_id=$this->Auth->user(['district_id']); 

       	if($role_id==1 || $role_id==4){
           $ext="1=1"; 
       	}elseif($role_id==3){
             $ext="Requisition.user_id='".$id."'";
       	}else{
            $ext="Requisition.status=2";
       	}
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3),'order'=>'User.name ASC'));
     
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 15,'conditions' => array($conditions,'Requisition.district_id'=>$district_id)); 
		$this->set('requisitions', $this->paginate(array($ext)));            

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
        $users=$this->User->find('list',array('fields'=>array('id','name'),'order'=>'User.name ASC'));
     
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
        $this->loadModel('User');
        $this->loadModel('Designation');
        $district_id=$this->Auth->user(['district_id']);
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
					'Measures.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
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
					   'conditions'=>'Product.category_id=Category.id'
					 ),
					 array(
					   'table'=>'measures',
					   'alias'=>'Measures',
					   'type'=>'LEFT',
					   'conditions'=>'Product.measure_id=Measures.id'
					 ),
					 array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),
					array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),
					array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
					 ),
				),
			)
		);

		$users=$this->User->find('all',array( 
				'fields'=>array(
	 				'User.*',
					'Department.*',
					 
					),
				'joins'=>array(
					array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					 ),
				
				),
				'recursive'=>-1,
				'conditions'=>array('User.role_id'=>1,'User.district_id'=>$district_id)
			)
		); 
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 		$this->set('requisition',$this->Requisition->find('first', $options));
 		$this->set(compact('departments','designations','users'));
		$this->set('requisitiondetails',$requisitiondetails);
		 

	}

	public function viewr($id = null) {
        $this->loadModel('Department');
        $this->loadModel('User');
        $this->loadModel('Designation');
        $district_id=$this->Auth->user(['district_id']);

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
					'Measures.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
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
					   'conditions'=>'Product.category_id=Category.id'
					 ),
					 array(
					   'table'=>'measures',
					   'alias'=>'Measures',
					   'type'=>'LEFT',
					   'conditions'=>'Product.measure_id=Measures.id'
					 ),
					 array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),
					array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),
					array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
					 ),
				),
			)
		);

		 $users=$this->User->find('all',array(
				 
				'fields'=>array(
	 				'User.*',
					'Department.*',
					 
					),
				'joins'=>array(
					array(
					   'table'=>'departments',
					   'alias'=>'Department',
					   'type'=>'LEFT',
					   'conditions'=>'User.department_id=Department.id'
					 ),
				
				),
				'recursive'=>-1,
				'conditions'=>array('User.role_id'=>1,'User.district_id'=>$district_id)
			)
		);
        
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name')));
 		$this->set('requisition',$this->Requisition->find('first', $options));
 		$this->set(compact('departments','designations','users'));
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

			$remail=$this->Auth->user('email');
 				
			$this->Requisition->create();
			$this->request->data['Requisition']['user_id']=$this->Auth->user('id');
			
			$requisition=$this->Requisition->find('first', array('order'=>'requisitionno DESC','recursive'=>-1));
			$rno=0;
			if(!empty($requisition['Requisition']['requisitionno'])){
				$rno=$requisition['Requisition']['requisitionno']+1;
			}else{
				$rno=100001;
			}

			$this->loadModel('User');
			$users=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id')),'recursive'=>0));
			

			$this->request->data['Requisition']['requisitionno']=$rno;
			$this->request->data['Requisition']['location']=$users['Department']['name'];
			
			$detail=$this->request->data['Requisitiondetail'];

			$this->request->data['Requisition']['status']=1;
			$this->request->data['Requisition']['district_id']=$users['District']['id'];

			
			foreach($detail as $key=>$details){
				unset($this->request->data['Requisitiondetail'][$key]['valid']);
				unset($this->request->data['Requisitiondetail'][$key]['purposeothers']);
				unset($this->request->data['Requisitiondetail'][$key]['product_code']);
				unset($this->request->data['Requisitiondetail'][$key]['product_name']);
				unset($this->request->data['Requisitiondetail'][$key]['measure_name']);

				$this->request->data['Requisitiondetail'][$key]['status']=1;
				$this->request->data['Requisitiondetail'][$key]['district_id']=$users['District']['id'];

				if($details['purpose']==5){
					unset($this->request->data['Requisitiondetail'][$key]['purpose']);
					$this->request->data['Requisitiondetail'][$key]['purpose']=$details['purposeothers'];
				}else{
					$this->request->data['Requisitiondetail'][$key]['product_id']=$details['product_id'];
					$this->request->data['Requisitiondetail'][$key]['quantity']=$details['quantity'];
					$this->request->data['Requisitiondetail'][$key]['measure_id']=$details['measure_id'];
				}
				
			}
			$count_ck=count($this->request->data['Requisitiondetail']);
			
			if($count_ck==0){
				$this->Session->setFlash(__('You are not add any items.'));
				return $this->redirect($this->referer());
			}

			if ($this->Requisition->saveAssociated($this->request->data)) {
				
				$reqSendId=$this->Requisition->getInsertID ();
				$uid=$this->Auth->user('id');
				$this->Requisition->query("DELETE FROM carts WHERE user_id='".$uid."' ");
				
				//$this->sendMailAdmin($reqSendId,$remail);

				$this->Session->setFlash(__('The requisition has been sent.'));
				return $this->redirect(array('action' => 'viewr',$reqSendId,'rsubmit'));
			} else {
				$this->Session->setFlash(__('The requisition could not be saved. Please, try again.'));
			}
		}
		
	}

	public function add1() {
		$this->loadModel('Measure');
		$this->loadModel('Product');
		if ($this->request->is('post')) {

			$remail=$this->Auth->user('email');
 				
			$this->Requisition->create();
			$this->request->data['Requisition']['user_id']=$this->Auth->user('id');
			
			$requisition=$this->Requisition->find('first', array('order'=>'requisitionno DESC','recursive'=>-1));
			$rno=0;
			if(!empty($requisition['Requisition']['requisitionno'])){
				$rno=$requisition['Requisition']['requisitionno']+1;
			}else{
				$rno=100001;
			}
			
			$this->request->data['Requisition']['requisitionno']=$rno;
			
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
				
				$reqSendId=$this->Requisition->getInsertID ();
				$this->sendMailAdmin($reqSendId,$remail);
				$this->Session->setFlash(__('The requisition has been sent.'));
				return $this->redirect(array('action' => 'view',$reqSendId));
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
             $this->request->data['Requisition']['approvedBy']=$this->Auth->user('id');
                     
            $this->request->data['Requisition']['dateupdate']=date('Y-m-d'); 

            $r_data=$this->request->data['Requisitiondetail'];
           	$message=null;
            foreach($r_data as $key=>$r_datas){
            	 if(!empty($r_datas['purposeothers'])){
            	 	 	$message.=$r_datas['finalcode'].'-'.$r_datas['purposeothers'].'<br/>';

            	 }

            	 unset($this->request->data['Requisitiondetail'][$key]['finalcode']);
            }

                    

                     $remail=$this->request->data['Email']['email'];
                     unset($this->request->data['Email']);

			if($this->Requisition->saveAssociated($this->request->data)) {
				$this->sendMailAdmin($id,$remail);

				$this->Session->setFlash(__('The requisition has been saved.'));
				if($this->params['pass'][2]=='received'){
					return $this->redirect(array('action' => 'view',$id,'received'));
				}else{
					return $this->redirect(array('action' => 'view'));
				}
				
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
           $product=$this->Product->find( 'all',
				array(

					'fields'=>array(
						'Product.*',
						'Category.name',
						'SubCategory.name',
						'Measures.name',
						'Brand.name',
	        			'Size.name',
	        			'Color.name',
						),
					'joins'=>array(
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
						   'conditions'=>'Product.category_id=Category.id'
						),
						array(
						   'table'=>'measures',
						   'alias'=>'Measures',
						   'type'=>'LEFT',
						   'conditions'=>'Product.measure_id=Measures.id'
						),
						array(
						   'table'=>'brands',
						   'alias'=>'Brand',
						   'type'=>'LEFT',
						   'conditions'=>'Product.brand_id=Brand.id'
						),
						array(
						   'table'=>'sizes',
						   'alias'=>'Size',
						   'type'=>'LEFT',
						   'conditions'=>'Product.size_id=Size.id'
						),
						array(
						   'table'=>'colors',
						   'alias'=>'Color',
						   'type'=>'LEFT',
						   'conditions'=>'Product.color_id=Color.id'
						),
					),
					'recursive'=>-1
					)
				);
        $departments=$this->Department->find('list',array('fields'=>array('id','name')));
        $designations=$this->Designation->find('list',array('fields'=>array('id','name'))); 
       	$this->set(compact('measures','product','departments','designations'));
               
	}

	public function getreject(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
		 	$id=$_REQUEST['id'];
		 	
		 		$sql="UPDATE requisitions SET status='3' WHERE id='$id'";
		 		$this->Requisition->query($sql);
		 }
		
	}

	public function getapprove(){
		$this->layout='ajax';
		$approveUser=$this->Auth->user('id');

		 if(!empty($_REQUEST['id'])){

		 	//$this->sendMail($id);
		 	//$this->sendMailStorekeeper($id);
		 	$id=$_REQUEST['id'];
				$date=date('Y-m-d H:i:s');
		 		$sql="UPDATE `requisitiondetails` SET `status` ='2' WHERE `requisitiondetails`.`id` = $id";
		 		$this->Requisition->query($sql);
		 		$sql1="UPDATE `requisitiondetails` SET `dateupdate` = '$date' WHERE `requisitiondetails`.`id` = $id";
		 		$this->Requisition->query($sql1);

		 		$sql2="UPDATE `requisitiondetails` SET `approvedBy` = '$approveUser' WHERE `requisitiondetails`.`id` = $id";
		 		$this->Requisition->query($sql2);

		 		
		 
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
		$district_id=$this->Auth->user(['district_id']);

		if (!$this->Requisition->exists($id)) {
			throw new NotFoundException(__('Invalid requisition'));
		}
		if ($this->request->is(array('post', 'put'))) {
            $this->loadModel('Delivery');  

            $sql="UPDATE requisitions SET status=4 WHERE id='$id'";
            $this->Requisition->query( $sql);

			$this->request->data['Delivery']['user_id']=$this->Auth->user('id');
            $this->request->data['Delivery']['orderid']=$this->Auth->user('id'); 
            p($this->request->data);
            die();
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
        $requisitiondetails=$this->Requisition->Requisitiondetail->find('all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id,
				'Requisitiondetail.status'=>2,
				'Requisitiondetail.district_id'=>$district_id
				),
				'fields'=>array(
	 				'Requisitiondetail.*', 
					'Products.*',
					'Category.name',
					'Category.cCode',
					'SubCategory.sCode',
					'SubCategory.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
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
					array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),
					array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),
					array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
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
		$this->loadModel('User');           
		$this->loadModel('Delivery');
		$this->loadModel('Requisition');
		$this->loadModel('Damage');
		$this->loadModel('Requisitionreturn');
		$this->loadModel('Requisitiondetail');
		$role_id=$this->Auth->user('role_id');
		$users=$this->Auth->user(); 

		if($role_id==1 || $role_id==4){
			$id=$this->Auth->user('id');
			$usercount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.district_id'=>$users['district_id'],'User.status'=>1)));
			$inactivecount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.district_id'=>$users['district_id'],'User.status'=>2)));

			$totalreqcount=$this->Requisition->find('count',array('fields'=>array('Requisition.id'),'conditions'=>array('Requisition.district_id'=>$users['district_id']))); 

			$approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>2)));
				

			$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>4))); 

			$rejectedecount=$this->Requisitiondetail->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],'Requisitiondetail.status'=>3))); 

			$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.district_id'=>$users['district_id'])));


			$requisitionreturn=$this->Requisitionreturn->find('count',array('fields'=>array('id'),'conditions'=>array('Requisitionreturn.district_id'=>$users['district_id'])));


			$damage=$this->Damage->find('count',array('fields'=>array('id'),'conditions'=>array('Damage.district_id'=>$users['district_id'])));

		/*$missing=$this->Damage->find('count',array('fields'=>array('id'),'conditions'=>array(' Damage.type'=>2)));*/
		                                    
		}else{               
			$usercount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.district_id'=>$users['district_id'])));
			$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'])));
			$approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>2)));
			$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>4)));
			$rejectedecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>3)));
			$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id'],' Requisition.status'=>1)));       
		}
		        
		$this->set(compact('missing','damage','requisitionreturn','totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount','usercount','inactivecount'));
	                
	}
	
    public function dashboardstorekeeper() {
        $district_id=$this->Auth->user(['district_id']);
        $this->loadModel('Requisition');

        $this->loadModel('Delivery');
        $role_id=$this->Auth->user('role_id');
        $id=$this->Auth->user('id');
		if($role_id==2){ 
			$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,'Requisition.status<>1'))); 
        	$approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>2))); 

     		$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>4))); 

			$rejectedecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,'Requisition.status'=>3,'Requisition.user_id'=>$id))); 
			$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>1,'Requisition.user_id'=>$id)));
                    
        }else{            
           	$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>1))); 
        	$approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>2)));
     		$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>4)));
			$rejectedecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>3)));
			$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$district_id,' Requisition.status'=>1)));
       	}    

		$this->set(compact('totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount','usercount')); 
	}


	private function sendMailAdmin($id,$email) {

	$requisition=$this->Requisition->Requisitiondetail->find(
		'all',
			array(
				'conditions'=>array(
				'Requisitiondetail.requisition_id'=>$id
				),
				'fields'=>array(
	 				'Requisitiondetail.*',
					'Product.*',
					'Requisition.*',
					'Category.name',
					'SubCategory.name',
					'Measures.name',
					'User.name',
					'Brand.name',
        			'Size.name',
        			'Color.name',
					),
				'joins'=>array(

					array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.requisition_id=Requisition.id'
					 ),
					array(
					   'table'=>'users',
					   'alias'=>'User',
					   'type'=>'LEFT',
					   'conditions'=>'Requisition.user_id=User.id'
					 ),
					array(
					   'table'=>'products',
					   'alias'=>'Product',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.product_id=Product.id'
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
					   'conditions'=>'Product.category_id=Category.id'
					 ),
					 array(
					   'table'=>'measures',
					   'alias'=>'Measures',
					   'type'=>'LEFT',
					   'conditions'=>'Product.measure_id=Measures.id'
					 ),
					 array(
					   'table'=>'brands',
					   'alias'=>'Brand',
					   'type'=>'LEFT',
					   'conditions'=>'Product.brand_id=Brand.id'
					 ),
					array(
					   'table'=>'sizes',
					   'alias'=>'Size',
					   'type'=>'LEFT',
					   'conditions'=>'Product.size_id=Size.id'
					 ),
					array(
					   'table'=>'colors',
					   'alias'=>'Color',
					   'type'=>'LEFT',
					   'conditions'=>'Product.color_id=Color.id'
					 ),
				),
'recursive'=>-1
			)
		);
	$name=$this->Auth->user('name');
	$requisition[0]['Requisition']['name']=$name;


		$this->Email->smtpOptions = array(
            'host' => 'mail.digitalprogressbd.com',
			'port' => '25',
			'username' => 'info@digitalprogressbd.com',
    		'password' => 'info@2018'
           );
	   
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
    	$this->Email->from     = 'info@digitalprogressbd.com';
   		$this->Email->to       = $email;
   	   	$this->Email->cc       = array('monir.cyber@gmail.com');
   		$this->Email->subject ='Requisition Status';
		$this->Email->template ='requisitoner';
		$this->Email->sendAs = 'html';
		$this->set('requisition',$requisition);
		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
	}


	private function sendMail($id) {
		$options = array('conditions' => array('Requisition.' . $this->Requisition->primaryKey => $id));
		$requisition=$this->Requisition->find('first', $options);
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
		$this->set('requisition',$requisition);
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
			$requisition=$this->Requisition->find('first', $options);
		
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
    		'password' => 'ipsita@2017'
           );
	   
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
       
    	$this->Email->from     = 'institution@ipsitasoft.com';
   		$this->Email->to       = "mansuranishu2@gmail.com";
   	   	$this->Email->cc       = array('monir.cyber@gmail.com');
   		$this->Email->subject ='Request For Delivery';
		$this->Email->template ='storekeeper';
		$this->Email->sendAs = 'html';
	
		$this->set('requisition',$requisition);
		$this->set('departments',$departments);
		$this->set('designations',$designations);
		$this->set('requisitiondetails',$requisitiondetails);

		

		if ($this->Email->send()) {
			return true;
		} else {
			echo $this->Email->smtpError;
		}
	}

	public function requisitionapproved(){
		$district_id=$this->Auth->user(['district_id']); 

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
		$this->loadModel('Delivery');
		$this->Requisition->recursive = 1; 

		$id= $this->Auth->user('id');
		$role_id= $this->Auth->user('role_id');
		$ext=null;
		if($role_id==1 || $role_id==4){
			
		}elseif($role_id==2){ 
			$ext="Requisition.status<>1";
		}else{
			$conditions['Requisition.user_id']=$id;
			$conditions['Requisition.status']=2;
		}

		$this->Requisition->order = "Requisition.id DESC";    
       	$role_id= $this->Auth->user('role_id');
       	$id= $this->Auth->user('id'); 

        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));  
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 15,'conditions' => array($conditions,$ext,'Requisition.district_id'=>$district_id)); 
		$this->set('requisitions',$this->paginate()); 
    }
        
    public function requisitionapprove(){
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
		$this->loadModel('Delivery');
		$this->Requisition->recursive = 1;

		$ext="1=1";

		$id= $this->Auth->user('id');
		$role_id= $this->Auth->user('role_id');
		$district_id=$this->Auth->user(['district_id']);

		if($role_id==1 || $role_id==4 ){
			$conditions['Requisition.status']=2;
		}elseif($role_id==2 ){
		
			$conditions['Requisition.status']=2; 

		}else{
			$conditions['Requisition.user_id']=$id;
			$conditions['Requisition.status']=2;
		} 
		
		$this->Requisition->order = "Requisition.id DESC";

        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));
        $this->set(compact('users'));

        $this->paginate = array('limit' => 15,'conditions' =>array($conditions,'Requisition.district_id'=>$district_id));  
		$this->set('requisitions',$this->paginate()); 
    }

    public function requisitiondelivery(){
    	$district_id=$this->Auth->user(['district_id']);
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
		$this->loadModel('Delivery');
		$this->Requisition->recursive = 1; 

     	$id= $this->Auth->user('id'); 
		$role_id= $this->Auth->user('role_id');
		if($role_id==1 || $role_id==4 || $role_id==2){
			
		}else{
			$conditions['Requisition.user_id']=$id;
		} 
		$conditions['Requisition.status']=4;
		
		$this->Requisition->order = "Requisition.id DESC";
                
        $role_id= $this->Auth->user('role_id');

        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));
     
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 10,'conditions' => array($conditions,'Requisition.id IN(SELECT deliveries.requisition_id FROM deliveries)','Requisition.district_id'=>$district_id),
			);
		
		$this->set('requisitions',$this->paginate()); 
	   
    }

     public function requisitionreceivedd(){
     	$userCu=$this->Auth->user();  
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
		 $id= $this->Auth->user('id');
	

		
		$role_id= $this->Auth->user('role_id');
		if($role_id==1 || $role_id==4){
			
		}else{
			$conditions['Requisition.user_id']=$id;
		}
		
		
		$this->Requisition->order = "Requisition.id DESC"; 

        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$userCu['district_id']),'order'=>'User.name ASC'));
     
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 10,'conditions' =>array($conditions,'Requisition.district_id'=>$userCu['district_id'])); 
		$this->set('requisitions',$this->paginate()); 	 
	   
    }

    public function requisitionreceived(){
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
		$id= $this->Auth->user('id'); 
		$role_id= $this->Auth->user('role_id');
		$district_id=$this->Auth->user(['district_id']);

		if($role_id==1 || $role_id==4 || $role_id==2){
			$conditions['Requisition.status']=1; 
		}else{
			$conditions['Requisition.user_id']=$id;
		}

		$this->Requisition->order = "Requisition.id DESC";

        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));
     
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 10,'conditions' => array($conditions,'Requisition.district_id'=>$district_id));
		
		$this->set('requisitions',$this->paginate());
			 
	   
    }


    

    
    public function requisitionreject(){          
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



		$id= $this->Auth->user('id');
		$role_id= $this->Auth->user('role_id');
		if($role_id==1 || $role_id==4){
			
		}else{
			$conditions['Requisition.user_id']=$id;
		}

		$conditions['Requisition.status']=3;
		
		$this->Requisition->order = "Requisition.id DESC";
                
        $users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3),'order'=>'User.name ASC'));
     
        $this->set(compact('users'));
        
        $this->paginate = array(
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('requisitions', $this->paginate());
    }
     public function requisitionpending(){          
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
		$id= $this->Auth->user('id'); 
		$role_id= $this->Auth->user('role_id');
		$district_id=$this->Auth->user(['district_id']); 
		
		if($role_id==1 || $role_id==4){
			$users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));
		}else{
			$users=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.id'=>$id,'User.role_id'=>3,'User.district_id'=>$district_id),'order'=>'User.name ASC'));
			$conditions['Requisition.user_id']=$id;
		}

		$conditions['Requisition.status']=1;
		
		$this->Requisition->order = "Requisition.id DESC";
                
        
     
        $this->set(compact('users'));
        
        $this->paginate = array('limit' => 15, 'conditions' => array($conditions,'Requisition.district_id'=>$district_id));  
		$this->set('requisitions', $this->paginate());
    }

    public function particularuser($iduser=null,$iddist=null){
       	$conditions = array();
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['Report'])){
			$filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
			$filter_url[] = $iduser;
			$filter_url[] = $iddist;
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

		$conditions['Requisition.user_id']=$iduser; 
	 
		$this->Requisition->recursive = 1;  
		 
		$conditions['Requisition.status']=4;

		$this->Requisition->order = "Requisition.id DESC";  
        
        $this->paginate = array('limit' => 10,'conditions' => array($conditions,'Requisition.district_id'=>$iddist)); 
		$this->set('requisitions',$this->paginate()); 

		$usersview=$this->Requisition->User->find('first',array('conditions'=>array('User.id'=>$iduser,'User.district_id'=>$iddist),'recursive'=>0));
		$this->set(compact('iduser','iddist','usersview'));
    }

}
