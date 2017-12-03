<?php

namespace jakubenglicky\SmsManager\DI\SmsManagerExtension;

use Nette\DI\CompilerExtension;
use jakubenglicky\SmsManager\IClient;

class SmsManagerExtension extends CompilerExtension
{
    /**
     * @var string
     */
    private $password;

    public function loadConfiguration()
    {
        $config = $this->getConfig();

        if (!isset($config['username']) && !isset($config['password'])) {
            return;
        }

        ($config['hashed']) ? $this->password = $config['password'] : $this->password = sha1($config['password']);

        $builder = $this->getContainerBuilder();

        $smsmanager = $builder->addDefinition('smsmanager')
            ->setClass(IClient::class);

        $smsmanager->setFactory('jakubenglicky\SmsManager\Http\Client',[
            $config['username'],
            $config['password'],
            $config['hashed']
        ]);
    }
}
