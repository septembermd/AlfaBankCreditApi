<?php
/**
 * Created by PhpStorm.
 * User: <Victor Davydov> septembermd@gmail.com
 * Date: 4/1/15
 * Time: 11:47 AM
 */

namespace AlfaCreditApi;


class Specification {
    /**
     * Maximum amount of goods
     */
    const MAX_AMOUNT = 10;

    const MIN_AMOUNT = 0;

    const MAX_PRICE_LENGTH = 15;

    const MAX_DESCRIPTION_LENGTH = 50;

    const MAX_CODE_LENGTH = 20;

    const MAX_CATEGORY_LENGTH = 40;

    /**
     * @var string
     */
    public $category;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $price;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return $this
     */
    public function setCategory($category)
    {
        if (mb_strlen($category) > self::MAX_CATEGORY_LENGTH) {
            throw new \RuntimeException('Category length should be lower than ' . self::MAX_CATEGORY_LENGTH . ' symbols.');
        }
        $this->category = $category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return $this
     */
    public function setCode($code)
    {
        if (mb_strlen($code) > self::MAX_CODE_LENGTH) {
            throw new \RuntimeException('Code length should be lower than ' . self::MAX_CODE_LENGTH . ' symbols.');
        }
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        if (mb_strlen($description) > self::MAX_DESCRIPTION_LENGTH) {
            throw new \RuntimeException('Description length should be lower than ' . self::MAX_DESCRIPTION_LENGTH . ' symbols.');
        }
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return $this
     */
    public function setAmount($amount = 1)
    {
        if ($amount > self::MIN_AMOUNT && $amount <= self::MAX_AMOUNT)  {
            $this->amount = $amount;
        } else {
            $this->amount = 1;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return $this
     */
    public function setPrice($price)
    {
        if (mb_strlen($price) > self::MAX_PRICE_LENGTH) {
            throw new \RuntimeException('Price should be lower than ' . self::MAX_PRICE_LENGTH . ' symbols.');
        }
        $this->price = $price;

        return $this;
    }

}