<?php

namespace SmsManager\Tests;

use SmsManager\Diagnostics\Response;
use SmsManager\Http\Response\Error;
use SmsManager\Http\Response\Sent;
use SmsManager\Http\Response\UserInfo;
use SmsManager\IClient;
use SmsManager\Message\Message;

class MockClient implements IClient
{

    /**
     * @param Message $message
     * @return Sent|Error
     */
    public function send(Message $message)
    {
        $body = 'OK|12345|' . implode(',', $message->getRecipients());
        $mockResponse = new Response($body);
        return new Sent($mockResponse, $message);
    }

    /**
     * Get User Info from SMS Manager account
     * @return UserInfo|Error
     */
    public function getUserInfo()
    {
        $body = '9999|SMSMANAGER|high';
        $mockResponse = new Response($body);
        return new UserInfo($mockResponse);
    }
}
