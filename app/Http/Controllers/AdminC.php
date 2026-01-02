<?php

namespace App\Http\Controllers;


class AdminC extends Controller
{

    static function findCategory($i){
        $categoryCode=$i->MenuID;
        $subCategoryCode=$i->ItemPageID;

        $c=\App\Model\Category::where('code', $subCategoryCode)->first();
        if (isset($c)) {return $c->id;} else {
            $c=\App\Model\Category::where('code', $categoryCode)->first();
            if (isset($c)) return $c->id; else  return -1;
        }
    }

    static function createCategoryIfNotExists($i){
        $categoryCode=$i->MenuID;
        $subCategoryCode=$i->ItemPageID;

        $c_parent=\App\Model\Category::where('code', $categoryCode)->first();
        if (!isset($c_parent) && $categoryCode!=='NONE'){
            $c_parent= new \App\Model\Category();
                $c_parent->parent=4;
                $c_parent->code=$i->MenuID;
                $c_parent->title=$i->MenuName;
            $c_parent->save();
        }

        $c_sub=\App\Model\Category::where('code', $subCategoryCode)->first();
        if (!isset($c_sub) && $subCategoryCode!=='NONE'){
            $c_sub=new \App\Model\Category();
                $c_sub->parent=$c_parent->id || 4;
                $c_sub->code=$i->ItemPageID;
                $c_sub->title=$i->ItemPageName;
            $c_sub->save();
        }

    }


    static function statAPI(){
        $keys=config('_.stats');
        set_time_limit(0);
        foreach ($keys as $i=>$k){
            self::statAPICode($k['n'], $k['k1'],$k['k2']);
        }
    }
    
    static function statAPICode($name, $key, $key2){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $url="https://opendata.city-adm.lviv.ua/api/3/action/datastore_search?resource_id=".$key2."&limit=10000";
        

        $content=file_get_contents($url, false, stream_context_create($arrContextOptions));
        $object=json_decode($content);

        $ids=[];
        $j=0;
        $new=false;
        foreach ($object->result->records as $i) {

             $stat=\App\Model\Stat::where('_id', $i->IndicatorID)->first();

            //  print $i->IndicatorID.'<br/>';
            //  print_r($stat->toArray());
            //  print_r($i);

            if (!isset($stat)){
                 $stat=new \App\Model\Stat();
                 $new=true;
            } else {
                 $new=false;
            }
            $stat->save();

            if (!in_array($i->IndicatorID, $ids)) {
                $ids[]=$i->IndicatorID;
                \App\Model\StatDetails::where('stat_id', $stat->id)->delete();
                print '<tr><td>'.$name.'</td> <td>'.$i->IndicatorName.'</td> <td>'.$i->IndicatorID.'</td><tr>';
            }

                $stat->category_id=self::findCategory($i);

                $stat->_id=$i->IndicatorID;
                $stat->_category=$i->ItemPageID;

                $stat->title=$i->IndicatorName;
                $stat->measurement=$i->IndicatorMeasurement;
                $stat->vendor_name=$i->DataProvider;

                if (isset($i->IndicatorCalculationFormula)){
                    $stat->formula=$i->IndicatorCalculationFormula;
                }

                $stat->key1=$key;
                $stat->key2=$key2;
            $stat->save();

            //create new
            if (trim($i->IndicatorValue)<>'NULL') {

                $d=new \App\Model\StatDetails();
                    $d->stat_id=$stat->id;
                    $d->type=0;
                    $d->year=$i->IndicatorValueYear;

                    $v=trim($i->IndicatorValue);
                    $v=str_replace(",",'.',$v);
                    $v=str_replace(" ",'',$v);

                    $q=explode('.', $v);

                    if (count($q)==1){
                        $d->value=$q[0];

                    } elseif (count($q)>1){
                        $d->value=$v;
                   }
                $d->save();
            }
        }
        return true;
    }
    
}
    
