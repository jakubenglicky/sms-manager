<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\Exceptions\MissingCredentialsException;
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
     * @var string|null $apiKey
     */
    private $apiKey;

    /**
     * Client constructor.
     * @param string|null $apiKey
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
     */
    public function send(Message $message)
    {
        try {
        	if (empty($this->apiKey)) {
        		throw new MissingCredentialsException('Please fill apiKey.');
	        }
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
     */
    public function getUserInfo()
    {
        try {
	        if (empty($this->apiKey)) {
		        throw new MissingCredentialsException('Please fill apiKey.');
	        }
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
