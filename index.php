<?php

use Corazon\DiscountApp\Discount\DiscountA;
use Corazon\DiscountApp\Discount\DiscountAB;
use Corazon\DiscountApp\Discount\DiscountAC;
use Corazon\DiscountApp\Discount\DiscountACE;
use Corazon\DiscountApp\Discount\DiscountB;
use Corazon\DiscountApp\Discount\DiscountCE;
use Corazon\DiscountApp\Discount\DiscountDE;
use Corazon\DiscountApp\Product;
use Corazon\DiscountApp\ShopCart;
use Corazon\DiscountApp\TotalPriceCalculator;

require 'vendor/autoload.php';

$productA = new Product('A', 100);
$productB = new Product('B', 200);
$productC = new Product('C', 300);
$productD = new Product('D', 400);
$productE = new Product('E', 500);

$shopCart = new ShopCart();
$shopCart->addProduct($productA);
$shopCart->addProduct($productB);
$shopCart->addProduct($productC);
$shopCart->addProduct($productD);
$shopCart->addProduct($productE);

$calculator = new TotalPriceCalculator($shopCart);

echo PHP_EOL . $calculator->calculateTotalPriceWithoutDiscounts() . PHP_EOL;

$dA = new DiscountA();
$dB = new DiscountB();
$dAB = new DiscountAB();
$dAC = new DiscountAC();
$dDE = new DiscountDE();
$dCE = new DiscountCE();
$dACE = new DiscountACE();

$dACE->setNext($dDE);
$dDE->setNext($dCE);
$dCE->setNext($dAC);
$dAC->setNext($dAB);
$dAB->setNext($dA);
$dA->setNext($dB);

$products = $dACE->calculate($shopCart->getProducts());

echo PHP_EOL . $calculator->calculateTotalPrice($products) . PHP_EOL;