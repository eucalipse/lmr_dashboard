<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\VH;

class Script extends Controller
{
	public function index(Request $request, $url='')
	{

		if ($url=='translate'){
			
			$caterories=\App\Model\Category::all();
			foreach($caterories as $c){
					$c->title_en=VH::translit($c->title);
					$c->save();
			}

			$stats=\App\Model\Stat::all();
			foreach($stats as $s){
					$s->title_en=VH::translit($c->title);
					$s->vendor_name_en=VH::translit($c->vendor_name);
					$s->measurement_en=VH::translit($c->measurement);
					$s->save();
			}
		}

		if ($url=='check_urls'){
		
		}

		if ($url=='urls_stats'){
			$stats=\App\Model\Stat::where('id','>=',816)->get();
			foreach($stats as $s){
				$existing=\App\Model\Route::where('p1','stat')->where('p2',$s->id)->first();
				if (!isset($existing)){
					$new=new \App\Model\Route();
						$new->type=1;
						$new->url='concepcia/'.VH::translit($s->title);
						$new->url_en='en/concepcia/'.VH::translit($s->title);
						$new->p1='stat';
						$new->p2=$s->id;
					$new->save();
				}	
			}
		}

		if ($url=='urls_categories'){
			$categories=\App\Model\Category::where('id','>=',422)->get();
			foreach($categories as $s){
				$existing=\App\Model\Route::where('p1','category')->where('p2',$s->id)->first();
				if (!isset($existing)){
					$new=new \App\Model\Route();
						$new->type=1;
						$new->url='concepcia/'.VH::translit($s->title);
						$new->url_en='en/concepcia/'.VH::translit($s->title);
						$new->p1='category';
						$new->p2=$s->id;
					$new->save();
				}	
			}
		}



		
	}
}
    
