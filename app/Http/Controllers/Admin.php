<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\AE\C\AE_C;
use App\AE\C\AE_H;
use App\AE\C\AE_Router;
use App\AE\C\AE_F;

use App\Model\StatDetails;

class Admin extends Controller
{
	
    public function index(Request $request, $name='')
    {
        
        $routeString = $request->path();
        $route=explode('/', $routeString);
        $method=$request->method();
        
        $post=(object)$request->all();
        
        #####
        
        $p=(object)[];
        $p->_s=AE_H::toObject(config('_._s'));
        $p->_fx=AE_H::toObject(config('_.admin._fx'));
        $p->panel_url='lmr_access';
        if (!isset($route[1])) return;
        $p->url=$route[1];
        
        
        # admin AUTH
        if (count($route)==2 && $route[0]=='lmr_access' && ($route[1]=='login' || $route[1]=='logout')){
    
            $authc=new \App\AE\C\AE_Auth;
        
            if ($method=='GET' && $route[1]=='login' ){
                return $authc->getLogin('admin');
            }
        
            if ($method=='POST' && $route[1]=='login'){
                return $authc->postLogin($request, 'admin');
            }
        
            if ($method=='GET' && $route[1]=='logout' ){
                return $authc->getLogout('admin');
            }
        
        }
        
        if (Auth::check()==false || Auth::user()->type<>-1)  return View('admin.auth.logout'); 
        
        ####


        #Articles


        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='script'){

        print 'SCRIPT';



        return;
        }


        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='articles'){
            $p->subpage='admin._p._view';

            $p->model='article';
            $p->v=(object)config('_.admin._v')['article'];
            $p->addDisabled=true;

            return view('admin._l.page')->with(['p'=>$p]);
        }


        if (count($route)==4 && $route[0]=='lmr_access' && $route[1]=='article' && $route[2]=='edit'){
            $p->subpage='admin._p.article._edit';
            $p->id=$route[3];


            $p->title="Редагувати  публікацію";
            $p=self::h_getForm($p, 'form', 'article', false);
            $p->item=\App\AE\C\AE_D::getDataById('stat', $p->id);

            #route
            $p->route=self::h_getRoute($p->id, 'article');

            return view('admin._l.page')->with(['p'=>$p]);
        }

        if (count($route)==3 && $route[0]=='lmr_access' && $route[1]=='article' && $route[2]=='add'){
            $p->subpage='admin._p._edit';

            $p->model='category';
            $p->title="Додати категорію";
            $p=self::h_getForm($p, 'form', 'article', true);

            return view('admin._l.page')->with(['p'=>$p]);
        }

        
        # Content
        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='content'){
            $p->subpage='admin._p._view';
        
            $p->model='content';
            $p->v=(object)config('_.admin._v')['content'];
            $p->addDisabled=true;
        
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        if (count($route)==4 && $route[0]=='lmr_access' && $route[1]=='content' && $route[2]=='edit'){
            $p->subpage='admin._p._edit';
            $p->id=$route[3];
            
            $p->title="Редагувати контент";
            $p=self::h_getForm($p, 'form', 'content', false);
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        
        # E-mail
        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='email'){
            $p->subpage='admin._p._view';
        
            $p->model='email';
            $p->v=(object)config('_.admin._v')['email'];
            $p->addDisabled=true;
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        if (count($route)==4 && $route[0]=='lmr_access' && $route[1]=='email' && $route[2]=='edit'){
            $p->subpage='admin._p._edit';
            $p->id=$route[3];
            
            $p->title="Редагувати шаблон";
            $p=self::h_getForm($p, 'form', 'email', false);
        
            return view('admin._l.page')->with(['p'=>$p]);
        }
        

        
        
        # CATEGORY
        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='categories'){
            $p->subpage='admin._p.category._list';
            $p->v=(object)config('_.admin._v')['categories'];
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        if (count($route)==3 && $route[0]=='lmr_access' && $route[1]=='category' && $route[2]=='add'){
            $p->subpage='admin._p._edit';
            
            $p->model='category';
            $p->title="Додати категорію";
            $p=self::h_getForm($p, 'form', 'category', true);
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        if (count($route)==4 && $route[0]=='lmr_access' && $route[1]=='category' && $route[2]=='edit'){
            $p->subpage='admin._p.category._edit';
            $p->id=$route[3];
            
            $p->title="Редагувати категорію";
            $p=self::h_getForm($p, 'form_category', 'category', false);
            
            $p->route=self::h_getRoute($p->id, 'category');
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        

        # STAT
        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='statsApi'){
            $p->subpage='admin._p.statpApi';
            return view('admin._l.page')->with(['p'=>$p]);
        }

        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='statApiAll'){
            $stats=\App\Model\Stat::all();

            foreach ($stats as $stat){
                AdminC::statAPI($stat);
            }
        }

        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='statsCalc'){
            $p->subpage='admin._p._view';

            $p->model='stat';
            $p->v=(object)config('_.admin._v')['statsCalc'];

            return view('admin._l.page')->with(['p'=>$p]);
        }


        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='stats'){
            $p->subpage='admin._p._view';
            
            $p->model='stat';
            $p->v=(object)config('_.admin._v')['stats'];
            
            return view('admin._l.page')->with(['p'=>$p]);
        }


        if (count($route)==3 && $route[0]=='lmr_access' && $route[1]=='stat' && $route[2]=='add'){
            $p->subpage='admin._p._edit';
            
            $p->title='Додати показник';
            $p=self::h_getForm($p, 'form', 'stat', true);
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        if (count($route)==4 && $route[0]=='lmr_access' && $route[1]=='stat' && $route[2]=='edit'){
            $p->subpage='admin._p.stat._edit';
            $p->id=$route[3];
            
            $p=self::h_getForm($p, 'form_stat', 'stat', false);
            
            $p->item=\App\AE\C\AE_D::getDataById('stat', $p->id);
            $p->list=\App\Model\StatDetails::where('stat_id', $p->item->id)->orderBy('year','asc')->get();
            
            #route
            $p->route=self::h_getRoute($p->id, 'stat');
            
            return view('admin._l.page')->with(['p'=>$p]);
        }
        
        
        
        #C
        if ((count($route)==5 or count($route)==4) && $route[0]=='lmr_access' && $route[1]=='@' && $route[2]=='$form'  && $method=="POST"){
            $formName=$route[3];
                
            $p->formName=$formName;


            
            if (isset(AE_H::toObject(config('_.admin._f'))->{$p->formName})){
                $p->form=AE_H::toObject(config('_.admin._f'))->{$p->formName};
                $p->post=$post;

                if ($route[4]<>-1){
                    $p->id=$route[4];
                    $p->type='UPDATE';
                } else {
                    $p->type='NEW';
                }
                
                return (array)AE_C::addEditController($p);
            }
            
        }
        
        
        if (count($route)==5 && $route[0]=='lmr_access' && $route[1]=='@' && $route[2]=='$delete'  && $method=="GET"){
            $p->model=$route[3];
            $p->id=$route[4];
        
            return AE_C::delete($p);
        }
        
        
        if (count($route)==5 && $route[0]=='lmr_access' && $route[1]=='@' && $route[2]=='$route'  && $method=="POST"){
            $p->id=$route[4];
            $p->model=$route[3];
            $p->post=$post;
            
            return (array)AE_Router::updateRoute($p);
        }
        
        
        #Sitemap
        
        if (count($route)==2 && $route[0]=='lmr_access' && $route[1]=='generate_sitemap'){
            $sub='';
            $routes=\App\AE\M\Route::all();
            foreach ($routes as $item){
                $sub.='<url> <loc>'.url('/').'/'.$item->url.'</loc> </url>';
            }
            
            $content=
                '<?xml version="1.0" encoding="UTF-8"?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                '.$sub.'
                </urlset>';
            
             file_put_contents(public_path('').'/sitemap.xml', $content);
        }
        
        
        
        #DEBUG
        if ($route[0]=='lmr_access' && $route[1]=='debug'){
            if (isset($route[2]) && $route[2]=='clean') file_put_contents(storage_path().'/logs/laravel.log', "");
            $logs=file_get_contents(storage_path().'/logs/laravel.log');
            print $logs; 
            exit();
        } //// deb
        
    }
    
    static public function h_getRoute($id, $model){
        $route=(object)[];
            $route->model=$model;
            $route->id=$id;
            $route->fields=\App\AE\C\AE_H::toObject(config('_.admin._f'))->ae_route->f;
            $route=\App\AE\C\AE_Router::h_prepareFields($route);
        
        return $route;
    }
    
    static public function h_getForm($p, $formName, $formModel, $add){
        $p->{$formName}=new \stdClass();
        $p->{$formName}->_f=AE_H::toObject(config('_.admin._f'))->{$formModel};
        $p->{$formName}->model=$formModel;
        
        if (!$add){
            $p->{$formName}->item=\App\AE\C\AE_D::getDataById($p->{$formName}->_f->model, $p->id);
            $p->{$formName}->out=\App\AE\C\AE_F::getForm($formModel, $p->{$formName}->_f->f, $p->{$formName}->item);
        } else {
            $p->id='';
            $p->{$formName}->out=\App\AE\C\AE_F::getForm($formModel, $p->{$formName}->_f->f, null);
        }
        
        return $p;
    }
        
}

