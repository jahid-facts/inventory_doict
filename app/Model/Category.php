<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 * @property Product $Product
 */
class Category extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'checkunique' => array(
				'rule' => array('isUnique'),
				'message' => 'Category Name already Exists',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'parent_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sl' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function codeVerify($Code=null,$title=null){
		return $this->find('count',array('conditions'=>array("TRIM(Category.$title)"=>trim($Code))));
	}

	public function scodeVerify($Code=null,$title=null,$cat_id=null){
		return $this->find('count',array('conditions'=>array("TRIM(Category.$title)"=>trim($Code),'Category.parent_id'=>$cat_id)));
	}

	public function setcode($cat_id=null,$title=null){
		   $data=$this->find('first',array('recursive'=>-1,'conditions'=>array('Category.id'=>$cat_id)));
		   if($title=='cat'){
		   	    return $data['Category']['cCode'];
		   }else{
		   		return $data['Category']['sCode'];
		   }
	}

}
