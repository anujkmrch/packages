<?php

namespace Dsvv\Subscribers\Client;

class Client {

	public function subscribe($events)
	{
		$events->listen('order.onCreated','Dsvv\Subscribers\Client\Subscribers\Order@onCreated');
		$events->listen('order.onCreated','Dsvv\Subscribers\Client\Subscribers\Order@onPayment');
		$events->listen('order.onPayment','Dsvv\Subscribers\Client\Subscribers\Order@onPayment');
	}
}
?>