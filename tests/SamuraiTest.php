<?php
namespace Woodhouse;

use Symfony\Component\Console\Application;

/**
 * Class WoodhouseTest
 * @package Woodhouse
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class WoodhouseTest extends \PHPUnit_Framework_TestCase
{

    public function testRun()
    {
        $application = $this->getMockBuilder('Symfony\Component\Console\Application')->getMock();

        $application->expects($this->once())
            ->method('run')
            ->will($this->returnValue(0));

        $Woodhouse = new Woodhouse($application);
        $this->assertSame(0, $Woodhouse->run());
    }

    public function testGetServices()
    {
        $Woodhouse = new Woodhouse(new Application());
        foreach($Woodhouse->getServices()->keys() as $key){
            $this->assertNotNull($Woodhouse->getServices()[$key]);
        }
    }
}
