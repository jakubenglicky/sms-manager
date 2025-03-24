<?php

namespace jakubenglicky\SmsManager\Tests;

use jakubenglicky\SmsManager\Diagnostics\Response;
use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\IResponse;
use jakubenglicky\SmsManager\Message\Message;

class MockClient implements IClient
{

    /**
     * @param  Message $message
     * @return IResponse
     */
    public function send(Message $message)
    {
        $body = 'OK|12345|' . implode(',', $message->getRecipients());
        return new Sent($body, $message);
    }

    /**
     * Get User Info from SMS Manager account
     *
     * @return UserInfo|Error
     */
    public function getUserInfo()
    {
        $body = '9999|SMSMANAGER|high';
        return new UserInfo($body);
    }
}
