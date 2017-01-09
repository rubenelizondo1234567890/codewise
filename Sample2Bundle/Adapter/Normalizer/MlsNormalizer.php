<?php

namespace RetsBundle\Adapter\Normalizer;


/**
 * MlsNormalizer
 * Normalizes raw data coming from Rets Servers
 */
class MlsNormalizer
{

    /**
     * normalizeType
     * Normalizes raw values to ensure data integrity in Mls Properties
     * @param $value raw value
     * @param $type type defined in Mls Properties Entity
     * @param $length length defined in Mls Properties Entity
     * @param $nullable defined in Mls Properties Entity
     */
    public static function normalizeType($value, $type, $length = 0, $nullable = true)
    {
    	switch ($type) {
            case 'Integer':
                $value = (int) $value;
                if(!$nullable && empty($value)) { $value = 0;}
               	break;
            case 'String':
                if (strlen((string) $value)>$length && $length != 0) {$value = substr($value, 0, $length);}
                if(!$nullable && empty($value)) { $value = 'none';}
               	break;
            case 'Text':
                if (strlen((string) $value)>$length && $length != 0) {$value = substr($value, 0, $length);}
                if(!$nullable && empty($value)) { $value = 'none';}
               	break;
            case 'Decimal':
                $value = round((float) $value, $length);
               	break;
            case 'Boolean':
            	$value = (boolean) $value;
               	break;
            case 'DateTime':
            	// need to remove T from datetime string before creating datetime object
            	($value != 'now') ? $value = new \dateTime(str_replace('T', ' ', $value)) : $value = new \dateTime;
               	break; 	
            default:
                # code...
                break;
        }

        return $value;
    }

}