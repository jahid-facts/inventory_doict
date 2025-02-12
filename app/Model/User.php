<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Delivery $Delivery
 * @property Profile $Profile
 * @property Requisition $Requisition
 */
class User extends AppModel {
	public function beforeSave($options = array()) {
		if(!empty($this->data['User']['password'])){
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'role' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notEmpty' => array(
				'rule' => array('isUnique'),
				'message' => 'ইতিমধ্যে এই  ব্যবহারকারী নামটি নেওয়া হয়েছে',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'একটি  সঠিক  ই-মেইল দিন',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'department_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
            'designation_id' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Delivery' => array(
			'className' => 'Delivery',
			'foreignKey' => 'user_id',
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
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'user_id',
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
		'Requisition' => array(
			'className' => 'Requisition',
			'foreignKey' => 'user_id',
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
        
        public $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Designation' => array(
			'className' => 'Designation',
			'foreignKey' => 'designation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Division' => array(
			'className' => 'Division',
			'foreignKey' => 'division_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);




    public function LoginValidate() {
		$validate1 = array ('email' => array ('mustNotEmpty' => array ('rule' => 'notEmpty', 'message' => 'Please enter email or username' ) ), 'password' => array ('mustNotEmpty' => array ('rule' => 'notEmpty', 'message' => 'Please enter password' ) ) );
		$this->validate = $validate1;
		return $this->validates ();
	}

	public function RegisterValidate() {
		$validate2 = array (
		'password' => array (
		'mustNotEmpty' => array ('rule' => 'notEmpty', 'message' => 'Please enter password', 'on' => 'create', 'last' => true ),
	    'mustBeLonger' => array ('rule' => array ('minLength', 6 ), 'message' => 'Password must be greater than 5 characters', 'on' => 'create', 'last' => true ),
		'Check Match' => array ('rule' => 'confirmPassword', 'message' => 'Both passwords must match' ) ),
		'cpassword' => array ('Not empty' => array ('rule' => 'notEmpty', 'message' => 'Please confirm your password' ) )
		
		)//'on' => 'create'
;
		$this->validate = $validate2;
		return $this->validates ();
	}

	public function confirmPassword() {
       $hash = $this->data[$this->alias]['cpassword'];
       if($this->data[$this->alias]['password'] == $hash) {
            return true;
          }
          return false;
       } 

	public function getActivationKey($password) {
		$salt = Configure::read ( "Security.salt" );
		return md5 ( md5 ( $password ) . $salt );
	}

}
