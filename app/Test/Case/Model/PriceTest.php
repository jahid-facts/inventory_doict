<?php
App::uses('Price', 'Model');

/**
 * Price Test Case
 *
 */
class PriceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.price',
		'app.product',
		'app.category',
		'app.delivery',
		'app.user',
		'app.profile',
		'app.designation',
		'app.department',
		'app.requisition',
		'app.requisitiondetail',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.purchasedetail',
		'app.purchase',
		'app.supplier',
		'app.stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Price = ClassRegistry::init('Price');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Price);

		parent::tearDown();
	}

}
