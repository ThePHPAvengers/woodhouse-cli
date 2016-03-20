<?php
namespace Woodhouse\Alias;

use Pimple\Container;
use Puppy\Config\ArrayConfig;
use Puppy\Config\Config;
use Woodhouse\Woodhouse;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class AliasCommandTest
 * @package Woodhouse\Command
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class AliasCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteSave()
    {
        $Woodhouse = new Woodhouse(new Application());
        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayNotHasKey('test', $alias);

        $command = $Woodhouse->getApplication()->find('alias');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'save',
            'bootstrap' => 'vendor/package',
            'name' => 'test',
            'version' => '@stable',
            'description' => 'description',
        ]);

        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayHasKey('test', $alias);
        $this->assertSame('vendor/package', $alias['test']->getPackage());
        $this->assertSame('@stable', $alias['test']->getVersion());
        $this->assertSame('description', $alias['test']->getDescription());
    }

    public function testExecuteListDefault()
    {
        $Woodhouse = new Woodhouse(new Application());
        $command = $Woodhouse->getApplication()->find('alias');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'list',
        ]);

        $this->assertStringStartsWith(
            "name: lib\ndescription: Basic PHP library\npackage: ThePHPAvengers/php-lib-bootstrap\nversion: \nsource:",
            $commandTester->getDisplay()
        );
    }

    public function testExecuteListGlobal()
    {
        $Woodhouse = new Woodhouse(new Application());
        $command = $Woodhouse->getApplication()->find('alias');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'list',
            '--global' => true,
        ]);

        $this->assertStringStartsWith(
            "name: lib\ndescription: Basic PHP library\npackage: ThePHPAvengers/php-lib-bootstrap\nversion: \nsource:",
            $commandTester->getDisplay()
        );
    }

    /**
     * @depends testExecuteSave
     */
    public function testExecuteListLocal()
    {
        $Woodhouse = new Woodhouse(new Application());
        $command = $Woodhouse->getApplication()->find('alias');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'list',
            '--local' => true,
        ]);

        $this->assertStringStartsWith(
            "name: test\ndescription: description\npackage: vendor/package\nversion: @stable\nsource:",
            $commandTester->getDisplay()
        );
    }

    /**
     * @depends testExecuteListLocal
     */
    public function testExecuteDeleteNoConfirm()
    {
        $questionHelper = $this->getMock('Symfony\Component\Console\Helper\QuestionHelper', array('ask'));

        $questionHelper->expects($this->at(0))
            ->method('ask')
            ->will($this->returnValue(false));

        $Woodhouse = new Woodhouse(new Application(), $this->provideServices($questionHelper));
        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayHasKey('test', $alias);

        $command = $Woodhouse->getApplication()->find('alias');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'rm',
            'name' => 'test',
        ]);

        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayHasKey('test', $alias);
    }

    /**
     * @depends testExecuteDeleteNoConfirm
     */
    public function testExecuteDeleteConfirm()
    {
        $questionHelper = $this->getMock('Symfony\Component\Console\Helper\QuestionHelper', array('ask'));

        $questionHelper->expects($this->at(0))
            ->method('ask')
            ->will($this->returnValue(true));

        $Woodhouse = new Woodhouse(new Application(), $this->provideServices($questionHelper));
        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayHasKey('test', $alias);

        $command = $Woodhouse->getApplication()->find('alias');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'action' => 'rm',
            'name' => 'test',
        ]);

        $alias = $Woodhouse->getServices()['alias_manager']->getLocal();
        $this->assertArrayNotHasKey('test', $alias);
    }

    /**
     * @param QuestionHelper $questionHelper
     * @return Container
     * @internal param $result
     */
    private function provideServices(QuestionHelper $questionHelper)
    {
        $services = new Container();

        $services['config'] = function () {
            return new Config('');
        };

        $services['helper_set'] = function () use ($questionHelper) {
            return new HelperSet(['question' => $questionHelper]);
        };

        $services['alias_manager'] = function () {
            $factory = new AliasManagerFactory();
            return $factory->createFromConfig(new Config(''));
        };
        return $services;
    }
}
