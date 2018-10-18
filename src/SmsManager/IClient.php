<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager;

use jakubenglicky\SmsManager\Message\Message;

interface IClient
{

    /**
     * @param \jakubenglicky\SmsManager\Message\Message $message
     * @return \jakubenglicky\SmsManager\Http\Response\Sent|\jakubenglicky\SmsManager\Error
     */
    public function send(Message $message);

    /**
     * Get User Info from SMS Manager account
     *
     * @return \jakubenglicky\SmsManager\UserInfo|\jakubenglicky\SmsManager\Error
     */
    public function getUserInfo();
}
