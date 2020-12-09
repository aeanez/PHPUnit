<?php 

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MockeryTest extends MockeryTestCase
{
	public function testDefault()
	{
		$this->assertTrue(true);
	}
}

 ?>