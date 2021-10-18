<?php

namespace CXml\Models\Responses;

use phpDocumentor\Reflection\Types\Boolean;

class Profile implements ResponseInterface
{

    /**
     * @var int
     */
    protected $effectiveDate;

    /**
     * @var int
     */
    protected $lastRefresh;

    /**
     * @var string
     */
    protected $punchOutSetupRequestUrl;

    /**
     * Direct Punchout Options
     */
    protected $optionDirectURL;
    protected $optionDirectAuthenticationMethodCredentialMac;
    protected $optionDirectAuthenticationMethodCertificate;

    /**
     * MAC Options
     */
    protected $optionCredentialMacType;
    protected $optionCredentialMacAlgorithm;
    protected $optionCredentialMacCreationDate;
    protected $optionCredentialMacExpirationDate;
    protected $optionCredentialMacValue;

    /**
     * @var string
     */
    protected $orderRequestUrl;

    /**
     * Order Request Options
     */
    protected bool $optionOrderRequestAttachments = false;
    protected bool $optionOrderRequestChanges = false;

    public function __construct()
    {
        $this->effectiveDate = strtotime('2021-10-01 00:00:00');
        $this->lastRefresh = time();
    }

    /**
     * @return int
     */
    public function getEffectiveDate(): int
    {
        return $this->effectiveDate;
    }

    /**
     * @param int $effectiveDate
     */
    public function setEffectiveDate(int $effectiveDate): self
    {
        $this->effectiveDate = $effectiveDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastRefresh(): int
    {
        return $this->lastRefresh;
    }

    /**
     * @param int $lastRefresh
     */
    public function setLastRefresh(int $lastRefresh): self
    {
        $this->lastRefresh = $lastRefresh;
        return $this;
    }

    /**
     * @return string
     */
    public function getPunchOutSetupRequestUrl(): string
    {
        return $this->punchOutSetupRequestUrl;
    }

    /**
     * @param string $punchOutSetupRequestUrl
     */
    public function setPunchOutSetupRequestUrl(string $punchOutSetupRequestUrl): self
    {
        $this->punchOutSetupRequestUrl = $punchOutSetupRequestUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionDirectURL()
    {
        return $this->optionDirectURL;
    }

    /**
     * @param mixed $optionDirectURL
     *
     * @return Profile
     */
    public function setOptionDirectURL($optionDirectURL)
    {
        $this->optionDirectURL = $optionDirectURL;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionDirectAuthenticationMethodCredentialMac()
    {
        return $this->optionDirectAuthenticationMethodCredentialMac;
    }

    /**
     * @param mixed $optionDirectAuthenticationMethodCredentialMac
     *
     * @return Profile
     */
    public function setOptionDirectAuthenticationMethodCredentialMac(
        $optionDirectAuthenticationMethodCredentialMac
    ) {
        $this->optionDirectAuthenticationMethodCredentialMac = $optionDirectAuthenticationMethodCredentialMac;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionDirectAuthenticationMethodCertificate()
    {
        return $this->optionDirectAuthenticationMethodCertificate;
    }

    /**
     * @param mixed $optionDirectAuthenticationMethodCertificate
     *
     * @return Profile
     */
    public function setOptionDirectAuthenticationMethodCertificate(
        $optionDirectAuthenticationMethodCertificate
    ) {
        $this->optionDirectAuthenticationMethodCertificate = $optionDirectAuthenticationMethodCertificate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionCredentialMacType()
    {
        return $this->optionCredentialMacType;
    }

    /**
     * @param mixed $optionCredentialMacType
     *
     * @return Profile
     */
    public function setOptionCredentialMacType($optionCredentialMacType)
    {
        $this->optionCredentialMacType = $optionCredentialMacType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionCredentialMacAlgorithm()
    {
        return $this->optionCredentialMacAlgorithm;
    }

    /**
     * @param mixed $optionCredentialMacAlgorithm
     *
     * @return Profile
     */
    public function setOptionCredentialMacAlgorithm(
        $optionCredentialMacAlgorithm
    ) {
        $this->optionCredentialMacAlgorithm = $optionCredentialMacAlgorithm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionCredentialMacCreationDate()
    {
        return $this->optionCredentialMacCreationDate;
    }

    /**
     * @param mixed $optionCredentialMacCreationDate
     *
     * @return Profile
     */
    public function setOptionCredentialMacCreationDate(
        $optionCredentialMacCreationDate
    ) {
        $this->optionCredentialMacCreationDate = $optionCredentialMacCreationDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionCredentialMacExpirationDate()
    {
        return $this->optionCredentialMacExpirationDate;
    }

    /**
     * @param mixed $optionCredentialMacExpirationDate
     *
     * @return Profile
     */
    public function setOptionCredentialMacExpirationDate(
        $optionCredentialMacExpirationDate
    ) {
        $this->optionCredentialMacExpirationDate = $optionCredentialMacExpirationDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionCredentialMacValue()
    {
        return $this->optionCredentialMacValue;
    }

    /**
     * @param mixed $optionCredentialMacValue
     *
     * @return Profile
     */
    public function setOptionCredentialMacValue($optionCredentialMacValue)
    {
        $this->optionCredentialMacValue = $optionCredentialMacValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderRequestUrl(): string
    {
        return $this->orderRequestUrl;
    }

    /**
     * @param string $orderRequestUrl
     *
     * @return Profile
     */
    public function setOrderRequestUrl(string $orderRequestUrl): Profile
    {
        $this->orderRequestUrl = $orderRequestUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOptionOrderRequestAttachments(): bool
    {
        return $this->optionOrderRequestAttachments;
    }

    /**
     * @param bool $optionOrderRequestAttachments
     *
     * @return Profile
     */
    public function setOptionOrderRequestAttachments(
        bool $optionOrderRequestAttachments
    ): self {
        $this->optionOrderRequestAttachments = $optionOrderRequestAttachments;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOptionOrderRequestChanges(): bool
    {
        return $this->optionOrderRequestChanges;
    }

    /**
     * @param bool $optionOrderRequestChanges
     *
     * @return Profile
     */
    public function setOptionOrderRequestChanges(bool $optionOrderRequestChanges
    ): self {
        $this->optionOrderRequestChanges = $optionOrderRequestChanges;
        return $this;
    }

    public function render(\SimpleXMLElement $parentNode): void
    {
        $node = $parentNode->addChild('ProfileResponse');
        $node->addAttribute('effectiveDate', date(DATE_ISO8601, $this->effectiveDate));
        $node->addAttribute('lastRefresh', date(DATE_ISO8601, $this->lastRefresh));

        /**
         * Punchout Setup
         */
        if ($this->punchOutSetupRequestUrl) {
            $punchoutSetupTrans = $node->addChild('Transaction');
            $punchoutSetupTrans->addAttribute('requestName', 'PunchOutSetupRequest');
            $punchoutSetupTrans
                ->addChild('URL', $this->punchOutSetupRequestUrl);

            /**
             * Direct Punchout Options
             */
            if (!is_null($this->optionDirectURL)) {
                $punchoutSetupTrans
                    ->addChild('Option', $this->optionDirectURL)
                    ->addAttribute('name', 'Direct.URL');
            }
            if (!is_null($this->optionDirectAuthenticationMethodCredentialMac)) {
                $punchoutSetupTrans
                    ->addChild('Option', $this->optionDirectAuthenticationMethodCredentialMac)
                    ->addAttribute('name', 'Direct.AuthenticationMethod.CredentialMac');
            }
            if (!is_null($this->optionDirectAuthenticationMethodCertificate)) {
                $punchoutSetupTrans
                    ->addChild('Option', $this->optionDirectAuthenticationMethodCertificate)
                    ->addAttribute('name', 'Direct.AuthenticationMethod.Certificate');
            }

        }

        /**
         *  Order Request.
         */
        if ($this->orderRequestUrl) {
            $orderRequestTrans = $node->addChild('Transaction');
            $orderRequestTrans->addAttribute('requestName', 'OrderRequest');
            $orderRequestTrans
                ->addChild('URL', $this->orderRequestUrl);

            $orderRequestTrans->addChild('Option', (empty($this->optionOrderRequestAttachments)) ? 'No' : 'Yes')
                ->addAttribute('name', 'attachments');
            $orderRequestTrans->addChild('Option', (empty($this->optionOrderRequestChanges)) ? 'No' : 'Yes')
                ->addAttribute('name', 'changes');
        }

        /**
         * MAC options
         */
        if (!is_null($this->optionCredentialMacType)) {
            $node
                ->addChild('Option', $this->optionCredentialMacType)
                ->addAttribute('name', 'CredentialMac.type');
        }
        if (!is_null($this->optionCredentialMacAlgorithm)) {
            $node
                ->addChild('Option', $this->optionCredentialMacAlgorithm)
                ->addAttribute('name', 'CredentialMac.algorithm');
        }
        if (!is_null($this->optionCredentialMacCreationDate)) {
            $node
                ->addChild('Option', $this->optionCredentialMacCreationDate)
                ->addAttribute('name', 'CredentialMac.creationDate');
        }
        if (!is_null($this->optionCredentialMacExpirationDate)) {
            $node
                ->addChild('Option', $this->optionCredentialMacExpirationDate)
                ->addAttribute('name', 'CredentialMac.expirationDate');
        }
        if (!is_null($this->optionCredentialMacValue)) {
            $node
                ->addChild('Option', $this->optionCredentialMacValue)
                ->addAttribute('name', 'CredentialMac.value');
        }
    }
}
