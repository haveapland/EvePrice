<?php

use haveapland\EvePrice\Libs\Fetch;
use haveapland\EvePrice\Libs\Parser;


class ParserTest extends \PHPUnit_Framework_TestCase
{
    private $fetch;
    private $parser;

    public function setUp()
    {
        $itemlist = [178,179,180,181,182,183,184,185,186,187];
        $this->fetch = new Fetch($itemlist);
        $this->fetch->pullPrices();
        $this->parser = new Parser();
    }

}
