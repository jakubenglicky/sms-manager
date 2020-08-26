<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager;

interface IClient
{

    public function send(\SmsManager\Message\Message $message): \SmsManager\Response\Sent;

    public function getUserInfo(): \SmsManager\Response\UserInfo;

}
