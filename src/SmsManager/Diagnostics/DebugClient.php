<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Diagnostics;

use SmsManager\Http\Response\Error;
use SmsManager\Http\Response\Sent;
use SmsManager\Http\Response\UserInfo;
use SmsManager\IClient;
use SmsManager\Message\Message;

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
     * @return Error|Sent
     * @throws \SmsManager\Exceptions\TextException
     * @throws \SmsManager\Exceptions\UndefinedNumberException
     */
    public function send(Message $message)
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
    }

    public function getUserInfo()
    {
        return new UserInfo(new Response('9999|SMSMANAGER|high'));
    }
}
