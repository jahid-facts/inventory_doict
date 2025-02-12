<?php
/**
 * DeliverydetailFixture
 *
 */
class DeliverydetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'price' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'measure_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'deliveries_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'voucher' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'quantity' => 1,
			'price' => 1,
			'measure_id' => 1,
			'deliveries_id' => 1,
			'voucher' => 'Lorem ipsum dolor sit a'
		),
	);

}
