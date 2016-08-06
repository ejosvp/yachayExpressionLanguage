<?php
/**
 * https://florian.voutzinos.com/blog/using-symfony2-expression-language/
 */

namespace ExpLangTest\Test3;

use ExpLangTest\Product;

class Engine
{
    private $language;
    private $discountRules = [];

    /**
     * Creates a new pricing engine.
     *
     * @param Language $language Our custom language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Adds a discount rule.
     *
     * @param string $expression The discount expression
     */
    public function addDiscountRule($expression)
    {
        $this->discountRules[] = $expression;
    }

    /**
     * Calculates the product price.
     *
     * @param Product $product The product
     *
     * @return float The price
     */
    public function calculatePrice(Product $product)
    {
        $price = $product->getPrice();
        foreach ($this->discountRules as $discountRule) {
            $price -= $price * $this->language->evaluate($discountRule, ['product' => $product]);
        }

        return $price;
    }
}