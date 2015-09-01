<?php

namespace haveapland\EvePrice\Libs;

class Fetch
{
    private $itemlist;
    private $api_url = [
                'xml' => 'http://api.eve-central.com/api/marketstat/',
                'json' => 'http://api.eve-central.com/api/marketstat/json'
            ];
    private $post_field;
    private $data;

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
        return $this->post_field;
    }

    public function getData()
    {
        return $this->data;
    }

    private function generatePostFields($typeid = [], $systemid=30000142, $hours=24)
    {
        $this->post_field = 'hours='.$hours.'&usesystem='.$systemid;
    
        foreach ($typeid as $id)
        {
            $this->post_field .= '&typeid='.$id;
        }

        if(!$this->post_field){
            throw new \Exception('Empty POST request');
        }

        return true;
    }

    public function pullPrices()
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->api_url['json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                            $this->post_field);

        $this->data = json_decode(curl_exec ($ch));
        
        curl_close ($ch); 

        if(!$this->data){
            throw new \Exception('Empty data from eveCentral');
        }

        return true;
    }

}

