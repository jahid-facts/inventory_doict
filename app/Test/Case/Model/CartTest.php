<?php
App::uses('Cart', 'Model');

/**
 * Cart Test Case
 *
 */
class CartTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cart',
		'app.product',
		'app.category',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
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
		'app.brand',
		'app.size',
		'app.color'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cart = ClassRegistry::init('Cart');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cart);

		parent::tearDown();
	}

}
