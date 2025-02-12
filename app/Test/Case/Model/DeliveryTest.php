<?php
App::uses('Delivery', 'Model');

/**
 * Delivery Test Case
 *
 */
class DeliveryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.delivery',
		'app.user',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Delivery = ClassRegistry::init('Delivery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Delivery);

		parent::tearDown();
	}

}
