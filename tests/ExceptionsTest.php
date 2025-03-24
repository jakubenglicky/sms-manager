<?php

namespace jakubenglicky\SmsManager\Tests;

use jakubenglicky\SmsManager\Exceptions\ApiException;
use jakubenglicky\SmsManager\Exceptions\ContentException;
use jakubenglicky\SmsManager\Exceptions\CreditException;
use jakubenglicky\SmsManager\Exceptions\InvalidCredentialsException;
use jakubenglicky\SmsManager\Exceptions\SenderException;
use jakubenglicky\SmsManager\Exceptions\TextException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;
use jakubenglicky\SmsManager\Exceptions\UnknownMessageTypeException;
use jakubenglicky\SmsManager\Exceptions\WrongDataFormatException;
use jakubenglicky\SmsManager\Http\Response\Error;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ ."/bootstrap.php";

/**
 * @testCase
 */
class ExceptionsTest extends TestCase
{
    public function testWrongDataFormat()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|102', 400));
            }, WrongDataFormatException::class, 'Sent data is in wrong format!', 102
        );
    }

    public function testInvalidCredentials()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|103', 401));
            }, InvalidCredentialsException::class, 'Check your SMS Manager credentials!', 103
        );
    }

    public function testUnknownMessageType()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|104', 400));
            }, UnknownMessageTypeException::class, 'Unknown type of message!', 104
        );
    }

    public function testCredit()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|105', 402));
            }, CreditException::class, 'Your credit is too low for sending SMS!', 105
        );
    }

    public function testContent()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|109', 400));
            }, ContentException::class, 'Your request does not contain all compulsory items!', 109
        );
    }

    public function testNumber()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|201', 400));
            }, UndefinedNumberException::class, 'Define at least one number!', 201
        );
    }

    public function testText()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|202', 400));
            }, TextException::class, 'Text of SMS does not exist or is too long!', 202
        );
    }

    public function testSender()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|203', 400));
            }, SenderException::class, 'Invalid parameter. You must defined sender in your SMS Manager account!', 203
        );
    }

    public function testApi()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|999', 500));
            }, ApiException::class, 'Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', 500
        );

        Assert::exception(
            function () {
                $error = new Error(new \Exception('response: ERROR|999', 503));
            }, ApiException::class, 'Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', 503
        );
    }

    public function testException()
    {
        Assert::exception(
            function () {
                $error = new Error(new \Exception('Error everywhere', 500));
            }, \Exception::class, 'Error everywhere', 500
        );
    }
}

(new ExceptionsTest())->run();
