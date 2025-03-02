<?php
App::uses('AppController', 'Controller');
/**
* Stocks Controller
*
* @property Stock $Stock
* @property PaginatorComponent $Paginator
*/
class StocksController extends AppController {

/**
* Components
*
* @var array
*/
public $components = array('Paginator');

public $check=array('1'=>'Approve','2'=>'Reject');

public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow(array('stockarchive'));	
    $this->set ('check',$this->check);
}
    
/**
* index method
*
* @return void
*/
public function index() {


	
	$this->paginate = array(
			'limit' => 1000,
    		'group'=>'Stock.product_id,Product.brand_id,Product.size_id,Product.color_id',
    		'fields'=>array(
    			'SUM(Stock.quantity) AS sqty',
    			'Stock.product_id',
    			'Stock.id',
    			'Stock.ddate',
    			'Product.*',
    			'Brand.*',
    			'Size.*',
    			'Color.*',
   				'Measure.*',
   				'Category.name',
   				'Category.cCode',
                'SubCategory.name',
                'SubCategory.sCode',

    		),
    		'joins'=>array(
							array(
							   'table'=>'products',
							   'alias'=>'Product',
							   'type'=>'LEFT',
							   'conditions'=>'Stock.product_id=Product.id'
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
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Stock.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1
		);
	$this->set('stocks', $this->paginate());
}

public function stock() {
	$sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
		
	$this->set('stockprodcuctps', array());
		
		 $this->loadModel('Product');
         
		 $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.productcode',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
       				'Category.cCode',
            		'SubCategory.name',
            		'SubCategory.sCode',
					'Measure.name'
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
								 ),
								array(
								   'table'=>'measures',
								   'alias'=>'Measure',
								   'type'=>'LEFT',
								   'conditions'=>'Product.measure_id=Measure.id'
								 )
				),
				'recursive'=>-1,
				'conditions'=>$ext
			)
			);
			
			$this->set('stockprodcucts', $products);
                            
                            $this->LoadModel('Category');
                            
                            $categories = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1)));
                            
//                                 echo "<pre>";
//                                 print_r($categories);
//                                 echo "</pre>";
                             
                            $this->set(compact('categories'));

}


public function reorderlist() {
	$sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
		
	$this->set('stockprodcuctps', array());
		
		 $this->loadModel('Product');
         
		 $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.productcode',
        			'Product.limitation',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
       				'Category.cCode',
            		'SubCategory.name',
            		'SubCategory.sCode',
					'Measure.name'
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
								 ),
								array(
								   'table'=>'measures',
								   'alias'=>'Measure',
								   'type'=>'LEFT',
								   'conditions'=>'Product.measure_id=Measure.id'
								 )
				),
				'recursive'=>-1,
				'conditions'=>$ext
			)
			);
			
			$this->set('stockprodcucts', $products);
                            
                            $this->LoadModel('Category');
                            
                            $categories = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1)));
                            
//                                 echo "<pre>";
//                                 print_r($categories);
//                                 echo "</pre>";
                             
                            $this->set(compact('categories'));

}

public function stockreport() {
		
		 $this->loadModel('Product');
		 $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.finalcode',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
            		'SubCategory.name',
					'Measure.name'
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
								 ),
								array(
								   'table'=>'measures',
								   'alias'=>'Measure',
								   'type'=>'LEFT',
								   'conditions'=>'Product.measure_id=Measure.id'
								 )
				),
				'recursive'=>-1
			)
			);
			$this->set('stockprodcucts', $products);

}

public function datewisestock() {
		 $this->loadModel('Product');


		 $this->loadModel('Product');
		 $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.finalcode',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
            		'SubCategory.name',
					'Measure.name'
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
								 ),
								array(
								   'table'=>'measures',
								   'alias'=>'Measure',
								   'type'=>'LEFT',
								   'conditions'=>'Product.measure_id=Measure.id'
								 )
				),
				'recursive'=>-1
			)
			);
			$this->set('stockprodcucts', $products);

		

}

public function stockarchive() {
	
	 $this->loadModel('Product');
	$products = $this->Product->find(
        'all',array(
    		'group'=>'Product.id',
    		'fields'=>array(
        		'Product.id',
    		),
			'recursive'=>-1
		)
		);
		
		
		$this->loadModel('Stockacrchive');
		
		
		
		$archivecheck=$this->Stockacrchive->find('first',array('recursive'=>-1,'fields'=>array('id')));
	
		$cdate=date('Y-m-d');
		
		$pdate=date('Y-m-d', strtotime('-1 days'));
		
		if(!empty($archivecheck['Stockacrchive']['id'])){
			
			foreach ($products as $stock){
				$pid=$stock['Product']['id'];
				$closebalance=$this->Stockacrchive->find('first',array('conditions'=>array('product_id'=>$pid,'sdate'=>$pdate),'recursive'=>-1,'fields'=>array('balance')));
				
				if(!empty($closebalance['Stockacrchive']['balance'])){
					$sql  = "SELECT pt.id, d.dquantity, p.pquantity FROM products 
					AS pt LEFT JOIN 
					( 
						SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
						FROM purchasedetails WHERE purchasedetails.ddate='".$cdate."' GROUP BY purchasedetails.product_id 
					)
					 AS p ON pt.id = p.product_id LEFT JOIN 
					( 
						SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
						FROM deliverydetails WHERE deliverydetails.ddate='".$cdate."' GROUP BY deliverydetails.product_id 
					)
					AS d ON pt.id = d.product_id 
					WHERE pt.id='".$pid."'
					GROUP BY pt.id 
					";
					$data = getQueryData($sql);
					$stockIn=$data['pquantity']+$closebalance['Stockacrchive']['balance'];
					$stockOut=$data['dquantity'];
					$balance=$stockIn-$stockOut;
				}else{
					$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity FROM products 
					AS pt LEFT JOIN
					( 
						SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
						FROM stocks GROUP BY stocks.product_id 
					) 
					AS s ON pt.id = s.product_id LEFT JOIN 
					( 
						SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
						FROM purchasedetails GROUP BY purchasedetails.product_id 
					)
					 AS p ON pt.id = p.product_id LEFT JOIN 
					( 
						SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
						FROM deliverydetails GROUP BY deliverydetails.product_id 
					)
					AS d ON pt.id = d.product_id 
					WHERE pt.id='".$pid."'
					GROUP BY pt.id 
					";
					
					$data = getQueryData($sql);
					$stockIn=$data['squantity']+$data['pquantity'];
					$stockOut=$data['dquantity'];
					$balance=$stockIn-$stockOut;
					
				}
					
			
				$this->request->data['Stockacrchive']['product_id']=$pid;
				$this->request->data['Stockacrchive']['stockIn']=$stockIn;
				$this->request->data['Stockacrchive']['stockOut']=$stockOut;
				$this->request->data['Stockacrchive']['balance']=$balance;
				$this->request->data['Stockacrchive']['sdate']=date('Y-m-d');
				
				$ck=$this->Stockacrchive->find('first',array('conditions'=>array('product_id'=>$pid,'sdate'=>$cdate),'recursive'=>-1,'fields'=>array('balance')));
				if(empty($ck['Stockacrchive']['balance'])){
					$this->Stockacrchive->create();
					$this->Stockacrchive->save($this->request->data);
				}
			}
			
		}else{
			foreach ($products as $stock){
		
				$pid=$stock['Product']['id'];
			
				
				$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity FROM products 
				AS pt LEFT JOIN
				( 
					SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
					FROM stocks GROUP BY stocks.product_id 
				) 
				AS s ON pt.id = s.product_id LEFT JOIN 
				( 
					SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
					FROM purchasedetails GROUP BY purchasedetails.product_id 
				)
				 AS p ON pt.id = p.product_id LEFT JOIN 
				( 
					SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
					FROM deliverydetails GROUP BY deliverydetails.product_id 
				)
				AS d ON pt.id = d.product_id 
				WHERE pt.id='".$pid."'
				GROUP BY pt.id 
				";
				
				$data = getQueryData($sql);
				$stockIn=$data['squantity']+$data['pquantity'];
				$stockOut=$data['dquantity'];
				$balance=$stockIn-$stockOut;
			
				$this->request->data['Stockacrchive']['product_id']=$pid;
				$this->request->data['Stockacrchive']['stockIn']=$stockIn;
				$this->request->data['Stockacrchive']['stockOut']=$stockOut;
				$this->request->data['Stockacrchive']['balance']=$balance;
				$this->request->data['Stockacrchive']['sdate']=$cdate;
				
				$this->Stockacrchive->create();
				$this->Stockacrchive->save($this->request->data);
				
			}
			
		}
}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
	if (!$this->Stock->exists($id)) {
		throw new NotFoundException(__('Invalid stock'));
	}
	$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
	$this->set('stock', $this->Stock->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
	if ($this->request->is('post')) {
		$this->Stock->create();
		if ($this->Stock->save($this->request->data)) {
			$this->Session->setFlash(__('The opening stock has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The opening stock could not be saved. Please, try again.'));
		}
	}
	$products = $this->Stock->Product->find(
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
				'Measure.name'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
		)
		);
 $this->set('prod', $products);
	$measures = $this->Stock->Measure->find('list');
	$this->set(compact( 'measures'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
	if (!$this->Stock->exists($id)) {
		throw new NotFoundException(__('Invalid stock'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->Stock->save($this->request->data)) {
			$this->Session->setFlash(__('The opening stock has been updated.')); 
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The stock could not be saved. Please, try again.'));
		}
	} else {
		$options = array('conditions' => array('Stock.' . $this->Stock->primaryKey => $id));
		$this->request->data = $this->Stock->find('first', $options);
	}


	$products = $this->Stock->Product->find(
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
				'Measure.name'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
		)
		);

     $this->set('prod', $products);
	$measures = $this->Stock->Measure->find('list');
	$this->set(compact('measures'));
}

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function delete($id = null) {
	$this->Stock->id = $id;
	if (!$this->Stock->exists()) {
		throw new NotFoundException(__('Invalid stock'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->Stock->delete()) {
		$this->Session->setFlash(__('The stock has been deleted.'));
	} else {
		$this->Session->setFlash(__('The stock could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}
    
    
    
    
  public function stockrequisition(){
  	$this->loadModel('Product');
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

			 
			if(!in_array($param_name, array('page','sort','direction','limit'))){
				if($param_name =='category_id'){
					 $conditions['Product.category_id'] = $value;
					
				}elseif($param_name =='subcategory') {
					 $conditions['Product.pcid'] = $value;
				}elseif($param_name =='id') {
					 $conditions['Product.id'] = $value;
				}else{
					 $conditions['Stock.'.$param_name] = $value;
				}					
				$this->request->data['Report'][$param_name] = $value;
			}
		}
	}


		
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
				'Measure.name'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
			'conditions'=>$conditions
		)
		);
		
		$this->set('stocks', $products);


	if(!empty($this->request->data['Report']['category_id'])){
		$this->set('product',$this->Product->find('list',array('fields'=>array('id','name'),'conditions' =>
                        array('pcid' =>$this->request->data['Report']['category_id']),
                        'recursive' => -1)));
	}
 
	$this->set('products', $this->paginate());
  	    if ($this->request->is(array('post', 'put'))) {
		
  	    $stid=$this->request->data['Stock'];
		$fsti=array();

      foreach($stid as $stids){
			$fsti[$stids['code']]=$stids['code'];
      }

		$cat_sid=implode(',',$fsti);
		$this->Session->write('cat_sid',$cat_sid);

		return $this->redirect(array('action' => 'requsition'));

        }
                    
        $this->loadModel('Category');

		
		 
	$categories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));

/*	echo p($categories);
	die();*/

	$this->set('categories',$categories); 
}

public function atcrequisition0() {
    $sadte = $eadte = null;
    $current = 1;
    $ext = "1=1";

    if (!empty($this->request->data['Report']['id'])) {
        $pid = $this->request->data['Report']['id'];
        $ext .= " AND Product.id=" . $pid;
    }

    $this->set('stockprodcuctps', array());

    $this->loadModel('Product');

    $products = $this->Product->find('all', array(
        'group' => 'Product.id',
        'fields' => array(
            'Product.id',
            'Product.name',
            'Product.productcode',
            'Brand.name',
            'Size.name',
            'Color.name',
            'Category.name',
            'Category.cCode',
            'SubCategory.name',
            'SubCategory.sCode',
            'Measure.name',
            'Measure.id',
            '(
                IFNULL(SUM(Stock.quantity), 0)
                + IFNULL(SUM(Purchasedetail.quantity), 0)
                - IFNULL(SUM(Deliverydetail.quantity), 0)
                - IFNULL(SUM(Requisitiondetail.quantity), 0)
                + IFNULL(SUM(Requisitionreturn.quantity), 0)
                - IFNULL(SUM(Damage.quantity), 0)
            ) AS currentStock'
        ),
        'joins' => array(
            array(
                'table' => 'categories',
                'alias' => 'Category',
                'type' => 'LEFT',
                'conditions' => 'Product.category_id = Category.id'
            ),
            array(
                'table' => 'categories',
                'alias' => 'SubCategory',
                'type' => 'LEFT',
                'conditions' => 'Product.pcid = SubCategory.id'
            ),
            array(
                'table' => 'brands',
                'alias' => 'Brand',
                'type' => 'LEFT',
                'conditions' => 'Product.brand_id = Brand.id'
            ),
            array(
                'table' => 'sizes',
                'alias' => 'Size',
                'type' => 'LEFT',
                'conditions' => 'Product.size_id = Size.id'
            ),
            array(
                'table' => 'colors',
                'alias' => 'Color',
                'type' => 'LEFT',
                'conditions' => 'Product.color_id = Color.id'
            ),
            array(
                'table' => 'measures',
                'alias' => 'Measure',
                'type' => 'LEFT',
                'conditions' => 'Product.measure_id = Measure.id'
            ),
            array(
                'table' => 'stocks',
                'alias' => 'Stock',
                'type' => 'LEFT',
                'conditions' => 'Product.id = Stock.product_id'
            ),
            array(
                'table' => 'purchasedetails',
                'alias' => 'Purchasedetail',
                'type' => 'LEFT',
                'conditions' => 'Product.id = Purchasedetail.product_id'
            ),
            array(
                'table' => 'deliverydetails',
                'alias' => 'Deliverydetail',
                'type' => 'LEFT',
                'conditions' => 'Product.id = Deliverydetail.product_id'
            ),
            array(
                'table' => 'requisitionreturns',
                'alias' => 'Requisitionreturn',
                'type' => 'LEFT',
                'conditions' => 'Product.id = Requisitionreturn.product_id'
            ),
            array(
                'table' => 'requisitiondetails',
                'alias' => 'Requisitiondetail',
                'type' => 'LEFT',
                'conditions' => array(
                    'Product.id = Requisitiondetail.product_id',
                    'Requisitiondetail.status !=' => 3
                )
            ),
            array(
                'table' => 'damages',
                'alias' => 'Damage',
                'type' => 'LEFT',
                'conditions' => 'Product.id = Damage.product_id'
            )
        ),
        'recursive' => -1,
        'conditions' => array($ext),
        'having' => array(
            'currentStock >= 1'
        )
    ));
	
    $this->set('stockprodcucts', $products);

    $this->LoadModel('Category');

    $categories = $this->Category->find('all', array('conditions' => array('Category.parent_id' => -1)));

    $this->set(compact('categories'));
}

public function atcrequisition(){
  	$sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
		
	$this->set('stockprodcuctps', array());
		
	$this->loadModel('Product');
     
	$products = $this->Product->find(
        'all',array(
    		'group'=>'Product.id',
    		'fields'=>array(
        		'Product.id',
    			'Product.name',
    			'Product.productcode',
    			'Brand.name',
    			'Size.name',
    			'Color.name',
   				'Category.name',
   				'Category.cCode',
        		'SubCategory.name',
        		'SubCategory.sCode',
				'Measure.name',
				'Measure.id'
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
				 ),
				array(
				   'table'=>'measures',
				   'alias'=>'Measure',
				   'type'=>'LEFT',
				   'conditions'=>'Product.measure_id=Measure.id'
				 )),
			'recursive'=>-1,
			'conditions'=>$ext
		));
			
	$this->set('stockprodcucts', $products);
                            
    $this->LoadModel('Category');
    
    $categories = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1))); 
     
    $this->set(compact('categories'));
}

public function atcrequisitionCustome(){
  	$this->loadModel('Product');
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

			 
			if(!in_array($param_name, array('page','sort','direction','limit'))){
				if($param_name =='category_id'){
					 $conditions['Product.category_id'] = $value;
					
				}elseif($param_name =='subcategory') {
					 $conditions['Product.pcid'] = $value;
				}elseif($param_name =='id') {
					 $conditions['Product.id'] = $value;
				}else{
					 $conditions['Stock.'.$param_name] = $value;
				}					
				$this->request->data['Report'][$param_name] = $value;
			}
		}
	}


		
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
				'Measure.name'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
			'conditions'=>$conditions
		)
		);
		
		$this->set('stocks', $products);


	if(!empty($this->request->data['Report']['category_id'])){
		$this->set('product',$this->Product->find('list',array('fields'=>array('id','name'),'conditions' =>
                        array('pcid' =>$this->request->data['Report']['category_id']),
                        'recursive' => -1)));
	}
 
	$this->set('products', $this->paginate());
  	    if ($this->request->is(array('post', 'put'))) {
		
  	    $stid=$this->request->data['Stock'];
		$fsti=array();

      foreach($stid as $stids){
			$fsti[$stids['code']]=$stids['code'];
      }

		$cat_sid=implode(',',$fsti);
		$this->Session->write('cat_sid',$cat_sid);

		return $this->redirect(array('action' => 'requsition'));

        }
                    
        $this->loadModel('Category');

		
		 
	$categories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1))); 

	$this->set('categories',$categories); 
}

public function availablestock0(){
  	$sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
		
	$this->set('stockprodcuctps', array());
		
	$this->loadModel('Product');
         
	$products = $this->Product->find('all', array(
		'group' => 'Product.id',
		'fields' => array(
			'Product.id',
			'Product.name',
			'Product.productcode',
			'Brand.name',
			'Size.name',
			'Color.name',
			'Category.name',
			'Category.cCode',
			'SubCategory.name',
			'SubCategory.sCode',
			'Measure.name',
			'Measure.id',
			'(
				IFNULL(SUM(Stock.quantity), 0)
				+ IFNULL(SUM(Purchasedetail.quantity), 0)
				- IFNULL(SUM(Deliverydetail.quantity), 0)
				- IFNULL(SUM(Requisitiondetail.quantity), 0)
				+ IFNULL(SUM(Requisitionreturn.quantity), 0)
				- IFNULL(SUM(Damage.quantity), 0)
			) AS currentStock'
		),
		'joins' => array(
			array(
				'table' => 'categories',
				'alias' => 'Category',
				'type' => 'LEFT',
				'conditions' => 'Product.category_id = Category.id'
			),
			array(
				'table' => 'categories',
				'alias' => 'SubCategory',
				'type' => 'LEFT',
				'conditions' => 'Product.pcid = SubCategory.id'
			),
			array(
				'table' => 'brands',
				'alias' => 'Brand',
				'type' => 'LEFT',
				'conditions' => 'Product.brand_id = Brand.id'
			),
			array(
				'table' => 'sizes',
				'alias' => 'Size',
				'type' => 'LEFT',
				'conditions' => 'Product.size_id = Size.id'
			),
			array(
				'table' => 'colors',
				'alias' => 'Color',
				'type' => 'LEFT',
				'conditions' => 'Product.color_id = Color.id'
			),
			array(
				'table' => 'measures',
				'alias' => 'Measure',
				'type' => 'LEFT',
				'conditions' => 'Product.measure_id = Measure.id'
			),
			array(
				'table' => 'stocks',
				'alias' => 'Stock',
				'type' => 'LEFT',
				'conditions' => 'Product.id = Stock.product_id'
			),
			array(
				'table' => 'purchasedetails',
				'alias' => 'Purchasedetail',
				'type' => 'LEFT',
				'conditions' => 'Product.id = Purchasedetail.product_id'
			),
			array(
				'table' => 'deliverydetails',
				'alias' => 'Deliverydetail',
				'type' => 'LEFT',
				'conditions' => 'Product.id = Deliverydetail.product_id'
			),
			array(
				'table' => 'requisitionreturns',
				'alias' => 'Requisitionreturn',
				'type' => 'LEFT',
				'conditions' => 'Product.id = Requisitionreturn.product_id'
			),
			array(
				'table' => 'requisitiondetails',
				'alias' => 'Requisitiondetail',
				'type' => 'LEFT',
				'conditions' => array(
					'Product.id = Requisitiondetail.product_id',
					'Requisitiondetail.status !=' => 3
				)
			),
			array(
				'table' => 'damages',
				'alias' => 'Damage',
				'type' => 'LEFT',
				'conditions' => 'Product.id = Damage.product_id'
			)
		),
		'recursive' => -1,
		'conditions' => array($ext),
		'having' => array(
			'currentStock >= 1'
		)
	));
			
	$this->set('stockprodcucts', $products);
                    
    $this->LoadModel('Category');
    
    $categories = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1))); 
    $this->set(compact('categories'));
}

public function availablestock(){
  	$sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
	
		
		 $this->loadModel('Product');
         
		 $products = $this->Product->find(
            'all',array(
        		'group'=>'Product.id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.productcode',
        			'Brand.name',
        			'Size.name',
        			'Color.name',
       				'Category.name',
       				'Category.cCode',
            		'SubCategory.name',
            		'SubCategory.sCode',
					'Measure.name'
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
				 ),
				array(
				   'table'=>'measures',
				   'alias'=>'Measure',
				   'type'=>'LEFT',
				   'conditions'=>'Product.measure_id=Measure.id'
				 )
			),
			'recursive'=>-1,
			'conditions'=>$ext
		));
			
	$this->set('stockprodcucts', $products);
                    
    $this->LoadModel('Category');
    
    $categories = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1))); 
    $this->set(compact('categories'));
}

public function requsition(){
	$this->set(compact('stocks'));
	$this->loadModel('Measure');
	$this->loadModel('Requisition');
	$this->loadModel('Product');
	$this->Stock->recursive = 0;
	$cat_sid=$this->Session->read('cat_sid');
	$getsid="Product.id IN($cat_sid)";
			
			
	
	$stocks = $this->Product->find(
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
				'Measure.name',
				'Measure.id'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
			'conditions'=>$getsid
		)
		);
		
		
		$measures=$this->Measure->find('list',array('fields'=>array('id','name')));
		$this->loadModel('User');
		$users=$this->User->find('first',array('conditions'=>array('User.id'=>$this->Auth->user('id')),'recursive'=>0));
	
	
	$this->set(compact('stocks','measures','users'));

	
	
}
    public function dashboardrequisitioner(){
  	$this->loadModel('Product');
	
		
		
		$this->loadModel('Requisition');
		$this->loadModel('Requisitiondetail');
		$this->loadModel('Delivery');
                    
		$role_id=$this->Auth->user('role_id');
                    
    if($role_id==3){

        $id=$this->Auth->user('id');
        $totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array('Requisition.user_id'=>$id)));
        

        $approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>2,'Requisition.user_id'=>$id)));
     	

     	$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>4,'Requisition.user_id'=>$id)));
		

		$rejectedecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>3,'Requisition.user_id'=>$id)));
		
		$rejectedecount=$this->Requisitiondetail->find(
			'count',
			array(
				'fields'=>array('id'),
				'recursive'=>-1,
				 'joins'=>array(
		           array(
					   'table'=>'requisitions',
					   'alias'=>'Requisition',
					   'type'=>'LEFT',
					   'conditions'=>'Requisitiondetail.requisition_id=Requisition.id'
					 ),
		         ),
				'conditions'=>array(' Requisitiondetail.status'=>3,'Requisition.user_id'=>$id)
			)
		);

		$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1,'Requisition.user_id'=>$id)));



	


		$delivery=$this->Delivery->find(
		'count',
		array(
			'conditions'=>array(
			'Requisition.user_id'=>$id,'Requisition.status'=>4
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

                        
                        
                    }else{
                        
                         $ext="Requisition.status=2";
                         $totalreqcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1)));
                         $approvedcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>2)));
     	$deliveredecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>4)));
		$rejectedecount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>3)));
		$pendingcount=$this->Requisition->find('count',array('fields'=>array('id'),'conditions'=>array(' Requisition.status'=>1)));
                         
                    }
                    
        
                
		$this->set(compact('delivery','totalreqcount','approvedcount','deliveredecount','rejectedecount','pendingcount'));
		
		
		
		
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

			 
			if(!in_array($param_name, array('page','sort','direction','limit'))){
				if($param_name =='category_id'){
					 $conditions['Product.category_id'] = $value;
					
				}elseif($param_name =='subcategory') {
					 $conditions['Product.pcid'] = $value;
				}elseif($param_name =='id') {
					 $conditions['Product.id'] = $value;
				}else{
					 $conditions['Stock..'.$param_name] = $value;
				}					
				$this->request->data['Report'][$param_name] = $value;
			}
		}
	}


		
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
				'Measure.name'
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
							 ),
							array(
							   'table'=>'measures',
							   'alias'=>'Measure',
							   'type'=>'LEFT',
							   'conditions'=>'Product.measure_id=Measure.id'
							 )
			),
			'recursive'=>-1,
			'conditions'=>$conditions
		)
		);
		
		$this->set('stocks', $products);
		 



	if(!empty($this->request->data['Report']['category_id'])){
		$this->set('product',$this->Product->find('list',array('fields'=>array('id','name'),'conditions' =>
                        array('pcid' =>$this->request->data['Report']['category_id']),
                        'recursive' => -1)));
	}
 
	$this->set('products', $this->paginate());
  	    if ($this->request->is(array('post', 'put'))) {
		
  	    $stid=$this->request->data['Stock'];
		$fsti=array();

      foreach($stid as $stids){
			$fsti[$stids['code']]=$stids['code'];
      }

		$cat_sid=implode(',',$fsti);
		$this->Session->write('cat_sid',$cat_sid);

		return $this->redirect(array('action' => 'requsition'));

        }
                    
        $this->loadModel('Category');

		
		 
	$categories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));

/*	echo p($categories);
	die();*/

	$this->set('categories',$categories); 
}
    
    public function repeatorder(){
            $sadte=$eadte=null;
	$current=1;
	$ext="1=1";

	if(!empty($this->request->data['Report']['id'])){
		$pid=$this->request->data['Report']['id'];
		$ext.=" AND Product.id=".$pid."";
	}
		
	$this->set('stockprodcuctps', array());
		
		 $this->loadModel('Product');
         
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
					'Measure.name'
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
                                         ),
                                        array(
                                           'table'=>'measures',
                                           'alias'=>'Measure',
                                           'type'=>'LEFT',
                                           'conditions'=>'Product.measure_id=Measure.id'
                                         )
				),
				'recursive'=>-1,
				'conditions'=>$ext
			)
			);
			
			$this->set('stockprodcucts', $products);

}

	public function getcategory(){
		$this->layout='ajax';
		if($_REQUEST['id']>=0){
			if($_REQUEST['id']==0){
				$ext="1=1";
				$ext.=" AND Product.category_id > 0";
			}else{
				$ext="1=1";
				$ext.=" AND Product.category_id=".$_REQUEST['id']."";
			}
				

		
		
			$this->loadModel('Product');
			$products = $this->Product->find(
				'all',array(
					'group'=>'Product.id',
						'fields'=>array(
						'Product.id',
						'Product.name',
						'Product.productcode',
						'Brand.name',
						'Size.name',
						'Color.name',
						'Category.name',
						'Category.cCode',
						'SubCategory.name',
						'SubCategory.sCode',
						'Measure.name',
						'Measure.id'
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
											),
											array(
											'table'=>'measures',
											'alias'=>'Measure',
											'type'=>'LEFT',
											'conditions'=>'Product.measure_id=Measure.id'
											)
					),
					'recursive'=>-1,
					'conditions'=>$ext
				)
				);
				
				$this->set('stockprodcucts', $products);
		}	
	}

	public function getavailablestockbycategory(){
		$this->layout='ajax';
		if($_REQUEST['id']>=0){
			if($_REQUEST['id']==0){
				$ext="1=1";
				$ext.=" AND Product.category_id > 0";
			}else{
				$ext="1=1";
				$ext.=" AND Product.category_id=".$_REQUEST['id']."";
			}
			
			$this->loadModel('Product');

			$products = $this->Product->find('all', array(
				'group' => 'Product.id',
				'fields' => array(
					'Product.id',
					'Product.name',
					'Product.productcode',
					'Brand.name',
					'Size.name',
					'Color.name',
					'Category.name',
					'Category.cCode',
					'SubCategory.name',
					'SubCategory.sCode',
					'Measure.name',
					'Measure.id'
				),
				'joins' => array(
					array(
						'table' => 'categories',
						'alias' => 'Category',
						'type' => 'LEFT',
						'conditions' => 'Product.category_id = Category.id'
					),
					array(
						'table' => 'categories',
						'alias' => 'SubCategory',
						'type' => 'LEFT',
						'conditions' => 'Product.pcid = SubCategory.id'
					),
					array(
						'table' => 'brands',
						'alias' => 'Brand',
						'type' => 'LEFT',
						'conditions' => 'Product.brand_id = Brand.id'
					),
					array(
						'table' => 'sizes',
						'alias' => 'Size',
						'type' => 'LEFT',
						'conditions' => 'Product.size_id = Size.id'
					),
					array(
						'table' => 'colors',
						'alias' => 'Color',
						'type' => 'LEFT',
						'conditions' => 'Product.color_id = Color.id'
					),
					array(
						'table' => 'measures',
						'alias' => 'Measure',
						'type' => 'LEFT',
						'conditions' => 'Product.measure_id = Measure.id'
					)
				),
				'recursive' => -1,
				'conditions' => $ext
			));
				
			$this->set('stockprodcucts', $products);
		}	
	}

	public function getcategorycart0(){
		$this->layout='ajax';
		if($_REQUEST['id']>=0){
			if($_REQUEST['id']==0){
				$ext="1=1";
				$ext.=" AND Product.category_id > 0";
			}else{
				$ext="1=1";
				$ext.=" AND Product.category_id=".$_REQUEST['id']."";
			}
			
			$this->loadModel('Product');

			$products = $this->Product->find('all', array(
				'group' => 'Product.id',
				'fields' => array(
					'Product.id',
					'Product.name',
					'Product.productcode',
					'Brand.name',
					'Size.name',
					'Color.name',
					'Category.name',
					'Category.cCode',
					'SubCategory.name',
					'SubCategory.sCode',
					'Measure.name',
					'Measure.id',
					'(
						IFNULL(SUM(Stock.quantity), 0)
						+ IFNULL(SUM(Purchasedetail.quantity), 0)
						- IFNULL(SUM(Deliverydetail.quantity), 0)
						- IFNULL(SUM(Requisitiondetail.quantity), 0)
						+ IFNULL(SUM(Requisitionreturn.quantity), 0)
						- IFNULL(SUM(Damage.quantity), 0)
					) AS currentStock'
				),
				'joins' => array(
					array(
						'table' => 'categories',
						'alias' => 'Category',
						'type' => 'LEFT',
						'conditions' => 'Product.category_id = Category.id'
					),
					array(
						'table' => 'categories',
						'alias' => 'SubCategory',
						'type' => 'LEFT',
						'conditions' => 'Product.pcid = SubCategory.id'
					),
					array(
						'table' => 'brands',
						'alias' => 'Brand',
						'type' => 'LEFT',
						'conditions' => 'Product.brand_id = Brand.id'
					),
					array(
						'table' => 'sizes',
						'alias' => 'Size',
						'type' => 'LEFT',
						'conditions' => 'Product.size_id = Size.id'
					),
					array(
						'table' => 'colors',
						'alias' => 'Color',
						'type' => 'LEFT',
						'conditions' => 'Product.color_id = Color.id'
					),
					array(
						'table' => 'measures',
						'alias' => 'Measure',
						'type' => 'LEFT',
						'conditions' => 'Product.measure_id = Measure.id'
					),
					array(
						'table' => 'stocks',
						'alias' => 'Stock',
						'type' => 'LEFT',
						'conditions' => 'Product.id = Stock.product_id'
					),
					array(
						'table' => 'purchasedetails',
						'alias' => 'Purchasedetail',
						'type' => 'LEFT',
						'conditions' => 'Product.id = Purchasedetail.product_id'
					),
					array(
						'table' => 'deliverydetails',
						'alias' => 'Deliverydetail',
						'type' => 'LEFT',
						'conditions' => 'Product.id = Deliverydetail.product_id'
					),
					array(
						'table' => 'requisitionreturns',
						'alias' => 'Requisitionreturn',
						'type' => 'LEFT',
						'conditions' => 'Product.id = Requisitionreturn.product_id'
					),
					array(
						'table' => 'requisitiondetails',
						'alias' => 'Requisitiondetail',
						'type' => 'LEFT',
						'conditions' => array(
							'Product.id = Requisitiondetail.product_id',
							'Requisitiondetail.status !=' => 3
						)
					),
					array(
						'table' => 'damages',
						'alias' => 'Damage',
						'type' => 'LEFT',
						'conditions' => 'Product.id = Damage.product_id'
					)
				),
				'recursive' => -1,
				'conditions' => array($ext),
				'having' => array(
					'currentStock >= 1'
				)
			));
				
			$this->set('stockprodcucts', $products);
		}	
	}

	public function getcategorycart(){
		$this->layout='ajax';
		if($_REQUEST['id']>=0){
			if($_REQUEST['id']==0){
				$ext="1=1";
				$ext.=" AND Product.category_id > 0";
			}else{
				$ext="1=1";
				$ext.=" AND Product.category_id=".$_REQUEST['id']."";
			}
			
			$this->loadModel('Product');
	
			 $products = $this->Product->find(
				'all',array(
					'group'=>'Product.id',
						'fields'=>array(
						'Product.id',
						'Product.name',
						'Product.productcode',
						'Brand.name',
						'Size.name',
						'Color.name',
						   'Category.name',
						   'Category.cCode',
						'SubCategory.name',
						'SubCategory.sCode',
						'Measure.name',
						'Measure.id'
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
						),
						array(
							'table'=>'measures',
							'alias'=>'Measure',
							'type'=>'LEFT',
							'conditions'=>'Product.measure_id=Measure.id'
						)
					),
					'recursive'=>-1,
					'conditions'=>$ext
				)
				);
				
			$this->set('stockprodcucts', $products);
		}	
	}
	 
	public function getbalance(){
		
	}


}
