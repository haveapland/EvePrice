<?php

namespace haveapland\EvePrice\Libs;

class Fetch
{

 private $itemlist;
 private $apiurl_json = 'http://api.eve-central.com/api/marketstat/json';
 private $postfield;
 private $json_data;

    public function __construct($itemlist, $systemid=30000142, $hours=24)
    {
        $this->itemlist = $itemlist;
        $this->generatePostFields($this->itemlist);
    }

    public function setItemlist($itemlist)
    {
        $this->itemlist = $itemlist;
    }

    public function getItemlist()
    {
        return $this->itemlist;
    }

    public function getPostfield()
    {
        return $this->postfield;
    }

    private function generatePostFields($typeid = [], $systemid=30000142, $hours=24)
    {
        $this->postfield = 'hours='.$hours.'&usesystem='.$systemid;
    
        foreach ($typeid as $id)
        {
            $this->postfield .= '&typeid='.$id;
        }

        if(!$this->postfield){
            throw new \Exception('Empty POST request');
        }

        return true;
    }

    public function getData()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiurl_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                            $this->postfield);

        $this->json_data = json_decode(curl_exec ($ch));

        curl_close ($ch); 

        if(!$this->json_data){
            throw new \Exception('Empty data from eveCentral');
        }

        return $this->json_data;
    }

}

