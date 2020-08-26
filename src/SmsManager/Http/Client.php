<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Http;

use GuzzleHttp;
use SmsManager\Http\Response\Error;
use SmsManager\Http\Response\Sent;
use SmsManager\Http\Response\UserInfo;
use SmsManager\IClient;
use SmsManager\Message\Message;

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
     * @throws \SmsManager\Exceptions\ApiException
     * @throws \SmsManager\Exceptions\ContentException
     * @throws \SmsManager\Exceptions\CreditException
     * @throws \SmsManager\Exceptions\InvalidCredentialsException
     * @throws \SmsManager\Exceptions\SenderException
     * @throws \SmsManager\Exceptions\TextException
     * @throws \SmsManager\Exceptions\UndefinedNumberException
     * @throws \SmsManager\Exceptions\UnknownMessageTypeException
     * @throws \SmsManager\Exceptions\WrongDataFormatException
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
     * @throws \SmsManager\Exceptions\ApiException
     * @throws \SmsManager\Exceptions\ContentException
     * @throws \SmsManager\Exceptions\CreditException
     * @throws \SmsManager\Exceptions\InvalidCredentialsException
     * @throws \SmsManager\Exceptions\SenderException
     * @throws \SmsManager\Exceptions\TextException
     * @throws \SmsManager\Exceptions\UndefinedNumberException
     * @throws \SmsManager\Exceptions\UnknownMessageTypeException
     * @throws \SmsManager\Exceptions\WrongDataFormatException
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
