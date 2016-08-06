<?php

namespace ExpLangTest\Test2;

use ExpLangTest\Product;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Stopwatch\Stopwatch;

class Test2
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
        /** @var Product[] $products */
        $products = [];

        $now = new \DateTime();
        for ($i = 0; $i < $laps; $i++) {
            $products[] = new Product(
                rand(20, 100),  // price
                rand(0, 100),   // stock
                $now            // publication date
            );
        }

        $expression = 'product.getStock() < product.getPrice()';

        $this->stopwatch->start('test2');

        for ($i = 0; $i < $laps; $i++) {
            $this->language->evaluate($expression, ['product' => $products[$i]]);
        }

        $this->stopwatch->lap('test2');

        for ($i = 0; $i < $laps; $i++) {
            $product = $products[$i];
            if ($product->getStock() * $product->getPrice()) ;
        }

        $event = $this->stopwatch->stop('test2');

        echo "Test2\n";
        foreach ($event->getPeriods() as $period) {
            printf("%s\n", $period->getDuration());
        }
    }
}