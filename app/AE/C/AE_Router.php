<?php

namespace App\AE\C;

use App\AE\M\Route;
use App\AE\M\SEO;

class AE_Router 
{
    
	public function index($subfolder, $request,  $name='')
	{
			$method=$request->method(); 
			$route=self::findRoute($name, $method);
			
			if ($route==null) {
				return view($subfolder.'._l.404');
			} else {
				if ($route->type==0){ //static
					$template=$subfolder.'._s.'.$route->p1;
					$p=(object)['lng'=>request()->get('lang','ua'), 'subpage'=>$template, 'seo'=>$route->seo, 'route'=>$route, 'changeHeader'=>'changeBg', 'change_footer'=>($route->p1=='index.index')?'footerHome':'changeFooterColor'];

					if ($name=='') $p->changeHeader='';

					return view($subfolder.'._l.main')->with('p',$p);
				} else { 
					$pc=config('_._t');
					$template=$pc[$route->p1]['tmpl'];
					$pageModel=AE_D::getDataById($route->p1, $route->p2);
                    $p=(object)['lng'=>request()->get('lang','ua'), 'subpage'=>$template, 'object'=>$pageModel, 'route'=>$route, 'changeHeader'=>'changeBg', 'change_footer'=>'changeFooterSize changeFooterColor'];

					return view($subfolder.'._l.main')->with('p',$p);
				}
		}  
	}
	
	###
	
	static function getRoute($model, $model_id)
	{
	    $route = Route::whereType(1)->where('p1', $model)->where('p2', $model_id)->first();
	
	    if ($route != null){
	        $seo = SEO::where("page_id", $route->id)->first();
	    } else {
	
	        $route = new Route();
	        $seo = new SEO();
    	        $seo->title = '';
    	        $seo->keywords = '';
    	        $seo->description = '';
    	        $seo->og_title = '';
    	        $seo->og_description = '';
    	        $seo->og_img = '';
	    }
	
	    $route->seo = $seo;
	
	    return $route;
	}
	
	public function findRoute($name, $method){
		$route=(object)[];
		$route = Route::where('url', $name)->orWhere('url_en', $name)->first();
		if ($route<>null) {
		    $seo = SEO::where('page_id', $route->id)->first();
		    if ($seo==null) {
				$seo=(object)[];
			}
		    $route->seo=$seo;
		}
		return $route;
	}
	
	
	static function updateRoute($p)
	{
	    $r=(object)[];
	    $r->state=1;
	    
	    $modelClass=AE_D::getModelClass($p->model);
	    
	    $entity = $modelClass::find($p->id);
	    
	    $route = Route::where('type', 1)->where('p1', $p->model)->where('p2', $entity->id)->first();
	
	    if ($route == null) {
	        $route = new Route();
	        $route->p1 = $p->model;
	        $route->p2 = $entity->id;
	        $route->type = 1;
	    }
	
	       $route->url=$p->post->url;
	    $route->save();
	
	    self::updateSEO($route->id, $p->post);
	    
	    return $r;
	}
	
	static function updateSEO($route_id, $post)
	{
	    $seo = SEO::where('page_id', $route_id)->first();
	
	    if ($seo == null) { $seo = new SEO(); }
    	    $seo->page_id = $route_id;
    	    $seo->title = $post->title;
			$seo->title_en = $post->title_en;
    	    $seo->keywords = $post->keywords;
			$seo->keywords_en = $post->keywords_en;
    	    $seo->description = $post->description;
			$seo->description_en = $post->description_en;
	    $seo->save();
	    
	    return 1;
	}
	
	
	
	
	static public function link($model, $id, $appendLang = false){
	    $u=self::getRoute($model, $id);
	    $url = url('/'.$u['url']);
	    if ($appendLang) {
	        $url .= '?lang=en';
	    }
	    return $url;
	}
	
	
	static public function h_prepareFields($route){
	    $routeObject=self::getRoute($route->model, $route->id);
	    
	    foreach ($route->fields as $fieldName=> &$field){
	        $field->n=$fieldName;
	    }

	    if (!isset($routeObject->seo)){
            $routeObject->seo=(object)['title'=>'','keywords'=>'','description'=>'',
		'title_en'=>'','keywords_en'=>'','description_en'=>'',];
        }


	    $route->fields->url->v=$routeObject->url;
	    $route->fields->title->v=$routeObject->seo->title;
		$route->fields->title_en->v=$routeObject->seo->title_en || '';
	    $route->fields->keywords->v=$routeObject->seo->keywords;
		$route->fields->keywords_en->v=$routeObject->seo->keywords_en;
	    $route->fields->description->v=$routeObject->seo->description;
		$route->fields->description_en->v=$routeObject->seo->description_en;
	    
	    return $route;
	}
	
}
    
