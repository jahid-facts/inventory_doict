<?php
App::uses('AppController', 'Controller');
/**
 * Measures Controller
 *
 * @property Measure $Measure
 * @property PaginatorComponent $Paginator
 */
class MeasuresController extends AppController {

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
		$this->Measure->recursive = 0;
		$this->set('measures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Measure->exists($id)) {
			throw new NotFoundException(__('Invalid measure'));
		}
		$options = array('conditions' => array('Measure.' . $this->Measure->primaryKey => $id));
		$this->set('measure', $this->Measure->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Measure->create();
			if ($this->Measure->save($this->request->data)) {
				$this->Session->setFlash(__('The measure has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measure could not be saved. Please, try again.'));
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
		if (!$this->Measure->exists($id)) {
			throw new NotFoundException(__('Invalid measure'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Measure->save($this->request->data)) {
				$this->Session->setFlash(__('The measure has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measure could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Measure.' . $this->Measure->primaryKey => $id));
			$this->request->data = $this->Measure->find('first', $options);
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
		$this->Measure->id = $id;
		if (!$this->Measure->exists()) {
			throw new NotFoundException(__('Invalid measure'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Measure->delete()) {
			$this->Session->setFlash(__('The measure has been deleted.'));
		} else {
			$this->Session->setFlash(__('The measure could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
