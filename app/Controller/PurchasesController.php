<?php
App::uses('AppController', 'Controller');
/**
 * Purchases Controller
 *
 * @property Purchase $Purchase
 * @property PaginatorComponent $Paginator
 */
class PurchasesController extends AppController {

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
		
		$this->Purchase->recursive = 0;
		$this->paginate = array(
				'limit' => 10,
			);
		
		$this->set('purchases', $this->paginate());
	}
	
	public function purchasereport() {
		$distid=$this->Auth->user(); 
		$authdis=$distid['district_id'];
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
					}else{
						 $conditions['Purchase..'.$param_name] = $value;
					}					
					$this->request->data['Report'][$param_name] = $value;
				}
			}
		}
		$this->Purchase->recursive = 0;
		$this->paginate = array('limit' => 10,'order' => 'Purchase.created DESC','conditions'=>array($conditions,'Purchase.district_id'=>$authdis)); 
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
		$distid=$this->Auth->user(); 
		$authdis=$distid['district_id'];
        $this->Purchase->recursive = 0; 
	    $options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
        $purchase=$this->Purchase->find('first', $options); 
		$this->set('purchase', $purchase); 
        $ext="Purchasedetail.purchase_id='".$purchase['Purchase']['id']."'";
        $purchasedetail=$this->Purchase->Purchasedetail->find('all',array(
			'fields'=>array(
			'Purchasedetail.*',
			'Product.*',
			'Category.name',
 			'SubCategory.name',
 			'Measure.name',
 			'Brand.name',
 			'Size.name',
 			'Color.name',
			),
			'joins'=>array(
				array(
				   'table'=>'products',
				   'alias'=>'Product',
				   'type'=>'LEFT',
				   'conditions'=>'Purchasedetail.product_id=Product.id'
				),array(
				   'table'=>'categories',
				   'alias'=>'Category',
				   'type'=>'LEFT',
				   'conditions'=>'Product.category_id=Category.id'
				),array(
				   'table'=>'categories',
				   'alias'=>'SubCategory',
				   'type'=>'LEFT',
				   'conditions'=>'Product.pcid=SubCategory.id'
				),array(
				   'table'=>'measures',
				   'alias'=>'Measure',
				   'type'=>'LEFT',
				   'conditions'=>'Purchasedetail.measure_id=Measure.id'
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
			'conditions'=>array($ext,'Purchasedetail.district_id'=>$authdis ),
			'recursive'=>-1,
			'group'=>'Purchasedetail.id'
    	));  
		$this->set('purchasedetails',$purchasedetail);          
	}

/**
 * add method
 *
 * @return void
 */
	
    public function checkStock($pid=null,$price=null){
		$this->loadModel('Stock');
		$data=$this->Stock->find('first',array('conditions'=>array('Stock.product_id'=>$pid),'fields'=>array('Stock.id')));
		
		return $data;
		
	}
	public function add() { 
        $this->loadModel('Measure');
        $this->loadModel('Product');   
        $this->loadModel('User'); 
        $distid=$this->Auth->user();
		$authname=$distid['name'];  
		$adminuser = $this->User->find('first',array('fields'=>array('User.name'),'conditions'=>array('User.status'=>1,'User.role_id'=>1,'User.district_id'=>$distid['district_id']),'recursive'=>-1));  
        if ($this->request->is('post')) { 
			$s_id=$this->request->data['Purchase']['supplier_id']; 
			if($this->request->data['Purchase']['supplier_id']==0){
				$this->loadModel('Supplier');
				$suplier['Supplier']['name']=$this->request->data['Purchase']['supplier_other_id'];
				$suplier['Supplier']['mobile']=$this->request->data['Purchase']['mobile'];
				$suplier['Supplier']['email']=$this->request->data['Purchase']['email'];
				$suplier['Supplier']['address']=$this->request->data['Purchase']['address'];
				$suplier['Supplier']['contactperson']="n/a";
				$suplier['Supplier']['status']=1;
				$suplier['Supplier']['district_id']=$distid['district_id'];
				$this->Supplier->create();
                $this->Supplier->save($suplier);
                $suplier_id = $this->Supplier->getInsertID();
                $s_id=$suplier_id;
			}
			
			$this->request->data['Purchase']['supplier_id']=$s_id;
			unset($this->request->data['Purchase']['supplier_other_id']);
				
       		$pdetails=$this->request->data['Purchasedetail'];

            foreach($pdetails as $key=>$pdetail){ 
            	$this->request->data['Purchasedetail'][$key]['ddate']=$this->request->data['Purchase']['created'];
            	unset($this->request->data['Purchasedetail'][$key]['product_code']);
            }
            
            $this->request->data['Purchase']['purchBy']=$authname;
            $this->request->data['Purchase']['approBy']=$adminuser['User']['name'];	
            $this->Purchase->create();
            if ($this->Purchase->saveAssociated($this->request->data)) {
            	$id = $this->Purchase->getInsertID();
                $this->Session->setFlash(__('The purchase has been saved.'));
                return $this->redirect(array('action' => 'view',$id));
            } else {
                    $this->Session->setFlash(__('The purchase could not be saved. Please, try again.'));
            }
        }
        $suppliers = $this->Purchase->Supplier->find('list',array('conditions'=>array('Supplier.district_id'=>$distid['district_id'])));
        $measures = $this->Measure->find('list');
        
        $products = $this->Product->find('all',array('group'=>'Product.id',
    		'fields'=>array(
        		'Product.id',
    			'Product.name',
    			'Brand.name',
    			'Size.name',
    			'Color.name',
   				'Category.name',
        		'SubCategory.name',
    		),
    		'joins'=>array(
							array(
							   'table'=>'categories',
							   'alias'=>'Category',
							   'type'=>'LEFT',
							   'conditions'=>'Product.category_id=Category.id'
							 ),array(
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
							 )
			),
			'recursive'=>-1
		));
      
        $this->set(compact('suppliers','measures','products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->loadModel('Measure');
            $this->loadModel('Product');
            if (!$this->Purchase->exists($id)) {
                    throw new NotFoundException(__('Invalid purchase'));
            }
            if ($this->request->is(array('post', 'put'))) {
            	
            		$pdetails=$this->request->data['Purchasedetail'];
		            foreach($pdetails as $key=>$pdetail){
		            	$this->request->data['Purchasedetail'][$key]['pdate']=$this->request->data['Purchase']['created'];
		            }
	
                    if ($this->Purchase->saveAssociated($this->request->data)) {
                            $this->Session->setFlash(__('The purchase has been saved.'));
                            return $this->redirect(array('action' => 'purchasereport'));
                    } else {
                            $this->Session->setFlash(__('The purchase could not be saved. Please, try again.'));
                    }
            } else {
                    $options = array('conditions' => array('Purchase.' . $this->Purchase->primaryKey => $id));
                    $this->request->data = $this->Purchase->find('first', $options);
            }
            $suppliers = $this->Purchase->Supplier->find('list');
            $measures = $this->Measure->find('list');
            $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
            		'SubCategory.name',
        		),
        		'joins'=>array(
								array(
								   'table'=>'categories',
								   'alias'=>'Category',
								   'type'=>'LEFT',
								   'conditions'=>'Product.category_id=Category.id'
								 ),array(
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
								 )
				),
				'recursive'=>-1
			));
            $purchases = $this->Purchase->find('list');
            $this->set(compact('suppliers','measures','products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Purchase->id = $id;
		if (!$this->Purchase->exists()) {
			throw new NotFoundException(__('Invalid purchase'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Purchase->delete()) {
			$this->Session->setFlash(__('The purchase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The purchase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
