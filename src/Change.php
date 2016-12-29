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
use ActiveCollab\Payments\Common\Traits\InternallyIdentifiedObject;
use ActiveCollab\Payments\Common\Traits\TimestampedObject;
use ActiveCollab\Payments\Gateway\GatewayInterface;
use ActiveCollab\Payments\Subscription\Change\ChangeInterface;
use InvalidArgumentException;

/**
 * @package ActiveCollab\Payments\Subscription\Change
 */
class Change implements ChangeInterface
{
    use GatewayedObject, TimestampedObject, InternallyIdentifiedObject, SubscriptionEvent;

    /**
     * Construct a new refund instance.
     *
     * @param string                 $subscription_reference
     * @param DateTimeValueInterface $timestamp
     * @param GatewayInterface|null  $gateway
     */
    public function __construct($subscription_reference, DateTimeValueInterface $timestamp, GatewayInterface &$gateway = null)
    {
        if (empty($subscription_reference)) {
            throw new InvalidArgumentException('Subscription # is required');
        }

        $this->setSubscriptionReference($subscription_reference);
        $this->setTimestamp($timestamp);
        $this->setGatewayByReference($gateway);
    }
}
