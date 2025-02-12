<?php
App::uses('Profile', 'Model');

/**
 * Profile Test Case
 *
 */
class ProfileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profile',
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
		'app.designation',
		'app.department'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Profile = ClassRegistry::init('Profile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Profile);

		parent::tearDown();
	}

}
