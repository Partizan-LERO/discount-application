<?php

namespace Corazon\DiscountApp;

// товар
final class Product
{
    private string $name;
    private int $price;
    private bool $isLockedForDiscount = false;

    /**
     * @param string $name
     * @param int $price
     */
    public function __construct(
        string $name,
        int $price
    )
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isLockedForDiscount(): bool
    {
        return $this->isLockedForDiscount;
    }

    /**
     * @param bool $isLockedForDiscount
     */
    public function setIsLockedForDiscount(bool $isLockedForDiscount): void
    {
        $this->isLockedForDiscount = $isLockedForDiscount;
    }
}
