<?php
App::uses('Requisitionreturn', 'Model');

/**
 * Requisitionreturn Test Case
 *
 */
class RequisitionreturnTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requisitionreturn',
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
		$this->Requisitionreturn = ClassRegistry::init('Requisitionreturn');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Requisitionreturn);

		parent::tearDown();
	}

}
