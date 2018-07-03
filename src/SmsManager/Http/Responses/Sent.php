<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http\Response;

use jakubenglicky\SmsManager\Message\Message;
use Psr\Http\Message\ResponseInterface;

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
     * @var Message
     */
    private $message;

    /**
     * ApiResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response, Message $message)
    {
        $this->body = trim($response->getBody());
        $this->message = $message;

        $items = explode('|', $this->body);

        if ($items[0] === 'OK') {
            $this->sent = true;
            $this->code = 200;
            $this->requestId = $items[1];
            $this->recepitiens = explode(',', $items[2]);
        } else {
            $this->sent = false;
            $this->code = $items[1];
        }
    }

    /**
     * Get info about sent
     * @return bool
     */
    public function wasSent():bool
    {
        return $this->sent;
    }

    /**
     * Get HTTP status code
     * @return int
     */
    public function getCode():int
    {
        return $this->code;
    }

    /**
     * Get full response body
     * @return string
     */
    public function getBody():string
    {
        return $this->body;
    }

    /**
     * Get request SMS Manager ID
     * @return int
     */
    public function getRequestId():int
    {
        return $this->requestId;
    }

    /**
     * Get array of recepitiens numbers
     * @return array
     */
    public function getRecepitiens():array
    {
        return $this->recepitiens;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
