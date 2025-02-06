<?php
App::uses('Supplier', 'Model');

/**
 * Supplier Test Case
 *
 */
class SupplierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.supplier',
		'app.purchase',
		'app.product',
		'app.category',
		'app.delivery',
		'app.user',
		'app.requisition',
		'app.requisitiondetail',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.purchasedetail',
		'app.stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Supplier = ClassRegistry::init('Supplier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Supplier);

		parent::tearDown();
	}

}
