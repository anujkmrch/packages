<?php

namespace Hpp\Subscribers\Client;

class Client {

	public function subscribe($events)
	{
		$events->listen('order.onCreated','Hpp\Subscribers\Client\Subscribers\Order@onCreated');
		$events->listen('order.onCreated','Hpp\Subscribers\Client\Subscribers\Order@onPayment');
		$events->listen('order.onPayment','Hpp\Subscribers\Client\Subscribers\Order@onPayment');
	}
}
?>