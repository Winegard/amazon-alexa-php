<?php

namespace Winegard\AmazonAlexa\Request\Request\AudioPlayer;

use Winegard\AmazonAlexa\Helper\PropertyHelper;
use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
abstract class AudioPlayerRequest extends AbstractRequest
{
    /**
     * @var string|null
     */
    public $token;

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
        $this->requestId = $amazonRequest['requestId'];
        $this->timestamp = new \DateTime($amazonRequest['timestamp']);
        //Workaround for amazon developer console sending unix timestamp
        try {
            $this->timestamp = new \DateTime($amazonRequest['timestamp']);
        } catch (\Exception $e) {
            $this->timestamp = (new \DateTime())->setTimestamp(intval($amazonRequest['timestamp'] / 1000));
        }
        $this->locale = $amazonRequest['locale'];
        $this->token  = PropertyHelper::checkNullValueString($amazonRequest, 'token');
    }
}
