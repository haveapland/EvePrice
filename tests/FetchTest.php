<?php

use haveapland\EvePrice\Libs\Fetch;

class FetchTest extends \PHPUnit_Framework_TestCase
{
    private $fetch;

    public function setUp()
    {

        $itemlist = [178,179,180,181,182,183,184,185,186,187];
        $this->fetch = new Fetch($itemlist);
    }

    public function testGeneratePostFields()
    {
        $post_string = 'hours=24&usesystem=30000142&typeid=178&typeid=179&typeid=180&typeid=181&typeid=182&typeid=183&typeid=184&typeid=185&typeid=186&typeid=187';
        $this->assertEquals($post_string, $this->fetch->getPostfield());
    }

    public function testGetData()
    {
        $this->assertTrue($this->fetch->pullPrices());
    }

}
