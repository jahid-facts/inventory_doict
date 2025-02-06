<?php
App::uses('Measure', 'Model');

/**
 * Measure Test Case
 *
 */
class MeasureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.measure',
		'app.deliverydetail',
		'app.deliveries',
		'app.purchasedetail',
		'app.purchase',
		'app.supplier',
		'app.product',
		'app.category',
		'app.delivery',
		'app.user',
		'app.requisition',
		'app.stock',
		'app.requisitiondetail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Measure = ClassRegistry::init('Measure');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Measure);

		parent::tearDown();
	}

}
