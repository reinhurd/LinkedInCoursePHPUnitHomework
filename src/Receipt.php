<?php

namespace TDD;
use \BadMethodCallException;

class Receipt
{
    public function __construct($formatter)
    {
        $this->Formatter = $formatter;
    }

    public function subtotal($items = [], $coupon = null)
    {
        if ($coupon > 1.00) {
            throw new BadMethodCallException('Coupons must be less than or equal to 1.00');
        }
        $sum = array_sum($items);
        if ($coupon) {
            return $sum - ($sum * $coupon);
        }
        return $sum;

    }

    public function tax($amount) {
        return $this->Formatter->currencyAmt($amount * $this->tax);
    }

    public function postTaxTotal($items, $coupons)
    {
        $subtotal = $this->subtotal($items, $coupons);
        return $subtotal + $this->tax($subtotal);
    }


}