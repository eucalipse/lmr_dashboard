<?php
   $cnf=config('_._app');
    
   $years=$cnf->years;
   $year_column_first=$cnf->year_column_first;
?>
		
		
<form method="post" action="<?php print url('/').'/lmr_access/importDo'; ?>">
  	<input class="isubmit btn btn-primary" type="submit" value="Додати до бази показників">
  </form>
  
		
    <table class="table table-hover table-condensed dt1" id="example">
    <thead>
      <tr>
       <td class="v-align-middle">Категорія</td>
       <td class="v-align-middle">Показник</td>
       <td class="v-align-middle">Надавач даних</td>
       <td class="v-align-middle" style="min-width:150px;">Дані</td>
      </tr>
    </thead>
    
    <tbody>
<?php
	    $i=0;
   		foreach($cvs->items as $item){
    		$styleTR='';
    		
    		if (empty($item[6])) continue;
    		
    		
    		$_category=$item[4];
    		$category=\App\Model\Category::where('code', $_category)->first();
    		if ($category==null) {
    		    $_category=$_category.'<br/><span style="color:red">! немає такої категорії</span>';
    		} else {
    		    $_category=$_category.'<br/>'.$category->title;
    		}
    		
    		$_id=$item[6];
    		$_name=$item[7];
   		    $stat=\App\Model\Stat::where('_id', $_id)->first();
   		    if ($stat<>null) { } else { $styleTR=' style="background-color: #dff0d8;"'; }
   		    
   		    
   		    $year_data=[];
   		    foreach ($years as $i=>$y){
   		        $j=($year_column_first+$i);
   		        if (!empty($item[$j])){
   		            $year_data[]=$y.': '.$item[$j];
   		        }
   		    }
   		    $year_data=join('<br/>', $year_data);
   		    
   		    
		    $cols='';
		    $cols.='<td class="v-align-middle">'.$_category.'</td>';
		    $cols.='<td class="v-align-middle">'.$_id.'<br/>'.$_name.'</td>';
		    $cols.='<td class="v-align-middle">'.$item[9].'</td>';
		    $cols.='<td class="v-align-middle">'.$year_data.'</td>';
		    
		    //if ($i>1) {
		       print '<tr'.$styleTR.'>'.$cols.'</tr>';
		       
		    //}
		       
		    $i++;
    		    
    	}    
		
?>
    </tbody>
  </table>
  
  
  