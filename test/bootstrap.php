<?php

namespace EnliteTestTest;

define('SCAFFOLD_ROOT', dirname(__DIR__));

/** @var \Composer\Autoload\ClassLoader $autoload */
$autoload = include __DIR__ . "/../vendor/autoload.php";
$autoload->add(__NAMESPACE__, __DIR__);