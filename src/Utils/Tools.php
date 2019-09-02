<?php
namespace App\Utils;
// Includefor generate uuid
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
// src/Utils/Slugger.php


class Tools
{
    public function genereteUUID()
    {    
        $uuid1 = Uuid::uuid1();
        return $uuid1;  
    }

    public function getUUID($uuid1)
    {    
        //Readeable ID
        //returne decima value of uuid
        return hexdec($uuid1);  
    }

    public function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}



?>