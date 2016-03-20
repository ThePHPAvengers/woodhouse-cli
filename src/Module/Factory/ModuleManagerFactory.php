<?php
namespace Woodhouse\Module\Factory;

use Balloon\Factory\BalloonFactory;

/**
 * Class ModuleManagerFactory
 *
 * @package Woodhouse\Module\Factory
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ModuleManagerFactory extends BalloonFactory
{
    /**
     * @param string $filePath
     * @param string $className
     * @param string $primaryKey
     * @return \Woodhouse\Module\ModuleManager
     */
    public function create($filePath, $className = 'Woodhouse\Module\Module', $primaryKey = 'name')
    {
        return parent::create($filePath, $className, $primaryKey);
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return 'Woodhouse\Module\ModuleManager';
    }
}
