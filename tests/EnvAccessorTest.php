<?php

namespace wodCZ\NetteDotenv;

class EnvAccessorTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadsFile()
    {
        $ts = new EnvAccessor(__DIR__);
        $ts->get('just_trigger_load');
        $this->assertArrayHasKey('something', $_ENV);
        $this->assertEquals('something', $_ENV['something']);
    }

    public function testFailsSilentlyIfFileDoesNotExist()
    {
        $ts = new EnvAccessor(__DIR__, 'nothing');
        $ts->get('just_trigger_load');
    }

    public function testDoesNotOverrideByDefault()
    {
        $_ENV['something'] = 'existingEnvVariable';
        $ts = new EnvAccessor(__DIR__);
        $ts->get('just_trigger_load');
        $this->assertEquals('existingEnvVariable', $_ENV['something']);
    }

    public function testOverridesWhenConfigured()
    {
        $_ENV['something'] = 'existingEnvVariable';
        $ts = new EnvAccessor(__DIR__, '.env', 'ENV', true);
        $ts->get('just_trigger_load');
        $this->assertEquals('something', $_ENV['something']);
    }

    public function testReturnsParameter()
    {
        $ts = new EnvAccessor(__DIR__);
        $this->assertEquals('some%20string%20', $ts->get('percent'));
    }
    public function testReturnsDefaultOnNonExistent()
    {
        $ts = new EnvAccessor(__DIR__);
        $this->assertEquals('default', $ts->get('some_non_existing_key', 'default'));
    }
}
