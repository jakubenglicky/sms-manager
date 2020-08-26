<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Http;

final class Client implements \SmsManager\IClient
{

	/**
	 * @var \GuzzleHttp\Client
	 */
	private $client;

	/**
	 * @var string $apiKey
	 */
	private $apiKey;


	public function __construct(string $apiKey)
	{
		$this->apiKey = $apiKey;
		$this->client = new \GuzzleHttp\Client();
	}


	/**
	 * @throws \SmsManager\Exceptions\SmsManagerException|\Exception
	 */
	public function send(\SmsManager\Message\Message $message): \SmsManager\Response\Sent
	{
		try {
			$response = $this->client->post('https://http-api.smsmanager.cz/Send', [
				'form_params' => [
					'apikey' => $this->apiKey,
					'number' => $message->getCommaSeparateNumbers(),
					'gateway' => $message->getMessageType(),
					'message' => $message->getBody(),
				],
			]);
		} catch (\Exception $clientEx) {
		   \SmsManager\Exceptions\Processor::process($clientEx);
		}

		return \SmsManager\Response\Sent\Factory::create($response, $message);
	}


	/**
	 * @throws \SmsManager\Exceptions\SmsManagerException|\Exception
	 */
	public function getUserInfo(): \SmsManager\Response\UserInfo
	{
		try {
			$response = $this->client->post('https://http-api.smsmanager.cz/GetUserInfo', [
				'form_params' => [
					'apikey' => $this->apiKey,
				],
			]);
		} catch (\Exception $clientEx) {
			\SmsManager\Exceptions\Processor::process($clientEx);
		}

		return \SmsManager\Response\UserInfo\Factory::create($response);
	}

}
