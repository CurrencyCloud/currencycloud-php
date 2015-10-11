<?php

use VCR\Request;

\VCR\VCR::configure()
    ->setCassettePath('tests/fixtures/')
    ->addRequestMatcher(
        'headers',
        function (Request $first, Request $second) {
            $secondHeaders = $second->getHeaders();
            //Remove headers
            unset($secondHeaders['User-Agent']);
            unset($secondHeaders['Content-Type']);
            return array_filter($first->getHeaders()) == array_filter($secondHeaders);
        }
    );
