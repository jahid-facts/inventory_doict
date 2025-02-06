<?php
App::uses('Deliverydetail', 'Model');

/**
 * Deliverydetail Test Case
 *
 */
class DeliverydetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deliverydetail',
		'app.measure',
		'app.deliveries'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Deliverydetail = ClassRegistry::init('Deliverydetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Deliverydetail);

		parent::tearDown();
	}

}
