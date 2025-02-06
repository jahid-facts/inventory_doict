<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
        public function index(){
            
        }
    public function proceedorder() {
	    
		$this->loadModel('Category');
 		$this->loadModel('Product');
 		$badgesliders=$this->Category->find('all',array('order'=>'Category.sl'));
		$badgessliders=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1)));
 	    $eproductscat=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>-1)));
 		if(!empty($_REQUEST['product_id'])){
			$product_id = $this->Session->read('Id');
			if(empty($product_id)){
				$this->Session->write('Id',array()); 
			}
			$product = $this->Session->read('Id');
			
			$product[$_REQUEST['product_id']] = $_REQUEST['product_id'];
			$this->Session->write('Id',$product);
			$product_id=$this->Session->read('Id');
			foreach($product_id as $p_id){
				$product_data[] = $this->Product->find('all',array('fields'=>array('Product.*','Category.name'),'conditions'=>array('Product.id'=>$p_id),'recursive'=>0));
			}
			$this->set('itemcart', sizeof($product_data));
			$this->set('product_data', $product_data);

		}
		$this->set(compact('badgessliders','badgesliders','eproducts','eproductscat')); 
}
}
