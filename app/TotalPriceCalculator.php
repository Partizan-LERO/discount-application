<?php

namespace Corazon\DiscountApp;

class TotalPriceCalculator
{
    private array $discounts;
    private ShopCart $shopCart;

    public function __construct(ShopCart $shopCart)
    {
        $this->shopCart = $shopCart;
    }

    public function calculateTotalPriceWithoutDiscounts(): float
    {
        $totalCost = 0;
        $products = $this->shopCart->getProducts();
        /** @var Product $product */
        foreach ($products as $product) {
            $totalCost += $product->getPrice();
        }

        return $totalCost;
    }

    public function calculateTotalPrice(array $products): float
    {
        $totalCost = 0;

        /** @var Product $product */
        foreach ($products as $product) {
            $totalCost += $product->getPrice();
        }

        return $totalCost;
    }
}