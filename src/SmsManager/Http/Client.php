<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\RequestStatus;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message\Message;

class Client implements IClient
{
    /**
     * @var GuzzleHttp\Client
     */
    private $client;

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
        $this->client = new GuzzleHttp\Client();
    }

    /**
     * Send SMS via HTTP GET request
     * @param Message $message
     * @throws \Exception
     * @return Sent|Error
     */
    public function send(Message $message)
    {
        try {
            $res = $this->client->post('https://http-api.smsmanager.cz/Send', [
                'form_params' => [
                    'apikey' => $this->apiKey,
                    'number' => implode(',', $message->getNumbers()),
                    'gateway' => $message->getMessageType(),
                    'message' => $message->getBody(),
                ]
            ]);
            return new Sent($res->getBody());
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }

    /**
     * Get User Info from SMS Manager account
     * @return UserInfo|Error
     */
    public function getUserInfo()
    {
        try {
            $res = $this->client->post('https://http-api.smsmanager.cz/GetUserInfo', [
                'form_params' => [
                    'apikey' => $this->apiKey
                ]
            ]);
            return new UserInfo($res->getBody());
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }
}
