<?php

namespace SmsManager\Tests;

use SmsManager\Diagnostics\Response;
use SmsManager\IClient;
use SmsManager\Message\Message;

class MockClient implements IClient
{

	public function send(Message $message): \SmsManager\Response\Sent
	{
		$body = 'OK|12345|' . implode(',', $message->getRecipients());
		$mockResponse = new Response($body);

		return \SmsManager\Response\Sent\Factory::create($mockResponse, $message);
	}


	public function getUserInfo(): \SmsManager\Response\UserInfo
	{
		$body = '9999|SMSMANAGER|high';
		$mockResponse = new Response($body);

		return \SmsManager\Response\UserInfo\Factory::create($mockResponse);
	}

}
