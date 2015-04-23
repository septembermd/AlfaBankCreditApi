<?php
/**
 * Created by PhpStorm.
 * User: <Victor Davydov> septembermd@gmail.com
 * Date: 4/1/15
 * Time: 11:47 AM
 */

namespace AlfaCreditApi;

use AlfaCreditApi\Specification;


class CreditRequest {

    const MIN_SPECIFICATION_AMOUNT = 1;

    const MAX_SPECIFICATION_AMOUNT = 10;

    const MAX_REFERENCE_LENGTH = 20;

    const MAX_USERID_LENGTH = 10;

    const MAX_TRADESITE_LENGTH = 10;

    const MAX_EMAIL_LENGTH = 70;

    const MAX_TRADEPOINTPHONE_LENGTH = 12;

    const MAX_INN_LENGTH = 12;

    const MAX_FIRSTPAYMENT_LENGTH = 15;

    /**
     * @var int
     */
    public $firstPayment;

    /**
     * @var string
     */
    public $INN;

    /**
     * @var string
     */
    public $tradePointPhone;

    /**
     * @var string
     */
    public $email;

    /**
     * Partner unique number
     *
     * @var string
     */
    public $tradeSite;

    /**
     * Shop unique number
     *
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var int
     */
    public $creditPeriod;

    /**
     * @var array
     */
    public $specificationList = array();

    /**
     * @return int
     */
    public function getFirstPayment()
    {
        return $this->firstPayment;
    }

    /**
     * @param int $firstPayment
     * @return $this
     */
    public function setFirstPayment($firstPayment)
    {
        if (mb_strlen($firstPayment) > self::MAX_FIRSTPAYMENT_LENGTH) {
            throw new \RuntimeException('firstPayment maximum length is ' . self::MAX_FIRSTPAYMENT_LENGTH . ' symbols.');
        }
        $this->firstPayment = $firstPayment;

        return $this;
    }

    /**
     * @return int
     */
    public function getINN()
    {
        return $this->INN;
    }

    /**
     * @param int $INN
     * @return $this
     */
    public function setINN($INN)
    {
        if (mb_strlen($INN) > self::MAX_INN_LENGTH) {
            throw new \RuntimeException('INN maximum length is ' . self::MAX_INN_LENGTH . ' symbols.');
        }
        $this->INN = $INN;

        return $this;
    }

    /**
     * @return string
     */
    public function getTradePointPhone()
    {
        return $this->tradePointPhone;
    }

    /**
     * @param string $tradePointPhone
     * @return $this
     */
    public function setTradePointPhone($tradePointPhone)
    {
        if (mb_strlen($tradePointPhone) > self::MAX_TRADEPOINTPHONE_LENGTH) {
            throw new \RuntimeException('tradePointPhone maximum length is ' . self::MAX_TRADEPOINTPHONE_LENGTH . ' symbols.');
        }
        $this->tradePointPhone = $tradePointPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getTradeSite()
    {
        return $this->tradeSite;
    }

    /**
     * @param string $tradeSite
     * @return $this
     */
    public function setTradeSite($tradeSite)
    {
        if (mb_strlen($tradeSite) > self::MAX_TRADESITE_LENGTH) {
            throw new \RuntimeException('TradeSite maximum length should be ' . self::MAX_TRADESITE_LENGTH . ' symbols.');
        }
        $this->tradeSite = $tradeSite;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        if (mb_strlen($userId) > self::MAX_USERID_LENGTH) {
            throw new \RuntimeException('UserId maximum length should be ' . self::MAX_USERID_LENGTH . ' symbols.');
        }
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     * @return $this
     */
    public function setReference($reference)
    {
        if (mb_strlen($reference) > self::MAX_REFERENCE_LENGTH) {
            throw new \RuntimeException('Reference maximum length should be ' . self::MAX_REFERENCE_LENGTH . ' symbols.');
        }
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditPeriod()
    {
        return $this->creditPeriod;
    }

    /**
     * @param mixed $creditPeriod
     * @return $this
     */
    public function setCreditPeriod($creditPeriod)
    {
        $this->creditPeriod = $creditPeriod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecificationList()
    {
        return $this->specificationList;
    }

    /**
     * @param mixed $specificationList
     * @return $this
     */
    public function setSpecificationList(array $specificationList)
    {
        if(count($specificationList) < self::MIN_SPECIFICATION_AMOUNT || count($specificationList) > self::MAX_SPECIFICATION_AMOUNT) {
            throw new \RuntimeException('Specification amount should be more than ' . self::MIN_SPECIFICATION_AMOUNT . ' and less than ' . self::MAX_SPECIFICATION_AMOUNT);
        }
        $this->specificationList = $specificationList;

        return $this;
    }

    public function addSpecification(Specification $specification) {
        if(count($this->specificationList) >= self::MAX_SPECIFICATION_AMOUNT) {
            throw new \RuntimeException('Specification maximum amount is ' . self::MAX_SPECIFICATION_AMOUNT . ', currently has ' . count($this->specificationList) . ' specifications.');
        }
        $this->specificationList[] = $specification;

        return $this;
    }

}