<?php

namespace Winegard\AmazonAlexa\Request\Request\PlaybackController;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class PauseCommandIssued extends AbstractPlaybackController
{
    const TYPE = 'PlaybackController.PauseCommandIssued';

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $nextCommandIssued = new self();

        $nextCommandIssued->type = self::TYPE;

        $nextCommandIssued->setRequestData($amazonRequest);

        return $nextCommandIssued;
    }
}
