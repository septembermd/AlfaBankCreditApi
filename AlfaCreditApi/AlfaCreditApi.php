<?php
/**
 * Created by PhpStorm.
 * User: <Victor Davydov> septembermd@gmail.com
 * Date: 4/1/15
 * Time: 11:39 AM
 */
namespace AlfaCreditApi;

use AlfaCreditApi\CreditRequest;


class AlfaCreditApi {
    const ENDPOINT = "https://anketa.alfabank.ru/alfaform-pos/endpoint";

    /**
     * @var CreditRequest
     */
    public $creditRequest;

    /**
     * @param CreditRequest $creditRequest
     */
    public function __construct(CreditRequest $creditRequest)
    {
        $this->creditRequest = $creditRequest;
    }


    public function getCreditRequestAsXML()
    {
        $creditRequest = $this->creditRequest;

        $xml = '<inParams>';

        foreach($creditRequest as $param => $value) {
            if ($value) {
                $xml .= "<$param>";
                if ('specificationList' === $param && is_array($value)) {
                    foreach($value as $key => $val) {

                        if ($val instanceof Specification) {
                            $xml .= "<specificationListRow>";
                            foreach ($val as $k => $spec) {
                                if ($spec) {
                                    $xml .= "<$k>$spec</$k>";
                                }
                            }
                            $xml .= "</specificationListRow>";
                        }
                    }
                } else {
                    $xml .= $value;
                }
                $xml .= "</$param>";
            }
        }

        $xml .= "</inParams>";

        return $xml;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        $xml = array('InXML' => $this->getCreditRequestAsXML());

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, self::ENDPOINT );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=UTF-8'));
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        if(curl_errno($ch)) {
            throw new \RuntimeException("Error Processing Request: " . curl_error($ch));
        }
        curl_close($ch);
        
        return $result;
    }
}