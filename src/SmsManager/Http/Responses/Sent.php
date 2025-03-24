<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http\Response;

use jakubenglicky\SmsManager\Message\Message;
use jakubenglicky\SmsManager\IResponse;

final class Sent implements IResponse
{
    private string $body;

    private bool $sent;

    private int $code;

    private ?int $requestId;

    private Message $message;

    public function __construct(string $body, Message $message)
    {
        $this->body = trim($body);
        $this->message = $message;

        $items = explode('|', $this->body);

        if ($items[0] === 'OK') {
            $this->sent = true;
            $this->code = 200;
            $this->requestId = (int)$items[1];
        } else {
            $this->sent = false;
            $this->code = isset($items[1]) ? (int)$items[1] : 0;
        }
    }


    public function wasSent(): bool
    {
        return $this->sent;
    }


    public function getCode(): int
    {
        return $this->code;
    }


    public function getBody(): string
    {
        return $this->body;
    }


    public function getRequestId(): ?int
    {
        return $this->requestId;
    }

 
    public function getMessage(): Message
    {
        return $this->message;
    }
}
