<?php

include "vendor/autoload.php";

use Symfony\Component\Stopwatch\Stopwatch;

use ExpLangTest\Test1;
use ExpLangTest\Test2\Test2;
use ExpLangTest\Test3\Test3;

$stopwatch = new Stopwatch();

$laps = 100000;

(new Test1($stopwatch))->run($laps);
(new Test2($stopwatch))->run($laps);
(new Test3($stopwatch))->run($laps);