<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Diagnostics;

use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\IResponse;
use jakubenglicky\SmsManager\Message\Message;

final class DebugClient implements IClient
{

    private string $tempDir;

    public function __construct(string $tempDir)
    {
        @mkdir($tempDir . '/sms');
        $this->tempDir = $tempDir . '/sms';
    }

    /**
     * Fake send for debugging
     *
     * @throws \jakubenglicky\SmsManager\Exceptions\TextException
     * @throws \jakubenglicky\SmsManager\Exceptions\UndefinedNumberException
     */
    public function send(Message $message): IResponse
    {
        $data = '';
        $data .= $message->getBody() . '|';
        $data .= $message->getCommaSeparateNumbers();

        $id = uniqid();

        file_put_contents($this->tempDir . '/' . $id . '.sms', $data);

        return new Sent('OK|' . $id .'|' . $message->getCommaSeparateNumbers(), $message);
    }

    public function getUserInfo()
    {
        return new UserInfo('9999|SMSMANAGER|high');
    }
}
