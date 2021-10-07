<?php

namespace CXml\Models\Responses;

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

    public function render(\SimpleXMLElement $parentNode): void
    {
        $node = $parentNode->addChild('ProfileResponse');
        $node->addAttribute('effectiveDate', date(DATE_ISO8601, $this->effectiveDate));
        $node->addAttribute('lastRefresh', date(DATE_ISO8601, $this->lastRefresh));

        if ($this->punchOutSetupRequestUrl) {
            $transactionNode = $node->addChild('Transaction');
            $transactionNode->addAttribute('requestName', 'PunchOutSetupRequest');
            $transactionNode
                ->addChild('URL', $this->punchOutSetupRequestUrl);

            /**
             * Direct Puncout Options
             */
            if (!is_null($this->optionDirectURL)) {
                $transactionNode
                    ->addChild('Direct.URL', $this->optionDirectURL);
            }
            if (!is_null($this->optionDirectAuthenticationMethodCredentialMac)) {
                $transactionNode
                    ->addChild('Direct.AuthenticationMethod.CredentialMac', $this->optionDirectAuthenticationMethodCredentialMac);
            }
            if (!is_null($this->optionDirectAuthenticationMethodCertificate)) {
                $transactionNode
                    ->addChild('Direct.AuthenticationMethod.Certificate', $this->optionDirectAuthenticationMethodCertificate);
            }

        }

        /**
         * MAC options
         */
        if (!is_null($this->optionCredentialMacType)) {
            $node
                ->addChild('CredentialMac.type', $this->optionCredentialMacType);
        }
        if (!is_null($this->optionCredentialMacAlgorithm)) {
            $node
                ->addChild('CredentialMac.algorithm', $this->optionCredentialMacAlgorithm);
        }
        if (!is_null($this->optionCredentialMacCreationDate)) {
            $node
                ->addChild('CredentialMac.creationDate', $this->optionCredentialMacCreationDate);
        }
        if (!is_null($this->optionCredentialMacExpirationDate)) {
            $node
                ->addChild('CredentialMac.expirationDate', $this->optionCredentialMacExpirationDate);
        }
        if (!is_null($this->optionCredentialMacValue)) {
            $node
                ->addChild('CredentialMac.value', $this->optionCredentialMacValue);
        }
    }
}
