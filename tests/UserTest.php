<?php 

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	
	public function testReturnsFullName()
	{
		$user = new User;

		$user->first_name = "Teresa";
		$user->surname = "Green";

		$this->assertEquals('Teresa Green', $user->getFullName());
	}

	public function testFullNameIsEmptyByDefault()
	{
		$user = new User;

		$this->assertEquals('', $user->getFullName());
	}

	/**
	 * @test
	 */
	function userHasFirstName()
	{
		$user = new User;

		$user->first_name = "Teresa";

		$this->assertEquals('Teresa', $user->first_name);
	}
	
	public function testNotificationIsSent()
	{
		$user = new User;

		$mock_mailer = $this->createMock(Mailer::class);

		$mock_mailer->expects($this->once())
					->method('sendMessage')
					->with($this->equalTo('dev@eloper.com'),
						   $this->equalTo('Hello'))
					->willReturn(true);

		$user->setMailer($mock_mailer);

		$user->email = 'dev@eloper.com';

		$this->assertTrue($user->notify("Hello"));
	}

	public function testCannotNotifyUserWithoutEmail()
	{
		$user = new User;

		$mock_mailer = $this->getMockBuilder(Mailer::class)
							->setMethods(null)
							->getMock();

		$user->setMailer($mock_mailer);

		$this->expectException(Exception::class);

		$user->notify("Hello");
	}

}