<?php

namespace wodCZ\NetteDotenv;

use Nette\DI\CompilerExtension;

class DotEnvExtension extends CompilerExtension
{
    public $defaults = array(
        'directory' => '%appDir%/../',
        'fileName' => '.env',
        'overload' => false,
        'localOnly' => false,
        'prefix' => false,
        'class' => '\wodCZ\NetteDotenv\EnvAccessor'
    );

    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);

        $builder = $this->getContainerBuilder();

        $id = 'env';
        $name = $config['prefix'] ? $this->prefix($id) : $id;
        $builder->addDefinition($name)
            ->setClass($config['class'], array(
                'directory' => $config['directory'],
                'fileName' => $config['fileName'],
                'overload' => $config['overload'],
                'localOnly' => $config['localOnly'],
            ));
    }
}
