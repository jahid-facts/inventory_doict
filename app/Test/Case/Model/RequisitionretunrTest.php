<?php
App::uses('Requisitionretunr', 'Model');

/**
 * Requisitionretunr Test Case
 *
 */
class RequisitionretunrTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requisitionretunr',
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
		$this->Requisitionretunr = ClassRegistry::init('Requisitionretunr');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Requisitionretunr);

		parent::tearDown();
	}

}
