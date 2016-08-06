<?php

namespace ExpLangTest;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Test1
{
    private $stopwatch;
    private $language;

    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
        $this->language = new ExpressionLanguage();
    }

    public function run($laps = 1000000)
    {
        $expression = '1 + 1';

        $this->stopwatch->start('test1');

        for ($i = 0; $i < $laps; $i++) {
            $this->language->evaluate($expression);
        }

        $this->stopwatch->lap('test1');

        for ($i = 0; $i < $laps; $i++) {
            if (1 + 1) ;
        }

        $event = $this->stopwatch->stop('test1');

        echo "Test1\n";
        foreach ($event->getPeriods() as $period) {
            printf("%s\n", $period->getDuration());
        }
    }
}