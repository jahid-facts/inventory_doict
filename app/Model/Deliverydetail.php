<?php
App::uses('AppModel', 'Model');
/**
 * Deliverydetail Model
 *
 * @property Measure $Measure
 * @property Deliveries $Deliveries
 */
class Deliverydetail extends AppModel {

	public $belongsTo = array(
		'Measure' => array(
			'className' => 'Measure',
			'foreignKey' => 'measure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Deliveries' => array(
			'className' => 'Deliveries',
			'foreignKey' => 'deliveries_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
