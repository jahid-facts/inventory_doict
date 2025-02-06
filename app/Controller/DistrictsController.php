<?php
App::uses('AppController', 'Controller');
/**
 * Districts Controller
 *
 * @property District $District
 * @property PaginatorComponent $Paginator
 */
class DistrictsController extends AppController {
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('dropdownprofilepest','dropdownprofilestu');
	}

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
		$this->District->recursive = 0;
		$this->paginate=array('limit'=>100);
		$this->set('districts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->District->exists($id)) {
			throw new NotFoundException(__('Invalid district'));
		}
		$options = array('conditions' => array('District.' . $this->District->primaryKey => $id));
		$this->set('district', $this->District->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function districtlist(){
		$this->loadModel('User');
		$this->layout = 'ajax';
		$data = $_REQUEST['division_id'];
		$users=$this->Auth->user(); 
		$modelname = $_REQUEST['model'];
		if(!empty($data)){   
			$districts = $this->District->find('list',array('fields'=>array('id','namebn'),'recursive'=>-1, 'conditions'=>array('District.division_id'=>$data))); 

			if ($users['role_id']==5) {
				$superDistrict = $this->User->find('list',array('fields'=>array('district_id','district_id'),'recursive'=>-1, 'conditions'=>array('User.division_id'=>$data)));  
				$this->set(compact('districts','modelname','superDistrict'));
			}else{
				$this->set(compact('districts','modelname'));
			}
			
		}
	}
	public function add() {
		if ($this->request->is('post')) {
			$this->District->create();
			if ($this->District->save($this->request->data)) {
				$this->Session->setFlash(__('The district has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.'));
			}
		}
		$divisions = $this->District->Division->find('list');
		$this->set(compact('divisions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->District->exists($id)) {
			throw new NotFoundException(__('Invalid district'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->District->save($this->request->data)) {
				$this->Session->setFlash(__('The district has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('District.' . $this->District->primaryKey => $id));
			$this->request->data = $this->District->find('first', $options);
		}
		$divisions = $this->District->Division->find('list');
		$this->set(compact('divisions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->District->id = $id;
		if (!$this->District->exists()) {
			throw new NotFoundException(__('Invalid district'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->District->delete()) {
			$this->Session->setFlash(__('The district has been deleted.'));
		} else {
			$this->Session->setFlash(__('The district could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
