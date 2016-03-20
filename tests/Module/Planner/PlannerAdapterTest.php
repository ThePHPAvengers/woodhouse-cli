<?php
namespace Woodhouse\Module\Planner;

use Pimple\Container;
use Woodhouse\Module\Module;
use Woodhouse\Module\Modules;
use Woodhouse\Task\ITask;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class PlannerAdapterTest
 * @package Woodhouse\Module\Planner
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class PlannerAdapterTest extends \PHPUnit_Framework_TestCase
{

    public function testExecute()
    {
        $modules = new Modules();

        $moduleA = new Module();
        $moduleA->setTasks([
            'Woodhouse\Module\resources\TaskA',
            'Woodhouse\Module\resources\TaskB',
        ]);
        $modules[] = $moduleA;

        $moduleB = new Module();
        $moduleB->setTasks([
            'Woodhouse\Module\resources\TaskC',
        ]);
        $modules[] = $moduleB;


        $input = new ArrayInput([]);
        $output = new BufferedOutput();

        $questionHelper = $this->getQuestionHelperMock();

        $adapter = new PlannerAdapter(
            new ModulesPlannerBuilder(new Container(), $modules, $questionHelper),
            $questionHelper
        );
        $this->assertSame(ITask::NO_ERROR_CODE, $adapter->execute($input, $output));
        $this->assertSame('ABC', $output->fetch());

    }

    /**
     * @return \Symfony\Component\Console\Helper\QuestionHelper
     */
    private function getQuestionHelperMock()
    {
        $helper = $this->getMockBuilder('Symfony\Component\Console\Helper\QuestionHelper')->disableOriginalConstructor()->getMock();

        $helper->expects($this->exactly(3))
            ->method('ask')
            ->will($this->returnValue(true));

        return $helper;
    }
}
