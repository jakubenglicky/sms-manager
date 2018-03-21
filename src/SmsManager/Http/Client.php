<?php

/**
 * Part of jakubenglicky\sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message\Message;

class Client implements IClient
{
    /**
     * SMS Manager ApiKey
     * @var string $apiKey
     */
    private $apiKey;

    /**
     * Client constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Send SMS via HTTP GET request
     * @param Message $message
     * @throws \Exception
     * @return Response|ErrorResponse
     */
    public function send(Message $message):object
    {
        $client = new GuzzleHttp\Client();

        try {
            $res = $client->post('https://http-api.smsmanager.cz/Send', [
                'form_params' => [
                    'apikey' => $this->apiKey,
                    'number' => implode(',', $message->getNumbers()),
                    'gateway' => $message->getMessageType(),
                    'message' => $message->getBody(),
                ]
            ]);
            return new Response($res->getBody());
        } catch (\Exception $clientEx) {
            return new ErrorResponse($clientEx);
        }
    }
}
