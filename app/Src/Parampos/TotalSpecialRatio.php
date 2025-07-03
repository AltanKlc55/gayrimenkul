<?php
namespace App\Src\Parampos;
class TotalSpecialRatio
{

    function __construct($globallyUniqueIdentifier,$parampos)
    {
        $this->GUID = $globallyUniqueIdentifier;
        $this->G = new GeneralClass($parampos['CLIENT_CODE'], $parampos['CLIENT_USERNAME'], $parampos['CLIENT_PASSWORD']);

    }
}