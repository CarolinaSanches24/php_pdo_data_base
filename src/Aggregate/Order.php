<?php

namespace Carolinasanches24\PhpPdo\Aggregate;

class Order{
    private $orderItems = [];

    public function addItem(OrderItem $item){
        $this->orderItems[] = $item;
    }

    public function removeItem(string $product){
        foreach ($this->orderItems as $key => $item) {
            if ($item->getProduct() === $product) {
                unset($this->orderItems[$key]);
            }
        }
        // Reorganiza os índices do array
        $this->orderItems = array_values($this->orderItems);
    }

    public function getTotal(): float {
        $total = 0;
        foreach ($this->orderItems as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function getItems(): array {
        return $this->orderItems;
    }

}