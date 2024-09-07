<?php
namespace Carolinasanches24\PhpPdo\Aggregate;
class OrderItem{
    public function __construct(
        private string $product,
        private int $quantity,
        private float $price){
            $this->product = $product;
            $this->quantity = $quantity;
            $this->price = $price;
    }

    public function getTotal():float{
        return $this->quantity * $this->price;
    }
    public function getProduct():string{
        return $this->product;
    }

}