<?php

require_once 'vendor/autoload.php';
use Carolinasanches24\PhpPdo\Aggregate\Order;
use Carolinasanches24\PhpPdo\Aggregate\OrderItem;


$order = new Order();
$item1 = new OrderItem("Produto 1", 2, 50.00);
$item2 = new OrderItem("Produto 2", 1, 100.00);

$order->addItem($item1);
$order->addItem($item2);

echo "Total do Pedido: " . $order->getTotal(); // Total do Pedido: 200.00

$order->removeItem("Produto 1");
echo "\nTotal do Pedido após remoção: " . $order->getTotal(); // Total do Pedido após remoção: 100.00
