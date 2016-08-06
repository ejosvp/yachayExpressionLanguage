<?php

namespace ExpLangTest\Test3;

use ExpLangTest\Product;
use Symfony\Component\Stopwatch\Stopwatch;

class Test3
{
    private $stopwatch;
    private $language;
    private $engine;

    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
        $this->language = new Language();
        $this->engine = new Engine($this->language);
    }

    public function run($laps = 1000000)
    {
        /** @var Product[] $products */
        $products = [];

        $date = new \DateTime();
        for ($i = 0; $i < $laps; $i++) {
            $pubdate = $date->sub(\DateInterval::createFromDateString(rand(1, 50) . ' year'));
            $products[] = new Product(
                rand(20, 100),  // price
                rand(0, 10),   // stock
                $pubdate        // publication date
            );
        }

        $this->engine->addDiscountRule("product.getStock() == 1 ? 0.1 : 0");
        $this->engine->addDiscountRule("date('now') >= date('2014-01-20') and date('now') <= date('2014-02-02') ? 0.05 : 0");
        $this->engine->addDiscountRule("date('now') < date_modify(product.getCreationDate(), '+1 year') and product.getStock() < 5 ? 0.5 : 0");

        $this->stopwatch->start('test3');

        for ($i = 0; $i < $laps; $i++) {
            $this->engine->calculatePrice($products[$i]);
        }

        $now = new \DateTime('now');
        $validFrom = new \DateTime('2016-07-31');
        $validTo = new \DateTime('2016-09-01');

        $this->stopwatch->lap('test3');

        for ($i = 0; $i < $laps; $i++) {
            $product = $products[$i];
            if (
                ($product->getStock() < 50 or ($product->getPrice() > 10 and $product->getPrice() < 50))
                and !($product->getCreationDate()->modify('+1 year') < new \DateTime('now'))
                and $now > $validFrom and $now < $validTo
            ) {
                // pass
            }
        }

        $event = $this->stopwatch->stop('test3');

        echo "Test3\n";
        foreach ($event->getPeriods() as $period) {
            printf("%s\n", $period->getDuration());
        }

    }
}