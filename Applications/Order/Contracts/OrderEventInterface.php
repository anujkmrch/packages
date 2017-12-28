<?php

namespace Order\Contracts;

interface OrderEventInterface
{
    public function onCreated(\Order\Models\Order $order);
	public function onPayment(\Order\Models\Order $order);
}