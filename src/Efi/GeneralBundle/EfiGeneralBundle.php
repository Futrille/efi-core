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
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->serialize($object, 'json');
    }
}
