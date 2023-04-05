<?php

namespace Winegard\AmazonAlexa\Response\CanFulfill;

use Winegard\AmazonAlexa\Response\ResponseBodyInterface;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class CanFulfillResponseBody implements ResponseBodyInterface
{
    /**
     * @var CanFulfillIntentResponse|null
     */
    public $canFulfillIntent;

    /**
     * @param CanFulfillIntentResponse $canFulfillIntent
     *
     * @return CanFulfillResponseBody
     */
    public static function create(CanFulfillIntentResponse $canFulfillIntent): self
    {
        $canFulfillResponseBody = new self();

        $canFulfillResponseBody->canFulfillIntent = $canFulfillIntent;

        return $canFulfillResponseBody;
    }
}
