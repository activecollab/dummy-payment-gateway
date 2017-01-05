<?php

/*
 * This file is part of the Active Collab Dummy Payment Gateway project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\DummyPaymentGateway;

use ActiveCollab\DateValue\DateTimeValueInterface;
use ActiveCollab\DummyPaymentGateway\Traits\SubscriptionEvent;
use ActiveCollab\Payments\Common\Traits\GatewayedObject;
use ActiveCollab\Payments\Common\Traits\TimestampedObject;
use ActiveCollab\Payments\Gateway\GatewayInterface;
use ActiveCollab\Payments\Subscription\Rebill\RebillInterface;
use InvalidArgumentException;

class Rebill implements RebillInterface
{
    use GatewayedObject, TimestampedObject, SubscriptionEvent;

    /**
     * Construct a new refund instance.
     *
     * @param string                 $subscription_reference
     * @param DateTimeValueInterface $timestamp
     * @param DateTimeValueInterface $next_billing_timestamp
     * @param GatewayInterface|null  $gateway
     */
    public function __construct($subscription_reference, DateTimeValueInterface $timestamp, DateTimeValueInterface $next_billing_timestamp, GatewayInterface &$gateway = null)
    {
        if (empty($subscription_reference)) {
            throw new InvalidArgumentException('Subscription # is required');
        }

        $this->setSubscriptionReference($subscription_reference);
        $this->setTimestamp($timestamp);
        $this->next_billing_timestamp = $next_billing_timestamp;

        if ($gateway) {
            $this->setGatewayByReference($gateway);
        }
    }

    /**
     * @var DateTimeValueInterface
     */
    private $next_billing_timestamp;

    /**
     * Return next billing timestamp.
     *
     * @return DateTimeValueInterface
     */
    public function getNextBillingTimestamp()
    {
        return $this->next_billing_timestamp;
    }
}