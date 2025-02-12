<?php
App::uses('Purchasedetail', 'Model');

/**
 * Purchasedetail Test Case
 *
 */
class PurchasedetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchasedetail',
		'app.purchase',
		'app.supplier',
		'app.product',
		'app.measure'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Purchasedetail = ClassRegistry::init('Purchasedetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Purchasedetail);

		parent::tearDown();
	}

}
