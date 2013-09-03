<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteTest;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Zend\ServiceManager\Exception\RuntimeException;
use Zend\ServiceManager\ServiceLocatorInterface;

trait DatabaseFixtureTrait
{

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EntityManager
     */
    public function getEntityManager()
    {
        /** @var EntityManager $em */
        $em = $this->getServiceManager()->get('DoctrineORMEntityManager');

        $schemaTool = new SchemaTool($em);
        $schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());

        return $em;
    }

    /**
     * @throws RuntimeException
     * @return ServiceLocatorInterface
     */
    private function getServiceManager()
    {
        foreach (get_declared_classes() as $class) {
            if (preg_match('#^[a-z]+Test\\\\Bootstrap$#mis', $class)) {
                $reflection = new \ReflectionClass($class);
                if ($reflection->hasMethod('getServiceManager')) {
                    return $class::getServiceManager();
                }
            }
        }

        throw new RuntimeException('Cannot find Bootstrap::getServiceManager() method');
    }

} 