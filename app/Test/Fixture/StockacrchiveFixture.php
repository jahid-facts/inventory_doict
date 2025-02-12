<?php
/**
 * StockacrchiveFixture
 *
 */
class StockacrchiveFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'stockIn' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'stockOut' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'balance' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'sdate' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'product_id' => 1,
			'stockIn' => 1,
			'stockOut' => 1,
			'balance' => 1,
			'sdate' => '2016-11-27'
		),
	);

}
