<?php declare(strict_types=1);

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

final class DebugClient implements IClient
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
     * @return Sent|null
     * @throws \jakubenglicky\SmsManager\Exceptions\TextException
     * @throws \jakubenglicky\SmsManager\Exceptions\UndefinedNumberException
     */
    public function send(Message $message): ?Sent
    {
        $data = '';
        $data .= $message->getBody() . '|';
        $data .= $message->getCommaSeparateNumbers();

        $id = uniqid();

        if ($message->getBody() != '') {
            file_put_contents($this->tempDir . '/' . $id . '.sms', $data);
            return new Sent(
                new Response('OK|' . $id .'|' . $message->getCommaSeparateNumbers()),
                $message
            );
        }
        return null;
    }

    public function getUserInfo()
    {
        return new UserInfo(new Response('9999|SMSMANAGER|high'));
    }
}
