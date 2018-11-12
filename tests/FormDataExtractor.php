<?php

namespace CurrencyCloud\Tests;

class FormDataExtractor {

    public static function extract($data){
        $delimiter = "";
        // find delimiter for form-data
        preg_match("/--[[:alnum:]]*/s", $data, $delimiter);
        $tempBody = explode($delimiter[0], $data);
        $dataArray = [];
        $dataArrayKey = "";
        if(!empty($tempBody)){
            unset($tempBody[count($tempBody) - 1]);
            foreach ($tempBody as $key => $value){
                $dataArrayKey = self::extractArrayKey($value);
                unset($keys);
                if(empty($dataArrayKey)){
                    continue;
                }

                $dataArrayValue = self::extractArrayValue($value);
                unset($values);
                $dataArray[] = ['name' => $dataArrayKey, 'value' => $dataArrayValue];
            }
        }

        return $dataArray;
    }

    protected static function extractArrayKey($value){
        $dataArrayKey = "";
        // find name=""
        preg_match('/(name=\\"([A-z0-9_-])*\")/is', $value, $keys);
        // get the key name

        if(!empty($keys)) {
            preg_match('/\\"([A-z0-9-_]*)\\"/is', $keys[0], $keys);
            //clear the key name
            $keys = str_replace('\"', '', $keys[0]);
            $dataArrayKey = str_replace('"', '', $keys);
        }

        return $dataArrayKey;
    }

    protected static function extractArrayValue($value){
        $dataArrayValue = "";
        // find Content-Length: xx \r\n/r\nDATA\r\n
        preg_match('/(Content-Length: (\d*)\\\r\\\n\\\r\\\n([[:alnum:]]|[[:ascii:]]|[[:blank:]]|[[:punct:]]|[[:space:]])*\\\r\\\n)/isU', $value, $values);
        // find DATA \r\n\r\nDATA\r\n
        if(!empty($values)) {
            preg_match('/\\\r\\\n\\\r\\\n(([[:alnum:]]|[[:ascii:]]|[[:blank:]]|[[:punct:]]|[[:space:]])*){1}\\\r\\\n/isU', $values[0], $values);
            $dataArrayValue = substr($values[0], 8, strlen($values[0]));
            $dataArrayValue = substr($dataArrayValue, 0, strlen($dataArrayValue) - 4);
        }

        return $dataArrayValue;
    }

}