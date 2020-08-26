<?php

namespace SmsManager\Tests;

use SmsManager\Http\Response\Error;
use SmsManager\Http\Response\Sent;
use SmsManager\Http\Response\UserInfo;
use SmsManager\Message\Message;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ ."/bootstrap.php";

/**
 * @testCase
 */
class ClientTest extends TestCase
{
    public function testSentResponse()
    {
        $msg = new Message();
        $msg->setTo(['+420777111222']);
        $msg->setBody('Test message');


        $client = new MockClient();

        /**
         * @var Sent
         */
        $sent = $client->send($msg);

        Assert::true($sent instanceof Sent);
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

        /**
         * @var UserInfo
         */
        $info = $client->getUserInfo();

        Assert::true($info instanceof UserInfo);
        Assert::same($info->getCreditInfo(), 9999.0);
        Assert::true(is_float($info->getCreditInfo()));
        Assert::same($info->getSender(), 'SMSMANAGER');
        Assert::true(is_string($info->getSender()));
        Assert::same($info->getDefaultMessageType(), 'high');
        Assert::true(is_string($info->getDefaultMessageType()));
    }
}

(new ClientTest())->run();
