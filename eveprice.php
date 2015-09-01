<?php

require (__DIR__.'/vendor/autoload.php');

use haveapland\EvePrice\Libs\Parser;
use haveapland\EvePrice\Libs\Fetch;

$fetcher = new Fetch(array(178,179,180));
$parser = new Parser();
$fetcher->pullPrices();
$parser->formatItem($fetcher->getData());

