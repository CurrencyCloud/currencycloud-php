<?php

use VCR\Request;

\VCR\VCR::configure()
    ->setCassettePath('tests/fixtures/')
    ->addRequestMatcher(
        'headers',
        function (Request $first, Request $second) {
            return array_filter($first->getHeaders()) == array_filter($second->getHeaders());
        }
    );
