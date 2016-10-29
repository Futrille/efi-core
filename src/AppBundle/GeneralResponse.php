<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

define('GENERAL_RESPONSE_SUCCESS', 0);
define('GENERAL_RESPONSE_ERROR', 1);

class GeneralResponse
{
    private $data;
    private $code;
    private $status;
    private $message;
    private $type;
    private $metadata;

    public function GeneralResponse(){
        $this->data     = array();
        $this->code     = '';
        $this->status   = 0;
        $this->message  = '';
        $this->type     = 'array';
        $this->metadata = NULL;
    }
    
    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        $this->setType(gettype($data));
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
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param mixed $metadata
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     *
     * @param $key
     * @param $value
     */
    public function addToMetaData($key, $value){
        if ($this->metadata == NULL){
            $this->metadata = array();
        }
        $this->metadata[$key] = $value;
    }

    /**
     * Convierte el valor de $object en objeto JSON
     * @param $object
     * @return JsonResponse
     */
    public function toJSON(){
        $this->status = $this->status == null ? 0 : null;
        $this->message = $this->status == null ? 'Success' : null;

        $array = array(
            'data' => $this->data,
            'type' => $this->type,
            'code' => $this->code,
            'status' => $this->status,
            'message' => $this->message,
            'metadata' => $this->metadata
        );
        
        return $this->getJSON($array);
    }

    /**
     * @param $object
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    private function getJSON($object){
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $response = new JsonResponse();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $serializer = new Serializer(array($normalizer), array($encoder));

        $response->setContent($serializer->serialize($object, 'json'));

        return $response;
    }
}
