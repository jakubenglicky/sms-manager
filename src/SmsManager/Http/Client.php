<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\Exceptions\ApiException;
use jakubenglicky\SmsManager\Exceptions\ContentException;
use jakubenglicky\SmsManager\Exceptions\CreditException;
use jakubenglicky\SmsManager\Exceptions\InvalidCredentialsException;
use jakubenglicky\SmsManager\Exceptions\MissingCredentialsException;
use jakubenglicky\SmsManager\Exceptions\SenderException;
use jakubenglicky\SmsManager\Exceptions\TextException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;
use jakubenglicky\SmsManager\Exceptions\UnknownMessageTypeException;
use jakubenglicky\SmsManager\Exceptions\WrongDataFormatException;
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
     *
     * @var string $apiKey
     */
    private $apiKey;

    /**
     * Client constructor.
     *
     * @param  string $apiKey
     * @throws MissingCredentialsException
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new MissingCredentialsException('Please fill apiKey.');
        }
        $this->apiKey = $apiKey;
        $this->client = new GuzzleHttp\Client();
    }

    /**
     * Send SMS via HTTP POST request
     *
     * @param  Message $message
     * @return Error|Sent
     * @throws ApiException
     * @throws ContentException
     * @throws CreditException
     * @throws InvalidCredentialsException
     * @throws SenderException
     * @throws TextException
     * @throws UndefinedNumberException
     * @throws UnknownMessageTypeException
     * @throws WrongDataFormatException
     */
    public function send(Message $message)
    {
        try {
            $res = $this->client->post(
                'https://http-api.smsmanager.cz/Send', [
                'form_params' => [
                    'apikey' => $this->apiKey,
                    'number' => $message->getCommaSeparateNumbers(),
                    'gateway' => $message->getMessageType(),
                    'message' => $message->getBody(),
                ]
                ]
            );
            return new Sent((string)$res->getBody(), $message);
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }

    /**
     * @return Error|UserInfo
     * @throws ApiException
     * @throws ContentException
     * @throws CreditException
     * @throws InvalidCredentialsException
     * @throws SenderException
     * @throws TextException
     * @throws UndefinedNumberException
     * @throws UnknownMessageTypeException
     * @throws WrongDataFormatException
     */
    public function getUserInfo()
    {
        try {
            $res = $this->client->post(
                'https://http-api.smsmanager.cz/GetUserInfo', [
                'form_params' => [
                    'apikey' => $this->apiKey
                ]
                ]
            );
            return new UserInfo((string)$res->getBody());
        } catch (\Exception $clientEx) {
            return new Error($clientEx);
        }
    }
}
