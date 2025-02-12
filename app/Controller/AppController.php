<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $role_id = array('1'=>'Admin','2'=>'Storekeeper','3'=>'Requisitioner','4'=>'Super Admin','5'=>'Central Admin');
	public $status = array('1'=>'Active','2'=>'Inactive');
	public $approvestatus = array('2'=>'Approve','3'=>'Reject');
	public $measure = array('1'=>'Piece');
	public $padjtype = array('1'=>'Damage','2'=>'Missing');
	
	public $status_rquisition = array('1'=>'Pending','2'=>'Approved','3'=>'Reject');
	public $purpose = array('Administrative'=>'Administrative','Meeting Purpose'=>'Meeting Purpose','Seminar'=>'Seminar','Workshop'=>'Workshop','Personal'=>'Personal','5'=>'Others');

	
	public $components = array(
		'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );
    
    public function beforeFilter() {
    	$this->set('currentUser', $this->Auth->user());
		$this->set ( 'role_id', $this->getRole());
		$this->set ( 'status', $this->status );
		$this->set ( 'approvestatus', $this->approvestatus );
		$this->set ( 'measure', $this->measure );
		$this->set ( 'padjtype', $this->padjtype );
		$this->set ( 'status_rquisition', $this->status_rquisition );
		$this->set ( 'purpose', $this->purpose );
		
		$product_datas=$this->getCart();
		$this->set('itemcart', sizeof($product_datas));
		$this->set(compact('product_datas'));

		$this->saveLog();
	
	}
   public function getRole(){

   	$this->loadModel('Role');
	return $data = $this->Role->find('list',array('fields'=>array('Role.id','Role.title')));

   }
	public function isAuthorized() {
        
        if ($this->Auth->loggedIn()) {
            $role_id = $this->Auth->user('Role');

            $perm = json_decode($role_id['roles'], true);
            if (!isset($perm[Inflector::camelize($this->params['controller']) . "Controller"][$this->params['action']]) || is_numeric($perm[Inflector::camelize($this->params['controller']) . "Controller"][$this->params['action']])) {
                //throw new UnauthorizedException(__('You are not authorized to access this page.'));
            } else {
                //echo Router::url(['controller' => $this->params['controller'], 'action' => 'index']);
                return true;
            }
        }
    }

	 private function saveLog() {
        $log = array();
        $log['Log']['id'] = null;
        $log['Log']['user_id'] = $this->Auth->user('id');
        $log['Log']['ip'] = $_SERVER['REMOTE_ADDR'];
        $log['Log']['port'] = $_SERVER['REMOTE_PORT'];
        $log['Log']['controller'] = $this->params['controller'];
        $log['Log']['action'] = $this->here;

        ClassRegistry::init('Log')->save($log);
    }

    protected function getmenues() {
        $aCtrlClasses = App::objects('controller');
        $ignore = 'AppController';
        App::import('Controller', $ignore);
        $ignoreActions = get_class_methods($ignore);

        $controllers = array();
        foreach ($aCtrlClasses as $controller) {
            if ($controller != $ignore) {
                App::import('Controller', str_replace('Controller', '', $controller));
                $logions = get_class_methods($controller);
                $controllers[$controller] = array_diff($logions, $ignoreActions);

                foreach ($controllers[$controller] as $key => $value) {
                    unset($controllers[$controller][$key]);
                    $controllers[$controller][$value] = $value;
                }
            }

        }
        return $controllers;
    }

	public function getCart(){
		$ext="Cart.user_id='".$this->Auth->user('id')."'";
			$this->loadModel('Cart');
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
			return $product_data;
	}
}