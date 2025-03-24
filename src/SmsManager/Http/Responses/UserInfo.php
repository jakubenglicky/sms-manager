<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http\Response;

use jakubenglicky\SmsManager\IResponse;

final class UserInfo implements IResponse
{
    private string $body;

    private string $credit;

    private string $sender;

    private string $messageType;


    public function __construct(string $body)
    {
        $this->body = trim($body);

        $items = explode('|', $this->body);

        [$this->credit, $this->sender, $this->messageType] = $items;
    }


    public function getBody(): string
    {
        return $this->body;
    }


    public function getCreditInfo(): float
    {
        return (float) $this->credit;
    }


    public function getSender(): string
    {
        return $this->sender;
    }

 
    public function getDefaultMessageType(): string
    {
        return $this->messageType;
    }
}
