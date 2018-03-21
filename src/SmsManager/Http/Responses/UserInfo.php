<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http\Response;

use Psr\Http\Message\StreamInterface;

class UserInfo
{
    /**
     * @var string $body
     */
    private $body;

    /*
     * @var float $credit
     */
    private $credit;

    /**
     * @var string $sender
     */
    private $sender;

    /**
     * @var string $messageType
     */
    private $messageType;

    /**
     * UserInfo constructor.
     * @param StreamInterface $response
     */
    public function __construct($response)
    {
        $this->body = trim($response);

        $items = explode('|', $this->body);

        list($this->credit, $this->sender, $this->messageType) = $items;
    }

    /**
     * Get full response message
     * @return string
     */
    public function getBody():string
    {
        return $this->body;
    }

    /**
     * Get credit info
     * @return float
     */
    public function getCreditInfo():float
    {
        return $this->credit;
    }

    /**
     * Get sender
     * @return string
     */
    public function getSender():string
    {
        return $this->sender;
    }

    /**
     * Get default message type
     * @return string
     */
    public function getDefaultMessageType():string
    {
        return $this->messageType;
    }
}
