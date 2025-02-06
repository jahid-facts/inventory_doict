<?php
App::uses('AppController', 'Controller');
/**
 * Purchasedetails Controller
 *
 * @property Purchasedetail $Purchasedetail
 * @property PaginatorComponent $Paginator
 */
class PurchasedetailsController extends AppController {

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
		$this->Purchasedetail->recursive = 0;
		$this->set('purchasedetails', $this->Paginator->paginate());
	}
	
public function purchasereport() {
		$this->loadmodel('Product');
		$products=$this->Product->find('list',array('fields'=>array('id','name')));
		$this->set('products',$products);
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
							   array("DATE_FORMAT(Purchase.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$tomonth ."'")
						    );
						}
						else{
							$conditions['OR'] = array(
								array("DATE_FORMAT(Purchase.created,'%Y-%m-%d') BETWEEN '" .$frommonth ."' AND '" .$frommonth ."'")
							);
						}
					}elseif($param_name =='productname') {
						 $conditions['Purchasedetail.product_id'] = $value;
					}else{
						 $conditions['Content..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->Purchasedetail->recursive = 0;
		$this->paginate = array(
		        'fields'=>array(
		            'Purchasedetail.*',
		            'Purchasename.*',
		            'Supplier.*',
		            'Productname.*'
		           
		         ),
		         'joins'=>array(
		           array(
					   'table'=>'purchases',
					   'alias'=>'Purchasename',
					   'type'=>'LEFT',
					   'conditions'=>'Purchasedetail.purchase_id=Purchasename.id'
					 ),
					 array(
					   'table'=>'suppliers',
					   'alias'=>'Supplier',
					   'type'=>'LEFT',
					   'conditions'=>'Purchasename.supplier_id=Supplier.id'
					 ),
					 array(
					   'table'=>'products',
					   'alias'=>'Productname',
					   'type'=>'LEFT',
					   'conditions'=>'Purchasedetail.product_id=Productname.id'
					 )
		         ),
				'limit' => 10,
				'conditions' => $conditions,
			);
		
		$this->set('purchases', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Purchasedetail->exists($id)) {
			throw new NotFoundException(__('Invalid purchasedetail'));
		}
		$options = array('conditions' => array('Purchasedetail.' . $this->Purchasedetail->primaryKey => $id));
		$this->set('purchasedetail', $this->Purchasedetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Purchasedetail->create();
			if ($this->Purchasedetail->save($this->request->data)) {
				$this->Session->setFlash(__('The purchasedetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchasedetail could not be saved. Please, try again.'));
			}
		}
		$purchases = $this->Purchasedetail->Purchase->find('list');
		$measures = $this->Purchasedetail->Measure->find('list');
        $products = $this->Purchasedetail->Product->find('list');
		$this->set(compact('purchases', 'measures','products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Purchasedetail->exists($id)) {
			throw new NotFoundException(__('Invalid purchasedetail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Purchasedetail->save($this->request->data)) {
				$this->Session->setFlash(__('The purchasedetail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchasedetail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Purchasedetail.' . $this->Purchasedetail->primaryKey => $id));
			$this->request->data = $this->Purchasedetail->find('first', $options);
		}
		$purchases = $this->Purchasedetail->Purchase->find('list');
		$measures = $this->Purchasedetail->Measure->find('list');
		$products = $this->Purchasedetail->Product->find('list');
		$this->set(compact('purchases', 'measures','products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Purchasedetail->id = $id;
		if (!$this->Purchasedetail->exists()) {
			throw new NotFoundException(__('Invalid purchasedetail'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purchasedetail->delete()) {
			$this->Session->setFlash(__('The purchasedetail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The purchasedetail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
