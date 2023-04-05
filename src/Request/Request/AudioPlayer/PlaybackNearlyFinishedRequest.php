<?php

namespace Winegard\AmazonAlexa\Request\Request\AudioPlayer;

use Winegard\AmazonAlexa\Helper\PropertyHelper;
use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class PlaybackNearlyFinishedRequest extends AudioPlayerRequest
{
    const TYPE = 'AudioPlayer.PlaybackNearlyFinished';

    /**
     * @var int|null
     */
    public $offsetInMilliseconds;

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type                 = self::TYPE;
        $request->offsetInMilliseconds = PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds');
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
