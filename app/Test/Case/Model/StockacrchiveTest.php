<?php
App::uses('Stockacrchive', 'Model');

/**
 * Stockacrchive Test Case
 *
 */
class StockacrchiveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stockacrchive',
		'app.product',
		'app.category',
		'app.brand',
		'app.size',
		'app.color',
		'app.deliverydetail',
		'app.measure',
		'app.purchasedetail',
		'app.purchase',
		'app.supplier',
		'app.requisitiondetail',
		'app.requisition',
		'app.user',
		'app.department',
		'app.profile',
		'app.designation',
		'app.delivery',
		'app.stock',
		'app.deliveries'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stockacrchive = ClassRegistry::init('Stockacrchive');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stockacrchive);

		parent::tearDown();
	}

}
