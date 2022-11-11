<?php

namespace Corazon\DiscountApp\Discount;

use Corazon\DiscountApp\Product;

class DiscountA extends Discount implements DiscountInterface
{
    private const DISCOUNT = 0.05;

    public function __construct(?DiscountInterface $discount = null)
    {
        $this->setNext($discount);
    }

    public function calculate(array $products): array
    {
        $isApplicable = false;

        /** @var Product $product */
        foreach ($products as $product) {
            if ($product->getName() === 'A' && !$product->isLockedForDiscount()) {
                $product->setPrice($product->getPrice() - $product->getPrice() * self::DISCOUNT);
                $isApplicable = true;
            }
            break;
        }

        if (!$isApplicable) {
            echo "Discount A is not applicable" . PHP_EOL;
        }

        if ($this->successor !== null) {
            return $this->successor->calculate($products);
        }

        return $products;
    }
}