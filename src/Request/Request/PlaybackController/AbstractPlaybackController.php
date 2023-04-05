<?php

namespace Winegard\AmazonAlexa\Request\Request\PlaybackController;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
abstract class AbstractPlaybackController extends AbstractRequest
{
    /**
     * @var string
     */
    public $requestId;

    /**
     * @var string
     */
    public $locale;

    /**
     * @param array $amazonRequest
     */
    protected function setRequestData(array $amazonRequest)
    {
        try {
            $this->timestamp = new \DateTime($amazonRequest['timestamp']);
        } catch (\Exception $e) {
            $this->timestamp = (new \DateTime())->setTimestamp(intval($amazonRequest['timestamp'] / 1000));
        }
        $this->requestId = isset($amazonRequest['requestId']) ? $amazonRequest['requestId'] : null;
        $this->locale    = isset($amazonRequest['locale']) ? $amazonRequest['locale'] : null;
    }
}
