<?php

namespace jakubenglicky\SmsManager\Tests;

use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message\Message;
use Nette\Neon\Exception;

class MockClient implements IClient
{

    /**
     * @param Message $message
     * @return Sent|Error
     */
    public function send(Message $message)
    {
        $body = 'OK|12345|' . implode(',', $message->getRecepitiens());
        $mockResponse = new MockResponse($body);
        return new Sent($mockResponse, $message);
    }

    /**
     * Get User Info from SMS Manager account
     * @return UserInfo|Error
     */
    public function getUserInfo()
    {
        $body = '9999|SMSMANAGER|high';
        $mockResponse = new MockResponse($body);
        return new UserInfo($mockResponse);
    }
}
