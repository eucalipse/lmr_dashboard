<?php

namespace App\AE\C;

class AE_V{

    static function field($item,  $fieldName, $column, $p){
        $value="-";
    
        if ($column->type=='plain') $value=$item->$fieldName;
         

        if ($column->type=='state') {
            $states=$p->_s;
            $state=$p->_s->{$column->f};
            $value=$state->{$item->$fieldName};
        }
         
        if ($column->type=='function'){
            $fxs=$p->_fx;
            $func=$column->f;

            if (isset($fxs->$func)){
                $fx=$fxs->$func;
                $value=$fx($item, $p);
            } 

        }
        
        return $value;
    }
    
    
    static function state($value, $stateName){
        $_s=AE_H::toObject(config('_._s'));
         
        $states=$_s->{$stateName};
        return $states->{$value};
    }
    
}



?>
