<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Diagnostics;

use SmsManager\IClient;
use SmsManager\Message\Message;

final class DebugClient implements IClient
{

	/**
	 * @var string
	 */
	private $tempDir;


	/**
	 * DebugClient constructor.
	 * @param string $tempDir
	 */
	public function __construct($tempDir)
	{
		@mkdir($tempDir . '/sms');
		$this->tempDir = $tempDir . '/sms';
	}


	/**
	 * Fake send for debugging
	 * @throws \SmsManager\Exceptions\TextException
	 * @throws \SmsManager\Exceptions\UndefinedNumberException
	 */
	public function send(Message $message): \SmsManager\Response\Sent
	{
		$data = '';
		$data .= $message->getBody() . '|';
		$data .= $message->getCommaSeparateNumbers();

		$id = uniqid();

		file_put_contents($this->tempDir . '/' . $id . '.sms', $data);

		return \SmsManager\Response\Sent\Factory::create(
			new Response('OK|' . $id .'|' . $message->getCommaSeparateNumbers()),
			$message
		);

	}


	public function getUserInfo(): \SmsManager\Response\UserInfo
	{
		return \SmsManager\Response\UserInfo\Factory::create(new Response('9999|SMSMANAGER|high'));
	}

}
