<?php

namespace SmsManager\Tests;

use SmsManager\Exceptions\ApiException;
use SmsManager\Exceptions\ContentException;
use SmsManager\Exceptions\CreditException;
use SmsManager\Exceptions\InvalidCredentialsException;
use SmsManager\Exceptions\SenderException;
use SmsManager\Exceptions\TextException;
use SmsManager\Exceptions\UndefinedNumberException;
use SmsManager\Exceptions\UnknownMessageTypeException;
use SmsManager\Exceptions\WrongDataFormatException;
use SmsManager\Http\Response\Error;
use Tester\Assert;

require_once __DIR__ ."/bootstrap.php";

class ExceptionsTest extends \Tester\TestCase
{

	public function testWrongDataFormat()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|102', 400));
		}, WrongDataFormatException::class, 'Sent data is in wrong format!', 102);
	}


	public function testInvalidCredentials()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|103', 401));
		}, InvalidCredentialsException::class, 'Check your SMS Manager credentials!', 103);
	}


	public function testUnknownMessageType()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|104', 400));
		}, UnknownMessageTypeException::class, 'Unknown type of message!', 104);
	}


	public function testCredit()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|105', 402));
		}, CreditException::class, 'Your credit is too low for sending SMS!', 105);
	}


	public function testContent()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|109', 400));
		}, ContentException::class, 'Your request does not contain all compulsory items!', 109);
	}


	public function testNumber()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|201', 400));
		}, UndefinedNumberException::class, 'Define at least one number!', 201);
	}


	public function testText()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|202', 400));
		}, TextException::class, 'Text of SMS does not exist or is too long!', 202);
	}


	public function testSender()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|203', 400));
		}, SenderException::class, 'Invalid parameter. You must defined sender in your SMS Manager account!', 203);
	}


	public function testApi()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|999', 500));
		}, ApiException::class, 'Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', 500);

		Assert::exception(static function () {
			$error = new Error(new \Exception('response: ERROR|999', 503));
		}, ApiException::class, 'Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', 503);
	}


	public function testException()
	{
		Assert::exception(static function () {
			$error = new Error(new \Exception('Error everywhere', 500));
		}, \Exception::class, 'Error everywhere', 500);
	}

}

(new ExceptionsTest())->run();
