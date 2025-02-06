<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Cms','Email');

/**
 * index method
 *
 * @return void
 */
    public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow(array('fp','activep'));	 
	}

	public function login() {
		$this->layout = 'login';

		if($this->Session->check('Auth.User')){ 
            if($this->Auth->user('role_id')==4 && $this->Auth->user('status')==1){
                $this->redirect(array('controller'=>'users','action' => 'sudashboard'));
            }elseif($this->Auth->user('role_id')==3 && $this->Auth->user('status')==1){
                $this->redirect(array('controller'=>'stocks','action' => 'dashboardrequisitioner'));
            }elseif($this->Auth->user('role_id')==2 && $this->Auth->user('status')==1){
                $this->redirect(array('controller'=>'requisitions','action' => 'dashboardstorekeeper'));
            }elseif($this->Auth->user('role_id')==1 && $this->Auth->user('status')==1){
                $this->redirect(array('controller'=>'requisitions','action' => 'dashboard'));
            }elseif($this->Auth->user('role_id')==5 && $this->Auth->user('status')==1){
                $this->redirect(array('controller'=>'users','action' => 'centraldashboard'));
            }     
        } 

		if ($this->request->is('post')) { 
	        if ($this->Auth->login()) { 
                if($this->Auth->user('role_id')==4 && $this->Auth->user('status')==1){
                    $this->redirect(array('controller'=>'users','action' => 'sudashboard'));
                }elseif($this->Auth->user('role_id')==3 && $this->Auth->user('status')==1){
                    $this->redirect(array('controller'=>'stocks','action' => 'dashboardrequisitioner'));
                }elseif($this->Auth->user('role_id')==2 && $this->Auth->user('status')==1){
                    $this->redirect(array('controller'=>'requisitions','action' => 'dashboardstorekeeper'));
                }elseif($this->Auth->user('role_id')==1 && $this->Auth->user('status')==1){
                    $this->redirect(array('controller'=>'requisitions','action' => 'dashboard'));
                }elseif($this->Auth->user('role_id')==5 && $this->Auth->user('status')==1){
                    $this->redirect(array('controller'=>'users','action' => 'centraldashboard'));
                }else{ 
                	$this->Session->destroy();
					$this->Session->setFlash('আপনার অ্যাকাউন্টটি  সচল নয়', 'flashmsg');
        			return $this->redirect($this->Auth->logout()); 
                }
	        } else {
	            $this->Session->setFlash('আপনার ব্যবহারকারী নাম/পাসওয়ার্ডটি সঠিক নয়, আবার চেষ্টা করুন', 'wrong');
	        }
	    }
	}
	public function index($status=null) {
		$users=$this->Auth->user(); 
		$this->User->recursive = 0;
		$this->paginate=array('limit'=>100,'order'=>'User.serial ASC','conditions'=>array('User.status'=>$status,'User.district_id'=>$users['district_id']));
		$this->set('users', $this->paginate());
		$this->set(compact('status'));
	}
	
	public function superusers($idname = null,$idpass = null) { 
		$this->User->recursive = 0;
		if ($idname==division) {
			$users= $this->User->find('all',array('conditions'=>array('User.division_id'=>$idpass,'User.status'=>1),'order'=>'User.district_id ASC'));
		}else{
			$users= $this->User->find('all',array('conditions'=>array('User.role_id'=>4),'order'=>'User.division_id ASC'));
		} 
		$divisions = $this->User->Division->find('list',array('fields'=>array('namebn')));
		$districts = $this->User->District->find('list',array('fields'=>array('namebn'))); 
		$this->set(compact('users','divisions','districts','idname'));
	}

	public function individual($idname = null,$idpass = null) { 
		$this->User->recursive = 0; 
		$users= $this->User->find('all',array('conditions'=>array('User.district_id'=>$idpass,'User.status'=>1),'order'=>'User.serial ASC'));  

		$this->loadModel('Requisition');
    	$this->loadModel('Damage');
    	$this->loadModel('Delivery');
        $this->loadModel('Requisitionreturn');
        $this->loadModel('Requisitiondetail');  
    	$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$idpass))); 

    	$usercount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.district_id'=>$idpass,'User.status'=>1)));

        $approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>2,'Requisition.district_id'=>$idpass)));  
     	$deliveredecount=$this->Delivery->find('count',
			array(
				'conditions'=>array(
				'Requisition.status'=>2,
				'Delivery.district_id'=>$idpass
				), 
				'joins'=>array(
					array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisition.id'
					 ), 
				),
				'recursive'=>-1 
			)
		); 

      	$rejectedecount=$this->Requisitiondetail->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisitiondetail.status'=>3,'Requisitiondetail.district_id'=>$idpass))); 
		$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.district_id'=>$idpass)));
		
		$requisitionreturn=$this->Requisitionreturn->find('count',array('fields'=>array('id'),'conditions'=>array('Requisitionreturn.district_id'=>$idpass)));
		$deliveredecountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>4,'Requisition.district_id'=>$idpass)));
		$damage=$this->Damage->find('count',array('fields'=>array('id'),'conditions'=>array('Damage.district_id'=>$idpass))); 
		$pendingcountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.district_id'=>$idpass)));
		$this->set(compact('missing','damage','requisitionreturn','totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount','usercount','balance','balanced','pendingcountss','deliveredecountss','users','idname','idpass'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function cp($id = null) {
		$this->User->id = $this->Auth->user('id');
		if (!$this->User->exists()) {
			throw new NotFoundException('Invalid user');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this -> Session -> setFlash('The password has been updated successfully.');
				$this->redirect(array('controller'=>'users','action' => 'view',$id));
			} else {
				$this->Session->setFlash('The Password could not be changed. Please, try again.'); 
			}
		} else {
			$this->request->data = $this->User->read();
		}
	
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$users=$this->Auth->user(); 
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
					$id = $this->User->getInsertID ();
				if(!empty($this->request->data['User']['image']['tmp_name'])) {
					$this->Cms->uploadImage($this->request->data['User']['image'], $id, 'u' );
			   	}
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index','1'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
        $departments = $this->User->Department->find('list',array('order'=>'Department.name ASC','conditions'=>array('Department.district_id'=>$users['district_id'])));
        $designations = $this->User->Designation->find('list',array('conditions'=>array('Designation.status'=>1,'Designation.district_id'=>$users['district_id']),'order'=>'Designation.name ASC'));
        $this->set(compact('departments','designations'));
	} 

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$users=$this->Auth->user(); 
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				if(!empty($this->request->data['User']['image']['tmp_name'])) {
					$this->Cms->uploadImage($this->request->data['User']['image'], $id, 'u' );
			   	}
				$this->Session->setFlash(__('The user has been updated.'));
				return $this->redirect(array('action' => 'index','1'));
			} else {
				$this->Session->setFlash(__('The user could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$departments = $this->User->Department->find('list',array('order'=>'Department.name ASC','conditions'=>array('Department.district_id'=>$users['district_id'])));
        $designations = $this->User->Designation->find('list',array('conditions'=>array('Designation.status'=>1,'Designation.district_id'=>$users['district_id']),'order'=>'Designation.name ASC'));
        $this->set(compact('departments','designations'));
	}

	public function superadd() { 
		if ($this->request->is('post')) {
			$this->loadModel('Department');
			$this->loadModel('Designation');
			$disId=$this->request->data['User']['district_id'];
			$department=$this->request->data['User']['department_id'];
			$designation=$this->request->data['User']['designation_id'];

			$sql="INSERT INTO departments (`name`,`district_id`,`status`) VALUES ('$department','$disId','1')"; 
	 		$this->Department->query($sql);

			$sqls="INSERT INTO designations (`name`,`district_id`,`status`) VALUES ('$designation','$disId','1')"; 
	 		$this->Designation->query($sqls);

	 		$departId = $this->User->Department->find('first',array('order'=>'Department.id DESC','recursive'=>-1,'fields'=>'id'));
			$DesigId = $this->User->Designation->find('first',array('order'=>'Designation.id DESC','recursive'=>-1,'fields'=>'id'));

			$this->request->data['User']['department_id']= $departId['Department']['id'];
			$this->request->data['User']['designation_id']= $DesigId['Designation']['id'];
			 
			$this->User->create(); 
			if ($this->User->save($this->request->data)) {
					$id = $this->User->getInsertID ();
				if(!empty($this->request->data['User']['image']['tmp_name'])) {
					$this->Cms->uploadImage($this->request->data['User']['image'], $id, 'u' );
			   	}
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'superusers'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} 
        $divisions = $this->User->Division->find('list',array('fields'=>array('namebn')));
        $this->set(compact('divisions'));
	}
	public function superedit($id = null) { 
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				if(!empty($this->request->data['User']['image']['tmp_name'])) {
					$this->Cms->uploadImage($this->request->data['User']['image'], $id, 'u' );
			   	}
				$this->Session->setFlash(__('The user has been updated.'));
				return $this->redirect(array('action' => 'superusers'));
			} else {
				$this->Session->setFlash(__('The user could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		} 
		$departments = $this->User->Department->find('list',array('conditions'=>array('district_id'=>$this->request->data['User']['district_id']))); 
        $designations = $this->User->Designation->find('list',array('conditions'=>array('Designation.status'=>1,'district_id'=>$this->request->data['User']['district_id']),'order'=>'Designation.name ASC'));
        $divisions = $this->User->Division->find('list',array('fields'=>array('namebn')));
        if (!empty($this->request->data['User']['division_id'])) {
        	$districts = $this->User->District->find('list',array('fields'=>array('namebn'),'conditions'=>array('division_id'=>$this->request->data['User']['division_id']))); 
        }else{
        	$districts = "";
        }
        
        $this->set(compact('departments','designations','divisions','districts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
        
    public function sudashboard(){
    	$this->loadModel('Requisition');
    	$this->loadModel('Damage');
    	$this->loadModel('Delivery');
        $this->loadModel('Requisitionreturn');
        $this->loadModel('Requisitiondetail');
        $users=$this->Auth->user();  
    	$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.district_id'=>$users['district_id']))); 

    	$usercount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.division_id'=>$users['division_id'],'User.district_id'=>$users['district_id'],'User.status'=>1)));

        $approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>2,'Requisition.district_id'=>$users['district_id'])));  
     	$deliveredecount=$this->Delivery->find('count',
			array(
				'conditions'=>array(
				'Requisition.status'=>2,
				'Delivery.district_id'=>$users['district_id']
				), 
				'joins'=>array(
					array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Delivery.requisition_id=Requisition.id'
					 ), 
				),
				'recursive'=>-1 
			)
		); 

      	$rejectedecount=$this->Requisitiondetail->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisitiondetail.status'=>3,'Requisitiondetail.district_id'=>$users['district_id']))); 
		$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.district_id'=>$users['district_id'])));
		
		$requisitionreturn=$this->Requisitionreturn->find('count',array('fields'=>array('id'),'conditions'=>array('Requisitionreturn.district_id'=>$users['district_id'])));
		$deliveredecountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>4,'Requisition.district_id'=>$users['district_id'])));
		$damage=$this->Damage->find('count',array('fields'=>array('id'),'conditions'=>array('Damage.district_id'=>$users['district_id']))); 
		$pendingcountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.district_id'=>$users['district_id'])));
		$this->set(compact('missing','damage','requisitionreturn','totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount','usercount','balance','balanced','pendingcountss','deliveredecountss'));
        
    }

    public function centraldashboard(){ 
    	$this->loadModel('Division'); 
		$this->User->recursive = 0;
		$users= $this->User->find('all',array('conditions'=>array('User.role_id'=>array(1,2,3,4),'User.status'=>1)));
		$centrall= $this->User->find('count',array('conditions'=>array('User.district_id'=>100,'User.role_id'=>array(1,2,3,4),'User.status'=>1)));
		$divisions = $this->Division->find('all');  
		$this->set(compact('users','divisions','districts','centrall'));
    }

    public function forgetpassword(){
    	$this->layout = 'forgetpass';
    }


    public function fp() { 
		$this->layout = 'login'; 
		if ($this->request->is ( 'post' )) {
			$this->User->set ( $this->request->data );
			if ($this->User->LoginValidate ()) {
				$data = $this->request->data ['User'] ['email'];
				$user = $this->User->find ( 'first', array ('recursive' => - 1, 'conditions' => array ("BINARY User.email='" . $data . "'" ) ) );
				
				if (empty ( $user['User']['id'] )) {
					$this->Session->setFlash( 'আপনার ই-মেইলটি  সঠিক নয়','wrong');
					return;
				}
				$userId = $user['User']['id'];
				// check for inactive account
				$pass = $this->User->getActivationKey($user['User']['password'] );
				$link = Router::url ( "/users/activep/$userId/$pass", true );

				if ($user['User']['id']) {
					if ($this->_sendFpassword ( $data, 'fpass', $link )) {
						$this->Session->setFlash( 'আপনার পাসওয়ার্ড পুনরায় সেট করার জন্য ই-মেইল পাঠানো হয়েছে, অনুগ্রহ  করে আপনার ই-মেইলটি চেক করুন','success');
						$this->redirect ( array ('action' => 'fp' ) );
					} else {
						$this->Session->setFlash ( 'অনুগ্রহ করে আবার চেষ্টা করুন','flashmsg', array ('class' => 'message' ) );
					}
				}
			}
		}
	}
	public function activep() {
	
		 if(!empty($this->params['pass'][0])){
		 	$indent=$this->params['pass'][0];
		 }
	   if(!empty($this->params['pass'][1])){
		 	 $active=$this->params['pass'][1];
		 }
		   
		$this->layout = 'login';
		
		if ($this->request->is ( 'post' )) {

			if (! empty ( $this->request->data  ['User'] ['ident'] ) && ! empty ( $this->request->data  ['User'] ['ident'] )) {
				$this->set ( 'ident', $this->request->data  ['User'] ['ident'] );
				$this->set ( 'activate', $this->request->data  ['User'] ['activate'] );

				$this->User->set ($this->request->data);

				if ($this->User->RegisterValidate ()) {
					$userId = $this->request->data  ['User'] ['ident'];
					$activateKey = $this->request->data  ['User'] ['activate'];
					
					$user = $this->User->read ( null, $userId );

					if (! empty ( $user )) {
						$password = $user ['User'] ['password'];
						$thekey = $this->User->getActivationKey ( $password );
						if ($thekey == $activateKey) {
							$this->User->save ( $this->request->data);
							$this->Session->setFlash ( __ ( 'Your password has been reset successfully' ) );
							$this->redirect ( '/login' );
						} else {
							$this->Session->setFlash ( __ ( 'Something went wrong, please send password reset link again' ) );
						}
					} else {
						$this->Session->setFlash ( __ ( 'Something went wrong, please click again on the link in email' ) );
					}
				}
			} else {
				$this->Session->setFlash ( __ ( 'Something went wrong, please click again on the link in email' ) );
			}
		} else {
			if (isset ( $indent ) && isset ( $active )) {
				$this->set ( 'ident', $indent );
				$this->set ( 'activate', $active );
			}
		}
	}
	private function _sendFpassword($data, $template, $link) {
		
		
		$this->Email->smtpOptions = array(
            'host' => 'mail.digitalprogressbd.com',
			'port' => '25',
			'username' => 'info@digitalprogressbd.com',
    		'password' => 'info@2018'
           );
	   
	           
        $this->Email->delivery='smtp';
        $this->Email->send = 'debug';
		$this->Email->to = $data;
		$this->Email->from = 'info@digitalprogressbd.com';
		$this->Email->subject = 'Please click the following link for password reset';
		
		
		
		if ($this->Email->send ($link)) {
			return true;
		} else {
			return false;
		}
	
	}

	public function totalactivities(){
		$this->loadModel('Requisition');
    	$this->loadModel('Damage');
    	$this->loadModel('Delivery');
        $this->loadModel('Requisitionreturn');
        $this->loadModel('Requisitiondetail');
    	$totalreqcount=$this->Requisition->find('count',array('fields'=>array('id')));
    	$usercount=$this->User->find('count',array('fields'=>array('id'),'conditions'=>array('User.role_id'=>array(1,2,3,4),'User.status'=>1)));
        $approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>2))); 
     	$deliveredecount=$this->Delivery->find(
					'count',
					array(
						'conditions'=>array(
						'Requisition.status'=>2
						),
				
						'joins'=>array(
							array(
							   'table'=>'requisitions',
							   'alias'=>'Requisition',
							   'type'=>'LEFT',
							   'conditions'=>'Delivery.requisition_id=Requisition.id'
							 ),

						),
						'recursive'=>-1

					)
				); 

      	$rejectedecount=$this->Requisitiondetail->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisitiondetail.status'=>3))); 

		$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1)));
		
		$requisitionreturn=$this->Requisitionreturn->find('count',array('fields'=>array('id')));
		$deliveredecountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>4)));
		$damage=$this->Damage->find('count',array('fields'=>array('id')));
		/*$missing=$this->Damage->find('count',array('fields'=>array('id'),'conditions'=>array(' Damage.type'=>2)));*/
		$pendingcountss=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1)));
		$this->set(compact('missing','damage','requisitionreturn','totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount','usercount','balance','balanced','pendingcountss','deliveredecountss'));
	}
}
