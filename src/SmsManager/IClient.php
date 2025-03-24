<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager;

use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\Message\Message;

interface IClient
{
    /**
     * @param  Message $message
     * @return IResponse
     */
    public function send(Message $message);

    /**
     * Get User Info from SMS Manager account
     *
     * @return IResponse
     */
    public function getUserInfo();
}
