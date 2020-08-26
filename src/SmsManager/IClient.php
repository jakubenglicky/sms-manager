<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager;

use SmsManager\Http\Response\Error;
use SmsManager\Http\Response\Sent;
use SmsManager\Http\Response\UserInfo;
use SmsManager\Message\Message;

interface IClient
{
    /**
     * @param Message $message
     * @return Sent|Error
     */
    public function send(Message $message);

    /**
     * Get User Info from SMS Manager account
     * @return UserInfo|Error
     */
    public function getUserInfo();
}
