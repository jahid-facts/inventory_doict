<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
   public $components = array('Paginator','Cms');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		$categories = $this->Product->Category->find('all',array('fields'=>array('Category.id','Category.name','Category.sCode'),'recursive'=>-1));

		$this->set(compact('categories'));
		$this->set('products', $this->Paginator->paginate());
	}

	public function padjustment() {
		$this->loadModel('User');
		$distid=$this->Auth->user(); 
		$authname=$distid['name'];  
		$adminuser = $this->User->find('first',array('fields'=>array('User.name'),'conditions'=>array('User.status'=>1,'User.role_id'=>1,'User.district_id'=>$distid['district_id']),'recursive'=>-1));  
		if ($this->request->is('post')) { 
			$this->loadModel('Damage');
			$dat=$this->request->data['Damages'];
			$data=$this->request->data['Damage']; 
			$bool=false;
			$ext="";
			
	        if (!empty($dat['attach']['tmp_name'])) { 
				$filename = $dat['attach']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION); 
			}
			foreach($data as $datas){ 
				unset($datas['product_code']);
				unset($datas['measure_name']);
				unset($datas['product_name']); 

           	    $datasd['Damage']['dnumber']=$this->request->data['Damages']['dnumber'];	
           	    $datasd['Damage']['ext']=$ext;	
				$datasd['Damage']['rnumber']=$this->request->data['Damages']['rnumber'];
				$datasd['Damage']['ddate']=date('Y-m-d');
				$datasd['Damage']['product_id']=$datas['product_id'];
				$datasd['Damage']['measure_id']=$datas['measure_id'];
				$datasd['Damage']['quantity']=$datas['quantity'];
				$datasd['Damage']['type']=$datas['type'];
				$datasd['Damage']['district_id']=$datas['district_id']; 
				$datasd['Damage']['adjBye']=$authname;
				$datasd['Damage']['appBye']=$adminuser['User']['name'];
				$this->Damage->create(); 
	            if($this->Damage->save($datasd)){
					$bool=true;
				}
			}

			if($bool){ 
				$id = $this->request->data['Damages']['dnumber']; 
				if(!empty($this->request->data['Damages']['attach']['tmp_name'])) {
					$this->Cms->uploadFile($this->request->data['Damages']['attach'], $id, 'damage' );
			   	}
				$this->Session->setFlash(__('The product has been adjusted.'));
				return $this->redirect(array('controller'=>'damages','action' => 'view',$id));
			}else{
				$this->Session->setFlash(__('The product could not be adjusted. Please, try again.'));
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
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Size');
		if ($this->request->is('post')) {
			
			$category_id=$this->request->data['Product']['category_id'];
			$subcategory=$this->request->data['Product']['subcategoryid'];

			$code=$this->request->data['Product']['productcode'];
			$codecheck=$this->Product->codeVerify($code,$category_id,$subcategory);

			if($codecheck>0){
				$this->Session->setFlash(__('The product code already exist.'));
				return $this->redirect(array('action' => 'add'));
			}

			$catcode=$this->Product->Category->setcode($category_id,'cat');

			$subcatcode=$this->Product->Category->setcode($subcategory,'subcat');

			$finalcode=$catcode.$subcatcode.$code;
			$this->request->data['Product']['finalcode']=$finalcode;
	
			$this->request->data['Product']['category_id']=$category_id;
			
			$this->request->data['Product']['pcid']=$subcategory;
			/*p($this->request->data);
			die();*/
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		
	 
    }
     
		$categories = $this->Product->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
		 
		$measures = $this->Product->Measure->find('list');
		$brands = $this->Product->Brand->find('list');

		$sizes = $this->Product->Size->find('list');
		$colors = $this->Product->Color->find('list');
		$this->set(compact('categories','brands','colors','sizes','measures'));
	} 

	public function addmodal() { 
            
        $this->layout="modal";
		if ($this->request->is('post')) {
			$products = $this->Product->find('first',array('fields'=>array('Product.name','Product.brand_id','Product.size_id','Product.color_id'),'conditions'=>array('BINARY(Product.name)'=>$this->request->data['Product']['name'],'Product.brand_id'=>$this->request->data['Product']['brand_id'],'Product.size_id'=>$this->request->data['Product']['size_id'],'Product.size_id'=>$this->request->data['Product']['color_id'])));
		if(!empty($products['Product']['name'])){
		   $this->Session->setFlash(__('The product could not be saved. Please, try again.'));
		}else{
			 $pcid=$this->request->data['Product']['category_id'];
			$category_id=$this->request->data['Product']['subcategory'];
	
			$this->request->data['Product']['category_id']=$pcid;
			
			$this->request->data['Product']['pcid']=$category_id;
			
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
	 
    }
		$categories = $this->Product->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
		$measures = $this->Product->Measure->find('list');

		$brands = $this->Product->Brand->find('list');
		$sizes = $this->Product->Size->find('list');
		$colors = $this->Product->Color->find('list');
	
		$this->set(compact('categories','brands','sizes','colors','products','measures'));
	}

	public function getprice(){
	    $this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
	 		$this->set('price',$this->Product->find('first',array('fields'=>array('id','price'),
	 															'conditions'=>array('id'=>$_REQUEST['id']),
                       											 'recursive' => -1)));
		 }	
	}

	public function getproduct(){
		$this->autoRender = false;
		$data = $_REQUEST['pid'];
		$getpro = $this->Product->find(
				'list',
				array('fields'=>array('id','name'),'recursive'=>-1, 'conditions'=>array('Product.pcid'=>$data))
			);
		return json_encode($getpro);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	 

	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			

			$category_id=$this->request->data['Product']['category_id'];
			$subcategory=$this->request->data['Product']['pcid'];
			$code=$this->request->data['Product']['productcode'];


			$ccategory_id=$this->request->data['Product']['ccategory_id'];
			$csubcategory=$this->request->data['Product']['cpcid'];
			$ccode=$this->request->data['Product']['cproductcode'];


			unset($this->request->data['Product']['ccategory_id']);
			unset($this->request->data['Product']['cpcid']);
			unset($this->request->data['Product']['cproductcode']);

			if($category_id==$ccategory_id && $subcategory==$csubcategory && $code==$ccode){

			}else{
				$codecheck=$this->Product->codeVerify($code,$category_id,$subcategory);
				if($codecheck>0){
					$this->Session->setFlash(__('The product code already exist.'));
					return $this->redirect(array('action' => 'edit',$id));
				}
			}
			

			$catcode=$this->Product->Category->setcode($category_id,'cat');

			$subcatcode=$this->Product->Category->setcode($subcategory,'subcat');

			$finalcode=$catcode.$subcatcode.$code;
			$this->request->data['Product']['finalcode']=$finalcode;
	
			$this->request->data['Product']['category_id']=$category_id;
			
			$this->request->data['Product']['pcid']=$subcategory;


			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
			$subategories = $this->Product->Category->find('list',array('conditions'=>array('Category.parent_id'=>$this->request->data['Category']['id'])));
		}
		$categories = $this->Product->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
		$measures = $this->Product->Measure->find('list');
		$brands = $this->Product->Brand->find('list');
		$sizes = $this->Product->Size->find('list');
		$colors = $this->Product->Color->find('list');
		$this->set(compact('subategories'));
		$this->set(compact('categories','brands','sizes','colors','products','measures')); 
		
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	 


	public function code(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
	 		$code=$_REQUEST['id'];
	 		$cat_id=$_REQUEST['cat_id'];
	 		$subcat_id=$_REQUEST['subcat_id'];
			$codecheck=$this->Product->codeVerify($code,$cat_id,$subcat_id);
 		    echo $codecheck;
		 }
			
	}

	public function scode(){
		$this->layout='ajax';
		$distid=$this->Auth->user(); 
		$authdis=$distid['district_id'];
		 if(!empty($_REQUEST['code'])){
			$pid=$_REQUEST['code'];
			$sql  = "SELECT pt.name,pt.id,pt.measure_id,s.squantity, d.dquantity, p.pquantity, dm.dmquantity, rr.rrquantity FROM products 
			AS pt LEFT JOIN
			( 
				SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
				FROM stocks WHERE district_id=$authdis GROUP BY stocks.product_id 
			) 
			AS s ON pt.id = s.product_id LEFT JOIN 
			( 
				SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
				FROM purchasedetails WHERE district_id=$authdis GROUP BY purchasedetails.product_id 
			)
			 AS p ON pt.id = p.product_id LEFT JOIN 
			( 
				SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
				FROM deliverydetails WHERE district_id=$authdis GROUP BY deliverydetails.product_id 
			)
			AS d ON pt.id = d.product_id LEFT JOIN
	        ( 
	            SELECT requisitionreturns.product_id,SUM(requisitionreturns.quantity) AS rrquantity 
	            FROM requisitionreturns WHERE district_id=$authdis GROUP BY requisitionreturns.product_id 
	        )
	        AS rr ON pt.id = rr.product_id LEFT JOIN
	        ( 
	            SELECT damages.product_id,SUM(damages.quantity) AS dmquantity 
	            FROM damages WHERE district_id=$authdis GROUP BY damages.product_id 
	        )
	        AS dm ON pt.id = dm.product_id WHERE pt.finalcode='".$pid."' GROUP BY pt.id "; 

			$data=$this->Product->query($sql);  
			$count=count($data);

			if($count>0){

				$this->loadModel('Measure');
				$datam=$this->Measure->find('first',array(
				'recursive'=>-1,
				'fields'=>array('Measure.name'),
				'conditions'=>array('TRIM(Measure.id)'=>trim($data[0]['pt']['measure_id'])
				))); 
				$stockIn=$data[0]['s']['squantity']+$data[0]['p']['pquantity']+$data[0]['rr']['rrquantity'];
				$stockOut=$data[0]['d']['dquantity']+$data[0]['dm']['dmquantity'];
				$balance=$stockIn-$stockOut;
				echo $data[0]['pt']['name'].'/'.$balance.'/'.$data[0]['pt']['id'].'/'.$data[0]['pt']['measure_id'].'/'.$datam['Measure']['name'];
			}else{
				echo 'no Product/no stock/0/0/no Measure';
			}
			
	 		
		 }
			
	}


	public function pascode(){
		$this->layout='ajax';
		
		 if(!empty($_REQUEST['code'])){
			$code=$_REQUEST['code'];
			
			$data=$this->Product->find('first',array(
				'recursive'=>-1,
				'joins'=>array(
						 array(
						   'table'=>'measures',
						   'alias'=>'Measure',
						   'type'=>'LEFT',
						   'conditions'=>'Measure.id=Product.measure_id'
						 ) 
					),
				'fields'=>array('Product.name','Product.id','Measure.id','Measure.name'),
				'conditions'=>array('TRIM(Product.finalcode)'=>trim($code)
				)));

			$count=count($data);

			if($count>0){
				echo $data['Product']['id'].'/'.$data['Product']['name'].'/'.$data['Measure']['id'].'/'.$data['Measure']['name'];
			}else{
				echo '0/no name/0/no name';
			}
			
	 		
		 }
			
	}
		public function orders(){

		$this->layout="cart";
		
		if(!empty($_REQUEST['product_id'])){
			
			$this->loadModel('Cart');

			$this->request->data['Cart']['stock']=$_REQUEST['stock'];
			$this->request->data['Cart']['product_id']=$_REQUEST['product_id'];
			$this->request->data['Cart']['measure_id']=$_REQUEST['measure_id'];
			$this->request->data['Cart']['user_id']=$this->Auth->user('id');
			$this->request->data['Cart']['cdate']=date('Y-m-d H:i:s');
			
			$this->Cart->create();
			$this->Cart->save($this->request->data);
		
	
			$ext="Cart.user_id='".$this->Auth->user('id')."'";

			$product_data = $this->Cart->find(
            'all',array(
        		'group'=>'Cart.product_id',
        		'fields'=>array(
            		'Product.id',
        			'Product.name',
        			'Product.finalcode',
     				'Cart.stock',
     				'Cart.user_id',
					'Measure.name',
					'Measure.id',
					'Category.name',
            		'SubCategory.name',
     
        		),
        		'joins'=>array(
					array(
					   'table'=>'products',
					   'alias'=>'Product',
					   'type'=>'LEFT',
					   'conditions'=>'Product.id=Cart.product_id'
					 ),
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
					   'table'=>'measures',
					   'alias'=>'Measure',
					   'type'=>'LEFT',
					   'conditions'=>'Cart.measure_id=Measure.id'
					 )),
				'recursive'=>-1,
				'conditions'=>$ext
			));
	
			$this->set('itemcart', sizeof($product_data));
			$this->set('product_datas', $product_data);

		}
	}
		
	public function cart() {
		if(!empty($_REQUEST['removeProduct'])){
			$this->autoRender = false;
			$id=$_REQUEST['removeProduct'];
			$uid=$_REQUEST['user_id'];
			$this->Product->query("DELETE FROM carts WHERE user_id='".$uid."' AND product_id='".$id."'");
		}
	}
	 public function dropdown(){
   
    	 
    	 
		$this->layout='ajax';
		
		 if(!empty($_REQUEST['t_id'])){
		 	$this->set('search_keyword',$_REQUEST['t_id']);
			
		 	$LIKE="name LIKE '%".$_REQUEST['t_id']."%'";
		 	 
		
		$this->set('products',$this->Product->find('all',
			array('fields'=>array('name','finalcode'),'conditions' =>$LIKE,
                        'recursive' => -1))); 

		$this->set('nid',$_REQUEST['nid']); 


		 
		 }
}
}
