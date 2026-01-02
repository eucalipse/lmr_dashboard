<?php

namespace App\AE\C;

class AE_H{

	static function title2url($url){
		
		    $url = strtolower($url);
		    $url = strip_tags($url);
		    $url = stripslashes($url);
		    $url = html_entity_decode($url);
		
		    # Remove quotes (can't, etc.)
		    $url = str_replace('\'', '', $url);
		
		    # Replace non-alpha numeric with hyphens
		    $match = '/[^a-z0-9]+/';
		    $replace = '-';
		    $url = preg_replace($match, $replace, $url);
		
		    $url = trim($url, '-');
		
		    return $url;
	}
	
    static function toObject($array) {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)){
                $value = self::toObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }

}

?>