<?php
App::uses('AppController', 'Controller');
/**
 * Stockacrchives Controller
 *
 * @property Stockacrchive $Stockacrchive
 * @property PaginatorComponent $Paginator
 */
class StockacrchivesController extends AppController {

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
		$this->Stockacrchive->recursive = 0;
		$this->set('stockacrchives', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Stockacrchive->exists($id)) {
			throw new NotFoundException(__('Invalid stockacrchive'));
		}
		$options = array('conditions' => array('Stockacrchive.' . $this->Stockacrchive->primaryKey => $id));
		$this->set('stockacrchive', $this->Stockacrchive->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Stockacrchive->create();
			if ($this->Stockacrchive->save($this->request->data)) {
				$this->Session->setFlash(__('The stockacrchive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stockacrchive could not be saved. Please, try again.'));
			}
		}
		$products = $this->Stockacrchive->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Stockacrchive->exists($id)) {
			throw new NotFoundException(__('Invalid stockacrchive'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Stockacrchive->save($this->request->data)) {
				$this->Session->setFlash(__('The stockacrchive has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stockacrchive could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Stockacrchive.' . $this->Stockacrchive->primaryKey => $id));
			$this->request->data = $this->Stockacrchive->find('first', $options);
		}
		$products = $this->Stockacrchive->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Stockacrchive->id = $id;
		if (!$this->Stockacrchive->exists()) {
			throw new NotFoundException(__('Invalid stockacrchive'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Stockacrchive->delete()) {
			$this->Session->setFlash(__('The stockacrchive has been deleted.'));
		} else {
			$this->Session->setFlash(__('The stockacrchive could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
