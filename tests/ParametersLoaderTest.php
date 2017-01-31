<?php

namespace wodCZ\NetteDotenv;

class ParametersLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadsFile()
    {
        $ts = new ParametersLoader(__DIR__);
        $ts->getParameters();
        $this->assertArrayHasKey('something', $_ENV);
        $this->assertEquals('something', $_ENV['something']);
    }

    public function testFailsSilentlyIfFileDoesNotExist()
    {
        $ts = new ParametersLoader(__DIR__, 'nothing');
        $ts->getParameters();
    }

    public function testDoesNotOverrideByDefault()
    {
        $_ENV['something'] = 'existingEnvVariable';
        $ts = new ParametersLoader(__DIR__);
        $ts->getParameters();
        $this->assertEquals('existingEnvVariable', $_ENV['something']);
    }

    public function testOverridesWhenConfigured()
    {
        $_ENV['something'] = 'existingEnvVariable';
        $ts = new ParametersLoader(__DIR__, '.env', 'ENV', true);
        $ts->getParameters();
        $this->assertEquals('something', $_ENV['something']);
    }

    public function testReturnsArrayAsExpected()
    {
        $ts = new ParametersLoader(__DIR__, '.env', 'SOMENAMESPACE');

        $params = $ts->getParameters();

        $this->assertArrayHasKey('SOMENAMESPACE', $params);
        $this->assertArrayHasKey('something', $params['SOMENAMESPACE']);
    }

    public function testEscapesParameters()
    {
        $ts = new ParametersLoader(__DIR__);
        $params = $ts->getParameters();
        $this->assertEquals('some%%20string%%20', $params['ENV']['percent']);
    }
}
