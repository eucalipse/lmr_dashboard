<?php

	use App\AE\C\AE_Router;
	use App\Http\Controllers\VH;

	$lng = request()->get('lang', 'ua');
	$items=\App\Model\Stat::where('category_id', $category->id)->orderBy('widget_type','asc')->get();

	foreach ($items as $item){
	    $url=AE_Router::link('stat', $item->id, $lng == 'en');


		if ($p->mainCategory==1 || $p->mainCategory==2){
			$item_details_recent=\App\Model\StatDetails::where('stat_id', $item->id)->where('type', 0)->orderBy('year', 'desc')->first();
		}

		if ($p->mainCategory==3){
			$item_details_recent=\App\Model\StatDetails::where('stat_id', $item->id)->where('type', 0)->orderBy('year', 'desc')->skip(1)->first();
		}
		
		if ($p->mainCategory==4){
			$item_details_recent=\App\Model\StatDetails::where('stat_id', $item->id)->where('type', 0)->orderBy('year', 'desc')->skip(1)->first();
		}


	    if ($item_details_recent<>null){
	        $item->_value=VH::format($item_details_recent->value);
            $item->_year=$item_details_recent->year;
	    } else {
	        $item->_value="";
            $item->_year="";
	    }

		$length=strlen($item->_value);

		if ($length>6){
			$item->_value=(int)$item->_value;
		}

		if (request()->get('lang','ua')=='en'){
			$item->title=$item->title_en;
			$item->measurement=$item->measurement_en;
		}

	    if ($item->widget_type==0) { 
	        include 'widget/w_chart_number.php';
	    }
	    
	    if ($item->widget_type==1) { 
	        include 'widget/w_chart_percent.php';
	    }
	    
	    if ($item->widget_type==2) { 
	        include 'widget/w_chart_line_bar.php';
	    }
	    
	    if ($item->widget_type==3) { 
	        include 'widget/w_chart_circle_icon_text.php';
	    }
	    
	    if ($item->widget_type==4) { 
	        $item_details_plan=\App\Model\StatDetails::where('stat_id', $item->id)->orderBy('year', 'desc')->get();
			$item->_value=$item_details_plan[1]->value;
			$item->_value_plan=$item_details_plan[0]->value;
	        include 'widget/w_chart_two_numbers.php';
	    }
	    
    }

?>


  					
                        
                        
                        



	



