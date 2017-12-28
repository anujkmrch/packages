<?php
namespace Dsvv\Subscribers\Client\Subscribers;
use Order\Contracts\OrderEventInterface;

class Order implements OrderEventInterface {

	public function onCreated(\Order\Models\Order $order)
	{
		return "first created ".__METHOD__;
	}

	public function onPayment(\Order\Models\Order $order)
	{
		return "first payment ".__METHOD__;
	}
}
?>