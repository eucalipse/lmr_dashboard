<?php

namespace App\AE\C;

class AE_C
{

    static function addEditController($p)
    {
        $r=(object)[];
        $r->state=1;
        
        #
        if (isset($p->form->url)){
            $r->url=$p->form->url;
        } else {
            $r->url=$p->formName;
        }
        
        if (!empty($p->form->function)){

            $r->type=$p->form->function;
            
            if ($p->form->function->type=='single'){
                $r->fx=self::callFX($p);
            } 
            
            if ($p->form->function->type=='after'){
                $p=self::h_saveModel($p);
                
                $r->create_type=$p->type;
                $r->fx=self::callFX($p);
                $r->model_id=$p->entity->id;
            }

            
        } else {
            $p=self::h_saveModel($p);
            
            $r->type='form';
            $r->model_id=$p->entity->id;
            $r->create_type=$p->type;
        }
        
        
        return $r;
    }

    private static  function h_saveModel($p){
        $modelClass=AE_D::getModelClass($p->form->model);
    
        if ($p->type=="NEW") {
            $p->entity = new $modelClass();
        } else {
            $p->entity = $modelClass::find($p->id);
        }
    
        $p->entity = self::updateFieldsfromPost($p);
        $p->entity->save();
    
        return $p;
    }
    
    static function updateFieldsfromPost($p)
    {
        $fields = $p->form->f;
        $post=$p->post;
        $entity=$p->entity;
        
        foreach ($fields as $fieldName => $field){
            if ($field->t<>'value_relation'){
                $entity->$fieldName = $post->$fieldName;
            }
        }
        
        return $entity;
    }
  
    static function delete($p)
    { 
        $entity=AE_D::getDataById($p->model, $p->id);
        $_r=(array)config('_.admin._r');


        if (isset($_r->{$p->model}->hasSEO) && $_r->{$p->model}->hasSEO == true){
            
            $route = Route::where('type', 1)->where('p1', $p->model)->where('p2', $p->id)->first();
            
            if ($route<>null){
                $seo = SEO::where('page_id', $route->id)->first();
                
                $seo->delete();
                $route->delete();
            }
            
        }
        
        $entity->delete();
    }

    
   
    
    public static function callFX($p){
        $fxs=$p->_fx;
        $functionName=$p->form->function->name;
        $value=-1;
        
        if (property_exists($fxs, $functionName)){
            $fx=$fxs->$functionName;
            $value=$fx($p);
        }
        
        return $value;
    }
    
    
}


?>

