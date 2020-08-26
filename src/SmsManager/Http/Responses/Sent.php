<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Http\Response;

use SmsManager\Message\Message;
use Psr\Http\Message\ResponseInterface;

final class Sent
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
     * @var Message
     */
    private $message;

    /**
     * ApiResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response, Message $message)
    {
        $this->body = trim((string)$response->getBody());
        $this->message = $message;

        $items = explode('|', $this->body);

        if ($items[0] === 'OK') {
            $this->sent = true;
            $this->code = 200;
            $this->requestId = (int)$items[1];
        } else {
            $this->sent = false;
            $this->code = (isset($items[1])) ? (int)$items[1] : 0;
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
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }
}
