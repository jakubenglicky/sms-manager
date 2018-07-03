<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Diagnostics;

use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message\Message;

class DebugClient implements IClient
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
     * @param Message $message
     * @return Sent
     */
    public function send(Message $message)
    {
        $data = '';
        $data .= $message->getBody() . '|';
        $data .= implode(',', $message->getRecepitiens());

        $id = uniqid();

        if ($message->getBody() != '') {
            file_put_contents($this->tempDir . '/' . $id . '.sms', $data);
            return new Sent(new Response('OK|' . $id .'|' . implode(',', $message->getRecepitiens())), $message);
        } else {
        }
    }

    /**
     * Get User Info from SMS Manager account
     * @return UserInfo|Error
     */
    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
    }
}
