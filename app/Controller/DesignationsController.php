<?php
App::uses('AppController', 'Controller');
/**
 * Designations Controller
 *
 * @property Designation $Designation
 * @property PaginatorComponent $Paginator
 */
class DesignationsController extends AppController {

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
		$users=$this->Auth->user(); 
		$this->Designation->recursive = 0;
		$designations = $this->Designation->find('all',array(
	        'conditions'=>array('Designation.district_id'=>$users['district_id']), 
	        'order' => array('Designation.name' => 'ASC')));  
	    $this->set('designations', $designations);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Designation->exists($id)) {
			throw new NotFoundException(__('Invalid designation'));
		}
		$options = array('conditions' => array('Designation.' . $this->Designation->primaryKey => $id));
		$this->set('designation', $this->Designation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Designation->create();
			if ($this->Designation->save($this->request->data)) {
				$this->Session->setFlash(__('The designation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The designation could not be saved. Please, try again.'));
			}
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
		if (!$this->Designation->exists($id)) {
			throw new NotFoundException(__('Invalid designation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Designation->save($this->request->data)) {
				$this->Session->setFlash(__('The designation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The designation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Designation.' . $this->Designation->primaryKey => $id));
			$this->request->data = $this->Designation->find('first', $options);
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
		$this->Designation->id = $id;
		if (!$this->Designation->exists()) {
			throw new NotFoundException(__('Invalid designation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Designation->delete()) {
			$this->Session->setFlash(__('The designation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The designation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function getdesignation(){
		$users=$this->Auth->user();
		$disId=$users['district_id'];
		$this->render(false,'ajax');
		 if(!empty($_REQUEST['id'])){ 
		 	$id=$_REQUEST['id']; 
	 		$sql="INSERT INTO designations (`name`,`district_id`,`status`) VALUES ('$id','$disId','1')"; 
	 		$this->Designation->query($sql);
	 		$sqlid="SELECT MAX(id) AS id FROM designations ORDER BY id DESC";
	 		$max_id=$this->Designation->query($sqlid);
	 		echo $max_id[0][0]['id'];

		 }	
	}
}
