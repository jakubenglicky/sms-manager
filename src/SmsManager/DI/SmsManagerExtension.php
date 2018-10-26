<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\DI;

use jakubenglicky\SmsManager\IClient;
use Nette\DI\CompilerExtension;

class SmsManagerExtension extends CompilerExtension
{
    public function loadConfiguration(): void
    {
        $config = $this->getConfig();

        if (!isset($config['apiKey'])) {
            return;
        }

        $builder = $this->getContainerBuilder();

        $builder->addDefinition('smsmanager')
            ->setImplement(IClient::class)
            ->setFactory('jakubenglicky\SmsManager\Http\Client', [
                $config['apiKey'],
            ]);
    }
}
