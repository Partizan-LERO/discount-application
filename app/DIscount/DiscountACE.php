<?php

namespace Corazon\DiscountApp\Discount;

class DiscountACE extends Discount implements DiscountInterface
{
    private const DISCOUNT = 0.15;

    public function __construct(?DiscountInterface $discount = null)
    {
        $this->setNext($discount);
    }

    public function calculate(array $products): array
    {
        $productsForDiscount = [];

        /** @var Product $product */
        foreach ($products as $product) {
            if ($product->getName() === 'A') {
                $productsForDiscount[] = $product;
                continue;
            }

            if ($product->getName() === 'C') {
                $productsForDiscount[] = $product;
                continue;
            }

            if ($product->getName() === 'E' && !$product->isLockedForDiscount()) {
                $productsForDiscount[] = $product;
            }
        }

        if (count($productsForDiscount) === 3) {
            /** @var Product $product */
            foreach ($products as $product) {
                if ($product->getName() === 'E') {
                    $product->setPrice($product->getPrice() - $product->getPrice() * self::DISCOUNT);
                }

                if ($product->getName() === 'A' || $product->getName() === 'C' || $product->getName() === 'E') {
                    $product->setIsLockedForDiscount(true);
                }
            }
        } else {
            echo "Discount ACE is not applicable" . PHP_EOL;
        }

        if ($this->successor !== null) {
            return $this->successor->calculate($products);
        }

        return $products;
    }
}