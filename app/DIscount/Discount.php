<?php

namespace Corazon\DiscountApp\Discount;

abstract class Discount
{
    protected ?DiscountInterface $successor;

    public function setNext(?DiscountInterface $discount = null): void
    {
        $this->successor = $discount;
    }

    public abstract function calculate(array $products): array;
}