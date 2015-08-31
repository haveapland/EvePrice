<?php

use EvePrice\Lib\Fetch;

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
        echo $this->fetch->getPostfield();
    }

}
