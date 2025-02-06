<?php
App::uses('AppController', 'Controller');
/**
 * Requisitionretunrs Controller
 *
 * @property Requisitionretunr $Requisitionretunr
 * @property PaginatorComponent $Paginator
 */
class RequisitionretunrsController extends AppController {

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
		$this->Requisitionretunr->recursive = 0;
		$this->set('requisitionretunrs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Requisitionretunr->exists($id)) {
			throw new NotFoundException(__('Invalid requisitionretunr'));
		}
		$options = array('conditions' => array('Requisitionretunr.' . $this->Requisitionretunr->primaryKey => $id));
		$this->set('requisitionretunr', $this->Requisitionretunr->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Requisitionretunr->create();
			if ($this->Requisitionretunr->save($this->request->data)) {
				$this->Session->setFlash(__('The requisitionretunr has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisitionretunr could not be saved. Please, try again.'));
			}
		}
		$products = $this->Requisitionretunr->Product->find('list');
		$measures = $this->Requisitionretunr->Measure->find('list');
		$this->set(compact('products', 'measures'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Requisitionretunr->exists($id)) {
			throw new NotFoundException(__('Invalid requisitionretunr'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Requisitionretunr->save($this->request->data)) {
				$this->Session->setFlash(__('The requisitionretunr has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requisitionretunr could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requisitionretunr.' . $this->Requisitionretunr->primaryKey => $id));
			$this->request->data = $this->Requisitionretunr->find('first', $options);
		}
		$products = $this->Requisitionretunr->Product->find('list');
		$measures = $this->Requisitionretunr->Measure->find('list');
		$this->set(compact('products', 'measures'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Requisitionretunr->id = $id;
		if (!$this->Requisitionretunr->exists()) {
			throw new NotFoundException(__('Invalid requisitionretunr'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requisitionretunr->delete()) {
			$this->Session->setFlash(__('The requisitionretunr has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requisitionretunr could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
