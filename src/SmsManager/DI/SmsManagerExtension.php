<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager\DI;

use SmsManager\Http\Client;
use Nette\DI\CompilerExtension;

class SmsManagerExtension extends CompilerExtension
{

	/** @var array|null[]  */
	protected array $defaults = [
		'apiKey' => NULL,
	];


	public function loadConfiguration(): void
	{
		$config = $this->validateConfig($this->defaults);

		$builder = $this->getContainerBuilder();

		$builder->addDefinition('smsmanager.client')
			->setFactory(Client::class, [
				$config['apiKey'],
			]);
	}

}
