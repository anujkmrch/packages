<?php

namespace Order\Contracts;

interface CartItemInterface
{
    public function onOrderConfirmed();
}