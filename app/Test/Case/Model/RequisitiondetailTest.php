<?php
App::uses('Requisitiondetail', 'Model');

/**
 * Requisitiondetail Test Case
 *
 */
class RequisitiondetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requisitiondetail',
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
		'app.stock'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Requisitiondetail = ClassRegistry::init('Requisitiondetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Requisitiondetail);

		parent::tearDown();
	}

}
