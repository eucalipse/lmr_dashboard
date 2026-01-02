<?php

namespace App\AE\C;

class AE_D
{
	
	static function getModelClass($model){
	   if (in_array($model, ['img','mail', 'route', 'seo','tax'])){
	        $className = 'App\AE\\M\\'.$model;
	   } else {
	       $className = 'App\\Model\\'.ucfirst($model);
	   }
	        
	   $modelClass=new $className;
	   return  $modelClass;
	}
	
	
	static function getDataL($model){
	    $modelClass=self::getModelClass($model);
	    $list=$modelClass::orderBy('id')->get();
	    return $list;
	}
	
	static function getDataList($v){
		$modelClass=self::getModelClass($v->model);
		
		
		if (isset($v->rawSql) && $v->rawSql==true){
		       return \DB::select($v->sql);
		}
		
		if (!isset($v->q)){
		    $list=$modelClass::orderBy('id')->get();
		    
		} else {
		   
			$list=$modelClass;
			
		    foreach ($v->q as $q){
		        
		        if (isset($q->t) && $q->t=='or') {
		            $list=$list->orwhere($q->p1, $q->p2, $q->p3);
		        } else{
		            $list=$list->where($q->p1, $q->p2, $q->p3);
		        }
		        
		    }
		    
			if (isset($v->sort)){
			    
			    foreach ($v->sort as $q){
			        $list=$list->orderBy($q->e, $q->d);
			    }
			    
			    $list=$list->get();
			    
			} else {
			    
    			$list=$list->orderBy('id','desc')->get();
    			
			}
		    
		} 		
		return $list;
		
	}
	
	
	static function getDataById($model, $id){
		$modelClass=self::getModelClass($model);
		$item=$modelClass::where('id', '=', $id)->first();
		
		return $item;
	}
	
	static function getDataByField($model, $fieldName, $value){
	    $modelClass=self::getModelClass($model);
	    $item=$modelClass::where($fieldName, '=', $value)->first();
	
	    return $item;
	}
	
}

