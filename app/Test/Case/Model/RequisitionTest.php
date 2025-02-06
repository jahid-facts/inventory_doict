<?php
App::uses('Requisition', 'Model');

/**
 * Requisition Test Case
 *
 */
class RequisitionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requisition',
		'app.user',
		'app.product',
		'app.category',
		'app.delivery',
		'app.purchase',
		'app.supplier',
		'app.purchasedetail',
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.requisitiondetail',
		'app.stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Requisition = ClassRegistry::init('Requisition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Requisition);

		parent::tearDown();
	}

}
