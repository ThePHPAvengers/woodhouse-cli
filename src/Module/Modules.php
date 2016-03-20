<?php
namespace Woodhouse\Module;

/**
 * Class Modules
 *
 * @package Woodhouse\Module
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Modules extends \ArrayObject
{
    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach($this as $key => $module){
            $result[$key] = $module->toArray();
        }
        return $result;
    }
}
