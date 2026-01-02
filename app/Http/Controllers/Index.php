<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AE\C\AE_Router;
use App\Model\Category;
use App\Model\Content;
use App\Model\Article;

class Index extends Controller
{
	public function index(Request $request, $url='')
	{
	    $router=new AE_Router;
		$route=$router->findRoute($url, $request->method());

		// Language from URL param only, default Ukrainian
		$lng = $request->get('lang', 'ua');
		$p=(object)['lng'=>$lng];

		if ($url=='lng') {
			$bodyContent = $request->getContent();
			$lng=json_decode($bodyContent)->lng;
			session(['lng' => $lng]);
			return $lng;
		}


        if ($url=='articles') {
			$p=(object) array_merge((array) $p, ['subpage'=>'front._s.about.articles','changeHeader'=>'changeBg','change_footer'=>'changeFooterColor']);
            return view('front._l.main')->with('p', $p);
        }

        if ($url=='about') {
			$p=(object) array_merge((array) $p, ['subpage'=>'front._s.about.about','changeHeader'=>'changeBg','change_footer'=>'changeFooterColor']);
            return view('front._l.main')->with('p', $p);
        }

		if (isset($route) && $route->p1=='article'){
            $id=$route->p2;
            $item=Article::where('id', $id)->first();
			$p=(object) array_merge((array) $p, ['subpage'=>'front._s.article.post', 'item'=>$item, 'footer'=>1, 'route'=>$route, 'changeHeader'=>'changeBg','change_footer'=>' changeFooterColor']);
            return view('front._l.main')->with('p', $p);
        }

		if (isset($route) && $route->p1=='category') {
            $id = $route->p2;
            return self::category($id, $route);
        }

        if (isset($route) && $route->p1=='stat') {
            return $router->index('front', $request, $url);
        }

		return $router->index('front', $request, $url);
	}

	// Helper to get language - only from URL param, default Ukrainian
	static public function getLng(){
		return request()->get('lang', 'ua');
	}

	public function mainCategory1(){
	    $category=Category::where('id', 238)->first();
	    $p=(object)['lng'=>self::getLng(), 'subpage'=>'front._s.category.category', 'mainCategory'=>1, 'category'=>$category, 'footer'=>1, 'changeHeader'=>'changeBg','change_footer'=>'changeFooterSize changeFooterColor footerCategory', 'route'=>(object)['url'=>'_']];
	    return view('front._l.main')->with('p', $p);
	}

	public function mainCategory2(){
	    $category=Category::where('id', 366)->first();
	    $p=(object)['lng'=>self::getLng(), 'subpage'=>'front._s.category.category', 'mainCategory'=>2, 'category'=>$category, 'footer'=>1, 'changeHeader'=>'changeBg','change_footer'=>'changeFooterSize changeFooterColor footerCategory','route'=>(object)['url'=>'_']];
	    return view('front._l.main')->with('p', $p);
	}

	public function mainCategory3(){
	    $category=Category::where('id',403)->first();
	    $p=(object)['lng'=>self::getLng(), 'subpage'=>'front._s.category.category', 'mainCategory'=>3, 'category'=>$category, 'footer'=>1, 'changeHeader'=>'changeBg', 'change_footer'=>'changeFooterSize changeFooterColor footerCategory', 'route'=>(object)['url'=>'_']];
	    return view('front._l.main')->with('p', $p);
	}

	public function mainCategory4(){
	    $category=Category::where('id',422)->first();
	    $p=(object)['lng'=>self::getLng(), 'subpage'=>'front._s.category.category', 'mainCategory'=>4, 'category'=>$category, 'footer'=>1, 'changeHeader'=>'changeBg', 'change_footer'=>'changeFooterSize changeFooterColor footerCategory', 'route'=>(object)['url'=>'_']];
	    return view('front._l.main')->with('p', $p);
	}

	public function category($id, $route){
	    $category=Category::where('id', $id)->first();
	    $mainCategory=self::getMainCategory($category);
	    $p=(object)['lng'=>self::getLng(), 'subpage'=>'front._s.category.category', 'mainCategory'=>$mainCategory, 'category'=>$category, 'changeHeader'=>'changeBg', 'change_footer'=>'changeFooterSize changeFooterColor footerCategory', 'footer'=>1, 'route'=>$route];
	    return view('front._l.main')->with('p', $p);
	}
	
	static public function getMainCategory2($category){
	    if (!in_array($category->parent, [1,2,3,4])){
	        $category_parent=Category::where('id', $category->parent)->first();
	        if ($category_parent==null) return;
	        if (!in_array($category_parent->parent, [1,2,3,4])){
	            $category_parent=Category::where('parent', $category_parent->parent)->first();
	        }
	        $mainCategory=$category_parent->parent;
	    } else {
	        $mainCategory=$category->parent;
	    }
	    return $mainCategory;
	}
	
	static public function getMainCategory($category){
	    if (in_array($category->parent, [1,2,3,4])){
	        return $category->parent;
	    } else{
	        $category_parent=Category::where('id', $category->parent)->first();
	        if ($category_parent==null) return '-'; else return self::getMainCategory2($category_parent);
	    }
	}
	
	static function getContent($slug){
	    $content=Content::where('slug' ,$slug)->first();

		if ($content){
			$lng=request()->get('lang','ua');
			return ($lng=='ua')?$content->content:$content->content_en;
		} else {
			return '';
		}

	}

	// Language-aware URL helper - preserves ?lang=en parameter
	static function lurl($path = '/'){
		$url = url($path);
		$lang = request()->get('lang');
		if ($lang == 'en') {
			$url .= (strpos($url, '?') !== false) ? '&lang=en' : '?lang=en';
		}
		return $url;
	}
}
    
