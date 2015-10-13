<?php

use VCR\Request;

$parametersMatcher = function ($first, $second) {
    if (!is_array($first)) {
        parse_str($first, $firstParams);
    } else {
        $firstParams = $first;
    }
    if (!is_array($second)) {
        parse_str($second, $secondParams);
    } else {
        $secondParams = $second;
    }

    $keys = array_unique(array_merge(array_keys($firstParams), array_keys($secondParams)));

    foreach ($keys as $key) {
        if (isset($firstParams[$key]) && isset($secondParams[$key])) {
            if ($firstParams[$key] !== $secondParams[$key]) {
                return false;
            }
            unset($firstParams[$key]);
            unset($secondParams[$key]);
        } else {
            return false;
        }
    }
    if (count($firstParams) > 0 || count($secondParams) > 0) {
        return false;
    }
    return true;
};

\VCR\VCR::configure()
    ->setCassettePath('tests/fixtures/')
    ->addRequestMatcher(
        'body',
        function (Request $first, Request $second) use ($parametersMatcher) {
            return $parametersMatcher($first->getBody(), $second->getBody());
        }
    )
    ->addRequestMatcher(
        'query_string',
        function (Request $first, Request $second) use ($parametersMatcher) {
            return $parametersMatcher($first->getQuery(), $second->getQuery());
        }
    )
    ->addRequestMatcher(
        'headers',
        function (Request $first, Request $second) {
            $secondHeaders = $second->getHeaders();
            $firstHeaders = $first->getHeaders();
            //Remove headers
            unset($firstHeaders['User-Agent']);
            unset($firstHeaders['Content-Type']);
            unset($secondHeaders['User-Agent']);
            unset($secondHeaders['Content-Type']);
            return array_filter($firstHeaders) == array_filter($secondHeaders);
        }
    );
