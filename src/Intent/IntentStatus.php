<?php

namespace Winegard\AmazonAlexa\Intent;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class IntentStatus
{
    /**
     * @var string|null
     */
    public $code;

    /**
     * @param array $amazonRequest
     *
     * @return IntentStatus
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intentStatus = new self();

        $intentStatus->code = isset($amazonRequest['code']) ? $amazonRequest['code'] : null;

        return $intentStatus;
    }
}
