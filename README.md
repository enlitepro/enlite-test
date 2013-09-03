Installation
============

Modify `TestConfig.php.dist` and change glob path options to:

    'config_glob_paths' => array(
        'config/autoload/{,*.}{global,local}.php',
        __DIR__ . "/global.php"
    )

Create file `glob.php` near id `test` directory with options like this

    <?php

    return array(
        'doctrine' => array(
            'connection' => array(
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                    'params' => array(
                        'memory' => true
                    ),
                )
            ),
        ),
    );

Now in your test you can use real database

    <?php

    class SomeTest extends \PHPUnit_Framework_TestCase
    {
        use \EnliteTest\RealDatabase;

        public function testSave()
        {
            $entity = new Some();
            $entity->setTitle('hello');

            $em = $this->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $this->assertSame($entity, $em->getRepository('Some')->find($entity->getId()));
        }

    }