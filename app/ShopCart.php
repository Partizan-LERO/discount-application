<?php

namespace Corazon\DiscountApp;

//  корзина
final class ShopCart
{
    private array $products = [];

    /**
     * @param $product
     * @return void
     */
    public function addProduct($product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
