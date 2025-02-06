<?php
App::uses('AppController', 'Controller');
/**
 * Sizes Controller
 *
 * @property Size $Size
 * @property PaginatorComponent $Paginator
 */
class SizesController extends AppController {

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
		$this->Size->recursive = 0;
		$this->set('sizes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Size->exists($id)) {
			throw new NotFoundException(__('Invalid size'));
		}
		$options = array('conditions' => array('Size.' . $this->Size->primaryKey => $id));
		$this->set('size', $this->Size->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Size->create();
			if ($this->Size->save($this->request->data)) {
				$this->Session->setFlash(__('The size has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size could not be saved. Please, try again.'));
			}
		}
	}

	public function getsize(){
		$this->render(false,'ajax');
		 if(!empty($_REQUEST['id'])){
		 	$id=$_REQUEST['id'];
		 		$sql="INSERT INTO sizes (`name`) VALUES ('$id')";
		 		$this->Size->query($sql);
		 		$sqlid="SELECT MAX(id) AS id FROM sizes ORDER BY id DESC";
		 		$max_id=$this->Size->query($sqlid);
		 		echo $max_id[0][0]['id'];
	
		 }	
	}


	public function addsize() {
        $this->layout="modal";
        $this->loadModel('Size');
	if ($this->request->is('post')) {
			$this->Size->create();
			if ($this->Size->save($this->request->data)) {
				$this->Session->setFlash(__('The size has been saved.'));
				return $this->redirect(array('controller'=>'products','action' => 'add'));
			} else {
				$this->Session->setFlash(__('The size could not be saved. Please, try again.'));
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
		if (!$this->Size->exists($id)) {
			throw new NotFoundException(__('Invalid size'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Size->save($this->request->data)) {
				$this->Session->setFlash(__('The size has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The size could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Size.' . $this->Size->primaryKey => $id));
			$this->request->data = $this->Size->find('first', $options);
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
		$this->Size->id = $id;
		if (!$this->Size->exists()) {
			throw new NotFoundException(__('Invalid size'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Size->delete()) {
			$this->Session->setFlash(__('The size has been deleted.'));
		} else {
			$this->Session->setFlash(__('The size could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
