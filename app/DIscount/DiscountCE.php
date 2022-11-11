<?php

namespace Corazon\DiscountApp\Discount;

use Corazon\DiscountApp\Product;

class DiscountCE extends Discount implements DiscountInterface
{
    private const DISCOUNT = 0.04;

    public function __construct(?DiscountInterface $discount = null)
    {
        $this->setNext($discount);
    }

    public function calculate(array $products): array
    {
        $productsForDiscount = [];

        /** @var Product $product */
        foreach ($products as $product) {
            if ($product->getName() === 'C' && !$product->isLockedForDiscount()) {
                $productsForDiscount[] = $product;
                continue;
            }

            if ($product->getName() === 'E' && !$product->isLockedForDiscount()) {
                $productsForDiscount[] = $product;
            }
        }

        if (count($productsForDiscount) === 2) {
            /** @var Product $product */
            foreach ($products as $product) {
                if ($product->getName() === 'C' || $product->getName() == 'E') {
                    $product->setPrice($product->getPrice() - $product->getPrice() * self::DISCOUNT);
                }
            }
        } else {
            echo "Discount CE is not applicable" . PHP_EOL;
        }

        if ($this->successor !== null) {
            return $this->successor->calculate($products);
        }

        return $products;
    }
}