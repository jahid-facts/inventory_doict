<?php
App::uses('Stock', 'Model');

/**
 * Stock Test Case
 *
 */
class StockTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.stock',
		'app.product',
		'app.category',
		'app.delivery',
		'app.user',
		'app.purchase',
		'app.supplier',
		'app.purchasedetail',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.requisitiondetail',
		'app.requisition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stock = ClassRegistry::init('Stock');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stock);

		parent::tearDown();
	}

}
