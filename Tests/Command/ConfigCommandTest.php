<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Fulgurio\LightCMSConfigBundle\Command\AddConfigCommand;
use Fulgurio\LightCMSConfigBundle\Command\EditConfigCommand;
use Fulgurio\LightCMSConfigBundle\Command\RemoveConfigCommand;

//use Symfony\Component\Console\Application;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigCommandTest  extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
    }

    public function testAddExecute()
    {
        $application = new Application(static::$kernel);
        $application->add(new AddConfigCommand());

        $command = $application->find('config:add');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                'command' => $command->getName(),
                'label'   => 'foo',
                'value'   => 'bare',
            )
        );
//        $this->assertRegExp('/.../', $commandTester->getDisplay());
    }

    public function testEditExecute()
    {
        $application = new Application(static::$kernel);
        $application->add(new EditConfigCommand());

        $command = $application->find('config:edit');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                'command' => $command->getName(),
                'label'   => 'foo',
                'value'   => 'bare2',
            )
        );
//        $this->assertRegExp('/.../', $commandTester->getDisplay());
    }

    public function testRemoveExecute()
    {
        $application = new Application(static::$kernel);
        $application->add(new RemoveConfigCommand());

        $command = $application->find('config:remove');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                'command' => $command->getName(),
                'label'   => 'foo'
            )
        );
//        $this->assertRegExp('/.../', $commandTester->getDisplay());
    }
}