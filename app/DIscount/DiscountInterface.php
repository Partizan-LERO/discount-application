<?php

namespace Corazon\DiscountApp\Discount;

interface DiscountInterface
{
    public function calculate(array $products): array;
    public function setNext(DiscountInterface $discount);
}