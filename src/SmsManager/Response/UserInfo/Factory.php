<?php declare(strict_types = 1);

namespace SmsManager\Response\UserInfo;

final class Factory
{

	public static function create(\Psr\Http\Message\ResponseInterface $response): \SmsManager\Response\UserInfo
	{
		$responseBody = \trim((string) $response->getBody());

		$items = explode('|', $responseBody);

		[$credit, $sender, $messageType] = $items;

		return new \SmsManager\Response\UserInfo(
			$credit,
			$sender,
			$messageType
		);
	}

}
