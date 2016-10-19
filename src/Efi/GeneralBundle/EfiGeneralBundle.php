<?php

namespace Efi\GeneralBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

define("SUCCESS",   "success");
define("ERROR",     "error");

/**
 * Class EfiGeneralBundle
 * @package Efi\GeneralBundle
 */
class EfiGeneralBundle extends Bundle
{
    /**
     * @param $object
     * @return mixed
     */
    public function getSerialize($object){
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object;
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        return $serializer->serialize($object, 'json');
    }


    /**
     * Convierte el Objeto en una respuesta JSON
     * @param $object
     * @return JsonResponse
     */
    public function efiGetJsonResponse($object){
        $response = new JsonResponse();
        $response->setContent($this->getSerialize($object));
        return $response;
    }

    /**
     * @param $status
     * @return array
     */
    public function createResponseObject($status = SUCCESS, $message = '', $response = NULL){
        return array(
            'status' => $status,
            'message' => $message,
            'response' => $response,
        );
    }
}
