<?php
App::uses('Designation', 'Model');

/**
 * Designation Test Case
 *
 */
class DesignationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.designation',
		'app.profile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Designation = ClassRegistry::init('Designation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Designation);

		parent::tearDown();
	}

}
