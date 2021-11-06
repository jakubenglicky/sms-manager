<?php

namespace SmsManager\Tests;

use SmsManager\Message\Message;
use Tester\Assert;

require_once __DIR__ ."/bootstrap.php";

class ClientTest extends \Tester\TestCase
{

	public function testSentResponse()
	{
		$msg = new Message();
		$msg->setTo([\SmartEmailing\Types\PhoneNumber::from('+420777111222')]);
		$msg->setBody('Test message');

		$client = new MockClient();

		$sent = $client->send($msg);

		Assert::true($sent instanceof \SmsManager\Response\Sent);
		Assert::true($sent->wasSent());
		Assert::true(is_integer($sent->getRequestId()));
		Assert::true(is_string($sent->getBody()));
		Assert::same(count(explode('|', $sent->getBody())), 3);
		Assert::true($sent->getMessage() instanceof Message);
		Assert::same($sent->getMessage()->getBody(), 'Test message');
	}


	public function testUserInfoResponse()
	{
		$client = new MockClient();

		$info = $client->getUserInfo();

		Assert::true($info instanceof \SmsManager\Response\UserInfo);
		Assert::same($info->getCredit(), 9999.0);
		Assert::true(is_float($info->getCredit()));
		Assert::same($info->getSender(), 'SMSMANAGER');
		Assert::true(is_string($info->getSender()));
		Assert::same($info->getMessageType(), 'high');
		Assert::true(is_string($info->getMessageType()));
	}

}

(new ClientTest())->run();
