<?php
App::uses('AppModel', 'Model');
/**
 * Delivery Model
 *
 * @property User $User
 * @property Product $Product
 */
class Delivery extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'Requisition' => array(
			'className' => 'Requisition',
			'foreignKey' => 'requisition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        public $hasMany = array(
		'Deliverydetail' => array(
			'className' => 'Deliverydetail',
			'foreignKey' => 'deliveries_id',
			'dependent' => true,
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
        
        
}
