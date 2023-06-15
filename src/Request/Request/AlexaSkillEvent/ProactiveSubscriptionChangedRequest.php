<?php

namespace Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent;

use Winegard\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class ProactiveSubscriptionChangedRequest extends AbstractRequest
{
    const TYPE = 'AlexaSkillEvent.ProactiveSubscriptionChanged';
    /**
     * @var string[]
     */
    public $subscriptions;

    /**
     * @param array $amazonRequest
     */
    protected function setRequestData(array $amazonRequest)
    {
        $body = (array) $amazonRequest['body'];
        $this->subscriptions = $body['subscriptions'];

        $this->setTime('timestamp', $amazonRequest['timestamp']);
    }

    private function setTime($attribute, $value)
    {
        //Workaround for amazon developer console sending unix timestamp
        try {
            $this->{$attribute} = new \DateTime($value);
        } catch (\Exception $e) {
            $this->{$attribute} = (new \DateTime())->setTimestamp(intval($value / 1000));
        }
    }

    /**
     * @inheritdoc
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
