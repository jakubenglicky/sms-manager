<?php declare(strict_types = 1);

namespace SmsManager\Response\Sent;

final class Factory
{

	public static function create(
		\Psr\Http\Message\ResponseInterface $response,
		\SmsManager\Message\Message $message
	): \SmsManager\Response\Sent
	{
		$responseBody = \trim((string) $response->getBody());

		$items = explode('|', $responseBody);

		if (isset($items[0]) && $items[0] === 'OK') {
			return new \SmsManager\Response\Sent(
				TRUE,
				$responseBody,
				200,
				(int) $items[1],
				$message
			);
		}

		return new \SmsManager\Response\Sent(
			FALSE,
			$responseBody,
			(int) $items[1] ?? 0,
			0,
			$message
		);
	}

}
