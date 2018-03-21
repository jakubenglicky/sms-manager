<?php

/**
 * Part of jakubenglicky\sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use Psr\Http\Message\StreamInterface;

class Response
{
    /**
     * @var string $body
     */
    private $body;

    /*
     * @var bool $sent
     */
    private $sent;

    /**
     * @var int $code
     */
    private $code;

    /**
     * @var int $messageId
     */
    private $messageId;

    /**
     * @var array $recepitiens
     */
    private $recepitiens;


    /**
     * ApiResponse constructor.
     * @param StreamInterface $response
     */
    public function __construct($response)
    {
        $this->body = trim($response);

        $items = explode('|', $this->body);

        if ($items[0] === 'OK') {
            $this->sent = true;
            $this->code = 200;
            $this->messageId = $items[1];
            $this->recepitiens = explode(',', $items[2]);
        }
    }

    /**
     * @return bool
     */
    public function wasSent():bool
    {
        return $this->sent;
    }

    /**
     * @return int
     */
    public function getCode():int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getBody():string
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getMessageId():int
    {
        return $this->messageId;
    }

    /**
     * @return array
     */
    public function getRecepitiens():array
    {
        return $this->recepitiens;
    }
}
