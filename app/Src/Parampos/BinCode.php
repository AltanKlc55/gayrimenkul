<?php
namespace App\Src\Parampos;
class BinCode
{
    function __construct($cardno = "",$parampos)
    {
        $this->BIN = $cardno;
        $this->G = new GeneralClass($parampos['CLIENT_CODE'], $parampos['CLIENT_USERNAME'], $parampos['CLIENT_PASSWORD']);
    }
    public function getCode($response)
    {
        $dtInfo = $response->{'DT_Bilgi'};
        $any  =$dtInfo->{'any'};

        $xmlString = <<<XML
<?xml version='1.0' standalone='yes'?>
<root>
{$any}
</root>
XML;


        $xmlString = str_replace(array("diffgr:", "msdata:"), '', $xmlString);


        $data = simplexml_load_string($xmlString);
        $jsonString = json_encode($data);
        $result = json_decode($jsonString,true);
        if($result){
            return $result['diffgram']['NewDataSet']['Temp'];
        } else {
            return  false;
        }
    }
    public function getRatio($response)
    {
        $dtInfo = $response->{'DT_Bilgi'};
        $any  =$dtInfo->{'any'};

        $xmlString = <<<XML
<?xml version='1.0' standalone='yes'?>
<root>
{$any}
</root>
XML;


        $xmlString = str_replace(array("diffgr:", "msdata:"), '', $xmlString);


        $data = simplexml_load_string($xmlString);
        $jsonString = json_encode($data);
        $result = json_decode($jsonString,true);
        if($result){
            return $result['diffgram']['NewDataSet']['DT_Ozel_Oranlar_SK'];
        } else {
            return  false;
        }
    }
}