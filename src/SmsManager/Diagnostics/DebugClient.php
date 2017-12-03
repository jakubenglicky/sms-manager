<?php

namespace jakubenglicky\SmsManager\Diagnostics;

use jakubenglicky\SmsManager\Http\Response;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message;

class DebugClient implements IClient
{
	/**
	 * @var string
	 */
	private $tempDir;

	/**
	 * DebugClient constructor.
	 * @param $tempDir
	 */
	public function __construct($tempDir)
	{
		@mkdir($tempDir . '/sms');
		$this->tempDir = $tempDir . '/sms';
	}

	/**
	 * Fake send for debugging
	 * @param Message $message
	 * @return Response
	 */
	public function send(Message $message)
	{
		$data = '';
		$data .= $message->getBody() . '|';
		$data .= $message->getNumbers();

		$id = uniqid();

		if( $message->getBody() != '') {
			file_put_contents($this->tempDir . '/' . $id . '.sms', $data);
			return new Response('OK|' . $id .'|' . $message->getNumbers());
		} else {

		}
	}
}