<?php
App::uses('Damage', 'Model');

/**
 * Damage Test Case
 *
 */
class DamageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.damage',
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
		$this->Damage = ClassRegistry::init('Damage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Damage);

		parent::tearDown();
	}

}
