<?php

namespace Efi\GeneralBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
}
