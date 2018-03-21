<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http\Response;

use Psr\Http\Message\StreamInterface;

class Sent
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
     * @var int $requestId
     */
    private $requestId;

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
            $this->requestId = $items[1];
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
    public function getRequestId():int
    {
        return $this->requestId;
    }

    /**
     * @return array
     */
    public function getRecepitiens():array
    {
        return $this->recepitiens;
    }
}
