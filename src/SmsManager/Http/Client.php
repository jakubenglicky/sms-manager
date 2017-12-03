<?php

namespace jakubenglicky\SmsManager\Http;

use GuzzleHttp;
use jakubenglicky\SmsManager\IClient;
use jakubenglicky\SmsManager\Message;

class Client implements IClient
{
    /**
     * SMS Manager login
     * @var string
     */
    private $username;

    /**
     * SMS Manager password
     * @var string
     */
    private $password;

    /**
     * Client constructor.
     * @param string $username
     * @param string $password
     * @param bool $hashed
     */
    public function __construct($username, $password, $hashed = FALSE)
    {
        $this->username = $username;
        ($hashed) ? $this->password = $password : $this->password = sha1($password);
    }

    /**
     * Send SMS via HTTP GET request
     * @param Message $message
     */
    public function send(Message $message)
    {
        $client = new GuzzleHttp\Client();

        try {
            $res = $client->request('GET', 'https://http-api.smsmanager.cz/Send', [
                'query' => [
                    'username' => $this->username,
                    'password' => $this->password,
                    'number' => $message->getNumbers(),
                    'gateway' => $message->getMessageType(),
                    'message' => $message->getBody(),
                ]
            ]);

           return new Response($res->getBody());

        } catch (GuzzleHttp\Exception\ClientException $clientEx) {
            return new ErrorResponse($clientEx);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(),$exception->getCode());
        }
    }
}
