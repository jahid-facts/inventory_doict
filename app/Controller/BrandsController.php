<?php
App::uses('AppController', 'Controller');
/**
 * Brands Controller
 *
 * @property Brand $Brand
 * @property PaginatorComponent $Paginator
 */
class BrandsController extends AppController {

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
		$this->Brand->recursive = 0;
		$this->set('brands', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
		$this->set('brand', $this->Brand->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Brand->create();
			if ($this->Brand->save($this->request->data)) {
				$this->Session->setFlash(__('The model has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The model could not be saved. Please, try again.'));
			}
		}
	}
	
	public function getbrand(){
		$this->render(false,'ajax');
		 if(!empty($_REQUEST['id'])){
		 	$id=$_REQUEST['id'];
		 		$sql="INSERT INTO brands (`name`) VALUES ('$id')";
		 		$this->Brand->query($sql);
		 		$sqlid="SELECT MAX(id) AS id FROM brands ORDER BY id DESC";
		 		$max_id=$this->Brand->query($sqlid);
		 		echo $max_id[0][0]['id'];
	
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
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid model'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Brand->save($this->request->data)) {
				$this->Session->setFlash(__('The model has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The model could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
			$this->request->data = $this->Brand->find('first', $options);
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
		$this->Brand->id = $id;
		if (!$this->Brand->exists()) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Brand->delete()) {
			$this->Session->setFlash(__('The model has been deleted.'));
		} else {
			$this->Session->setFlash(__('The model could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
