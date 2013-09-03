<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteTestTest\EnliteTestTest;


use EnliteTestTest\Fixtures\RealDatabaseFixture;



class RealDatabaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \RuntimeException
     */
    public function testGetServiceManagerNotFound()
    {
        $this->invoke();
    }

    public function testGetServiceManager()
    {
        include __DIR__ . "/Fixtures/Bootstrap.php";
        $this->invoke();
    }

    public function invoke()
    {
        $fixture = new RealDatabaseFixture();
        $object = new \ReflectionObject($fixture);
        $method = $object->getMethod('getServiceManager');
        $method->setAccessible(true);

        $result = $method->invoke($fixture);
        $this->assertInstanceOf('Zend\ServiceManager\ServiceLocatorInterface', $result);
    }

}
 