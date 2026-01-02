<?php

namespace App\Http\Controllers;


class VH extends Controller
{

    static function categoryTree($category_id, $i=0, $out=[]){
        $lng=request()->get('lang','ua');
        $isEn = $lng == 'en';
        $langSuffix = $isEn ? '?lang=en' : '';

        $out=[];
        $c=\App\Model\Category::where('id', $category_id)->first();

        if (!$c) return [];

        if ($c->parent<>-1){
            $url_sub=\App\AE\C\AE_Router::link('category', $category_id, $isEn);

            if ($category_id==1) $url_sub=url('/statystyka/details').$langSuffix;
            if ($category_id==2) $url_sub=url('/jakist-zyttia/details').$langSuffix;
            if ($category_id==3) $url_sub=url('/strategia/details').$langSuffix;
            if ($category_id==4) $url_sub=url('/concepcia/details').$langSuffix;

            $i++;
            $out=array_merge(self::categoryTree($c->parent, $i, $out), $out);

            if ($i==1) {
                $url_sub=\App\AE\C\AE_Router::link('category', $c->parent).($isEn ? "?subCategory=".$c->id."&lang=en" : "?subCategory=".$c->id);
            }

            $out[]='<a href="'.$url_sub.'">'.trim(ucfirst($lng=='ua'?$c->title:$c->title_en)).'</a>' ;
        }

        return $out;
    }

    static function translit($str)
    {
    
        $str=trim($str);
        $tr = array(
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
            "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"y",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
            "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
            "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "и"=>"y", "й"=>"j", "к"=>"k",
            "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
            "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
            "я"=>"ya", " "=>"_", "."=>"", ","=>"", "/"=>"-",
            ":"=>"", ";"=>"","—"=>"", "–"=>"-",
            'і'=>'i','І'=>'I','ї'=>'i','Ї'=>'I',
            'є'=>'je','Є'=>'Je',
            'ь'=>'','"'=>'','\''=>'',
        );
        return strtr($str,$tr);
    }

    static function format($n){
	    $o=$n;
	    $o=str_replace(",", '', $o);
	    return $o;
	}
}
    
