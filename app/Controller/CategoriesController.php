<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('category',$this->getCategory());
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
		$this->Category->recursive = 0;
		$this->paginate=array('conditions'=>array('Category.parent_id'=>-1),'limit'=>100,'order'=>'Category.cCode');
		$this->set('categories', $this->paginate());
	} 
	public function indexsub() {
		$this->Category->recursive = 0;
		$this->paginate=array(
			'limit'=>100,'order'=>'ParentCategory.cCode, Category.sCode ASC'
		);
		$this->set('categories', $this->paginate()); 
	}


	public function getsubcategory(){
		$this->autoRender = false;
		$data = $_REQUEST['category_id'];
		$getsub = $this->Category->find(
				'list',
				array('fields'=>array('id','name'),'recursive'=>-1, 'conditions'=>array('Category.parent_id'=>$data))
			);
		return json_encode($getsub);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$code=$this->request->data['Category']['cCode'];

			$codecheck=$this->Category->codeVerify($code,'cCode');

			if($codecheck>0){
				$this->Session->setFlash(__('The category code already exist.'));
				return $this->redirect(array('action' => 'index'));
			}

			$this->Category->create();
			$this->request->data['Category']['sl']=1;

			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		                
        $parentCategories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
               
		$this->set(compact('parentCategories'));
	}

	public function addsub() {
		if ($this->request->is('post')) {


			$code=$this->request->data['Category']['sCode'];
			$parent_id=$this->request->data['Category']['parent_id'];
			$codecheck=$this->Category->scodeVerify($code,'sCode',$parent_id);

			if($codecheck>0){
				$this->Session->setFlash(__('The category code already exist.'));
				return $this->redirect(array('action' => 'index'));
			}

			$this->request->data['Category']['sl']=1;
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The sub-category has been saved.'));
				return $this->redirect(array('action' => 'indexsub'));
			} else {
				$this->Session->setFlash(__('The sub-category could not be saved. Please, try again.'));
			}
		}
		                
        $parentCategories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
                
		$this->set(compact('parentCategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {


			$code=$this->request->data['Category']['cCode'];
			$cccode=$this->request->data['Category']['cccode'];

			unset($this->request->data['Category']['cccode']);

			echo $cod.'/'.$cccode;


			if($code==$cccode){

			}else{

				$codecheck=$this->Category->codeVerify($code,'cCode');
				if($codecheck>0){
					$this->Session->setFlash(__('The category code already exist.'));
					return $this->redirect(array('action' => 'edit',$id));
				}
			}
			
			$this->request->data['Category']['sl']=1;
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$parentCategories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
		$this->set(compact('parentCategories'));
	}

		public function editsub($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {


			$code=$this->request->data['Category']['sCode'];
			$cccode=$this->request->data['Category']['cscode'];

			$cparent_id=$this->request->data['Category']['cparent_id'];
			$parent_id=$this->request->data['Category']['parent_id'];

			unset($this->request->data['Category']['cscodeif(']);
			unset($this->request->data['Category']['cparent_id']);

			if($cccode==$code && $cparent_id==$cparent_id){
				
			}else{
				$codecheck=$this->Category->scodeVerify($code,'sCode',$parent_id);
				if($codecheck>0){
					$this->Session->setFlash(__('The sub-category code already exist.'));
					return $this->redirect(array('action' => 'editsub',$id));
				}
			}
			

			$this->request->data['Category']['sl']=1;
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The sub-category has been updated.'));
				return $this->redirect(array('action' => 'indexsub'));
			} else {
				$this->Session->setFlash(__('The category could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$parentCategories = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>-1)));
		$this->set(compact('parentCategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

	public function producttree() {
		$categories = $this ->getCategory();
		$this->set('menuSortable',$categories);
  		$this->Category->recursive = 0;
		$this->paginate = array('order' => 'Category.id','limit' => 10);
	}
	
	public function getCategory(){

		$data = $this ->Category ->find(
				'threaded',
				array(
					'recursive' =>0,
						'fields' => array(
								'Category.id',
								'Category.parent_id',
								'Category.name',
						),
						'order' => array('Category.id'),
				)
		);
		return $data;
	}


	public function code(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
	 		$code=$_REQUEST['id'];
	 		$title=$_REQUEST['title'];
			$codecheck=$this->Category->codeVerify($code,$title);
 		    echo $codecheck;
		 }	
	}

	public function scode(){
		$this->layout='ajax';
		 if(!empty($_REQUEST['id'])){
	 		$code=$_REQUEST['id'];
	 		$title=$_REQUEST['title'];
	 		$cat_id=$_REQUEST['cat_id'];
			$codecheck=$this->Category->scodeVerify($code,$title,$cat_id);
 		    echo $codecheck;
		 }	
	}

}
