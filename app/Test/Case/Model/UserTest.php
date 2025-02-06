<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.delivery',
		'app.product',
		'app.category',
		'app.purchase',
		'app.supplier',
		'app.purchasedetail',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.requisitiondetail',
		'app.requisition',
		'app.stock',
		'app.profile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
