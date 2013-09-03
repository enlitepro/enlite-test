<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteTestTest;


use Zend\ServiceManager\ServiceManager;

class Bootstrap
{

    public static function getServiceManager()
    {
        return new ServiceManager();
    }

} 