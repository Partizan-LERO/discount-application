<?php

namespace Corazon\DiscountApp\Discount;

use Corazon\DiscountApp\Product;

class DiscountAB extends Discount implements DiscountInterface
{
    private const DISCOUNT = 0.07;

    public function __construct(?DiscountInterface $discount = null)
    {
        $this->setNext($discount);
    }

    public function calculate(array $products): array
    {
        $productsForDiscount = [];

        /** @var Product $product */
        foreach ($products as $product) {
            if ($product->getName() === 'A' && !$product->isLockedForDiscount()) {
                $productsForDiscount[] = $product;
                continue;
            }

            if ($product->getName() === 'B' && !$product->isLockedForDiscount()) {
                $productsForDiscount[] = $product;
            }
        }

        if (count($productsForDiscount) === 2) {
            /** @var Product $product */
            foreach ($products as $product) {
                if ($product->getName() === 'A' || $product->getName() == 'B') {
                    $product->setPrice($product->getPrice() - $product->getPrice() * self::DISCOUNT);
                    $product->setIsLockedForDiscount(true);
                }
            }
        } else {
            echo "Discount AB is not applicable" . PHP_EOL;
        }

        if ($this->successor !== null) {
            return $this->successor->calculate($products);
        }

        return $products;
    }
}