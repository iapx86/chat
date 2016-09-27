<?php
App::uses('Data', 'Model');

/**
 * Data Test Case
 */
class DataTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.data',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Data = ClassRegistry::init('Data');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Data);

		parent::tearDown();
	}

}
