<?php

namespace Cloud\Subscribers\Client;

class Client {

	public function subscribe($events)
	{
		$events->listen('order.onCreated','Cloud\Subscribers\Client\Subscribers\Order@onCreated');
		$events->listen('order.onCreated','Cloud\Subscribers\Client\Subscribers\Order@onPayment');
		$events->listen('order.onPayment','Cloud\Subscribers\Client\Subscribers\Order@onPayment');
	}
}
?>