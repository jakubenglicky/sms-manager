<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\Http\Response\Error;
use jakubenglicky\SmsManager\Http\Response\Sent;
use jakubenglicky\SmsManager\Http\Response\UserInfo;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message\Message;

final class Client implements IClient
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
     * Send SMS via HTTP POST request
     * @param Message $message
     * @return Error|Sent
     * @throws \jakubenglicky\SmsManager\Exceptions\ApiException
     * @throws \jakubenglicky\SmsManager\Exceptions\ContentException
     * @throws \jakubenglicky\SmsManager\Exceptions\CreditException
     * @throws \jakubenglicky\SmsManager\Exceptions\InvalidCredentialsException
     * @throws \jakubenglicky\SmsManager\Exceptions\SenderException
     * @throws \jakubenglicky\SmsManager\Exceptions\TextException
     * @throws \jakubenglicky\SmsManager\Exceptions\UndefinedNumberException
     * @throws \jakubenglicky\SmsManager\Exceptions\UnknownMessageTypeException
     * @throws \jakubenglicky\SmsManager\Exceptions\WrongDataFormatException
     */
    public function send(Message $message)
    {
        try {
            $res = $this->client->post('https://http-api.smsmanager.cz/Send', [
                'form_params' => [
                    'apikey' => $this->apiKey,
                    'number' => $message->getCommaSeparateNumbers(),
                    'gateway' => $message->getMessageType(),
                    'message' => $message->getBody(),
                ]
            ]);
            return new Sent($res, $message);
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }

    /**
     * @return Error|UserInfo
     * @throws \jakubenglicky\SmsManager\Exceptions\ApiException
     * @throws \jakubenglicky\SmsManager\Exceptions\ContentException
     * @throws \jakubenglicky\SmsManager\Exceptions\CreditException
     * @throws \jakubenglicky\SmsManager\Exceptions\InvalidCredentialsException
     * @throws \jakubenglicky\SmsManager\Exceptions\SenderException
     * @throws \jakubenglicky\SmsManager\Exceptions\TextException
     * @throws \jakubenglicky\SmsManager\Exceptions\UndefinedNumberException
     * @throws \jakubenglicky\SmsManager\Exceptions\UnknownMessageTypeException
     * @throws \jakubenglicky\SmsManager\Exceptions\WrongDataFormatException
     */
    public function getUserInfo()
    {
        try {
            $res = $this->client->post('https://http-api.smsmanager.cz/GetUserInfo', [
                'form_params' => [
                    'apikey' => $this->apiKey
                ]
            ]);
            return new UserInfo($res);
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }
}
