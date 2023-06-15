<?php

namespace Winegard\AmazonAlexa\Request;

use Winegard\AmazonAlexa\Exception\MissingRequestDataException;
use Winegard\AmazonAlexa\Exception\MissingRequiredHeaderException;
use Winegard\AmazonAlexa\Helper\PropertyHelper;
use Winegard\AmazonAlexa\Request\Request\AbstractRequest;
use Winegard\AmazonAlexa\Request\Request\Messaging\MessagingReceived;
use Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillAccountLinkedRequest;
use Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledRequest;
use Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillEnabledRequest;
use Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionAcceptedRequest;
use Winegard\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionChangedRequest;
use Winegard\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFailedRequest;
use Winegard\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFinishedRequest;
use Winegard\AmazonAlexa\Request\Request\AudioPlayer\PlaybackNearlyFinishedRequest;
use Winegard\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStartedRequest;
use Winegard\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStoppedRequest;
use Winegard\AmazonAlexa\Request\Request\CanFulfill\CanFulfillIntentRequest;
use Winegard\AmazonAlexa\Request\Request\Display\ElementSelectedRequest;
use Winegard\AmazonAlexa\Request\Request\GameEngine\InputHandlerEvent;
use Winegard\AmazonAlexa\Request\Request\PlaybackController\NextCommandIssued;
use Winegard\AmazonAlexa\Request\Request\PlaybackController\PauseCommandIssued;
use Winegard\AmazonAlexa\Request\Request\PlaybackController\PlayCommandIssued;
use Winegard\AmazonAlexa\Request\Request\PlaybackController\PreviousCommandIssued;
use Winegard\AmazonAlexa\Request\Request\Standard\IntentRequest;
use Winegard\AmazonAlexa\Request\Request\Standard\LaunchRequest;
use Winegard\AmazonAlexa\Request\Request\Standard\SessionEndedRequest;
use Winegard\AmazonAlexa\Request\Request\System\ConnectionsResponseRequest;
use Winegard\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;

/**
 * @author Nicholas Bekeris <nick.bekeris@winegard.com>
 */
class Request
{
    /**
     * List of all supported amazon request types.
     */
    const REQUEST_TYPES = [
        // Standard types
        IntentRequest::TYPE                  => IntentRequest::class,
        LaunchRequest::TYPE                  => LaunchRequest::class,
        SessionEndedRequest::TYPE            => SessionEndedRequest::class,
        // AudioPlayer types
        PlaybackStartedRequest::TYPE         => PlaybackStartedRequest::class,
        PlaybackNearlyFinishedRequest::TYPE  => PlaybackNearlyFinishedRequest::class,
        PlaybackFinishedRequest::TYPE        => PlaybackFinishedRequest::class,
        PlaybackStoppedRequest::TYPE         => PlaybackStoppedRequest::class,
        PlaybackFailedRequest::TYPE          => PlaybackFailedRequest::class,
        // PlaybackController types
        NextCommandIssued::TYPE              => NextCommandIssued::class,
        PauseCommandIssued::TYPE             => PauseCommandIssued::class,
        PlayCommandIssued::TYPE              => PlayCommandIssued::class,
        PreviousCommandIssued::TYPE          => PreviousCommandIssued::class,
        // System types
        ExceptionEncounteredRequest::TYPE    => ExceptionEncounteredRequest::class,
        // Display types
        ElementSelectedRequest::TYPE         => ElementSelectedRequest::class,
        // Game engine types
        InputHandlerEvent::TYPE              => InputHandlerEvent::class,
        // can fulfill intent
        CanFulfillIntentRequest::TYPE        => CanFulfillIntentRequest::class,
        // Connections Response Request
        ConnectionsResponseRequest::TYPE     => ConnectionsResponseRequest::class,
        // Skill event types
        SkillAccountLinkedRequest::TYPE      => SkillAccountLinkedRequest::class,
        SkillEnabledRequest::TYPE            => SkillEnabledRequest::class,
        SkillDisabledRequest::TYPE           => SkillDisabledRequest::class,
        SkillPermissionAcceptedRequest::TYPE => SkillPermissionAcceptedRequest::class,
        SkillPermissionChangedRequest::TYPE  => SkillPermissionChangedRequest::class,
        // Messaging received event type
        MessagingReceived::TYPE              => MessagingReceived::class,
    ];

    /**
     * @var string|null
     */
    public $version;

    /**
     * @var Session|null
     */
    public $session;

    /**
     * @var Context|null
     */
    public $context;

    /**
     * @var AbstractRequest|null
     */
    public $request;

    /**
     * @var string
     */
    public $amazonRequestBody;

    /**
     * @var string
     */
    public $signatureCertChainUrl;

    /**
     * @var string
     */
    public $signature;

    /**
     * @param string $amazonRequestBody
     * @param string $signatureCertChainUrl
     * @param string $signature
     *
     * @throws MissingRequiredHeaderException
     * @throws MissingRequestDataException
     *
     * @return Request
     */
    public static function fromAmazonRequest(string $amazonRequestBody, string $signatureCertChainUrl, string $signature): self
    {
        $request = new self();

        $request->signatureCertChainUrl = $signatureCertChainUrl;
        $request->signature             = $signature;
        $request->amazonRequestBody     = $amazonRequestBody;
        $amazonRequest                  = (array) json_decode($amazonRequestBody, true);

        error_log("amazonRequest ::::");
        error_log(json_encode($amazonRequest));

        error_log("amazonRequest :::: REQUEST");
        error_log(json_encode($amazonRequest['request']));

        $request->version = PropertyHelper::checkNullValueString($amazonRequest, 'version');
        $request->session = isset($amazonRequest['session']) ? Session::fromAmazonRequest($amazonRequest['session']) : null;
        $request->context = isset($amazonRequest['context']) ? Context::fromAmazonRequest($amazonRequest['context']) : null;

        $request->setRequest($amazonRequest);
        $request->checkSignature();

        return $request;
    }

    /**
     * @return string|null
     */
    public function getApplicationId()
    {
        // workaround for developer console
        if ($this->session && $this->session->application) {
            return $this->session->application->applicationId;
        } elseif ($this->context && ($system = $this->context->system) && $system->application) {
            return $system->application->applicationId;
        }

        return null;
    }

    /**
     * @param array $amazonRequest
     *
     * @throws MissingRequestDataException
     */
    private function setRequest(array $amazonRequest)
    {
        if (!isset($amazonRequest['request']['type']) || !isset(self::REQUEST_TYPES[$amazonRequest['request']['type']])) {
            throw new MissingRequestDataException();
        }
        $this->request = (self::REQUEST_TYPES[$amazonRequest['request']['type']])::fromAmazonRequest($amazonRequest['request']);
    }

    /**
     * @throws MissingRequiredHeaderException
     */
    private function checkSignature()
    {
        if ($this->request->validateSignature() && (!$this->signatureCertChainUrl || !$this->signature)) {
            throw new MissingRequiredHeaderException();
        }
    }
}
