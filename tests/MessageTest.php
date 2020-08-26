<?php

namespace SmsManager\Tests;

use SmsManager\Message\Message;
use SmsManager\Message\Type;
use SmartEmailing\Types\PhoneNumber;
use Tester\Assert;

require_once __DIR__ ."/bootstrap.php";

class MessageTest extends \Tester\TestCase
{

	/**
	 * @var Message
	 */
	private $message;


	public function __construct()
	{
		$this->message = new Message();
	}


	public function testInstance()
	{
		Assert::true($this->message instanceof Message);
	}


	public function testSetTo()
	{
		$this->message->setTo(['+420722111333']);

		Assert::true(is_array($this->message->getRecipients()));
		Assert::true($this->message->getRecipients()[0] instanceof PhoneNumber);
		Assert::same('+420722111333', $this->message->getRecipients()[0]->getValue());
		$this->message->setTo(['+420722111333','+420800000000']);
		Assert::same('+420800000000', $this->message->getRecipients()[1]->getValue());
	}


	public function testSetBody()
	{
		$this->message->setBody('Test message');
		Assert::same('Test message', $this->message->getBody());
	}


	public function testMessageType()
	{
		$this->message->setMessageType(Type::ECONOMY);
		Assert::same('economy', $this->message->getMessageType());

		$this->message->setMessageType(Type::HIGH);
		Assert::same('high', $this->message->getMessageType());

		$this->message->setMessageType(Type::LOWCOST);
		Assert::same('lowcost', $this->message->getMessageType());
	}

}

(new MessageTest())->run();
