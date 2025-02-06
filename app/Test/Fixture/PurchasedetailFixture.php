<?php
/**
 * PurchasedetailFixture
 *
 */
class PurchasedetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'purchase_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'price' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'measure_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'purchase_id' => 1,
			'quantity' => 1,
			'price' => 1,
			'measure_id' => 1
		),
	);

}
