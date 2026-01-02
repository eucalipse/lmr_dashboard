<?php

namespace App\AE\C;


class AE_F{
    
    static function getForm($formName, $form, $item){
        $out='';

        
        foreach($form as $k => $f){
            
            if (empty($item)) $f->v=''; else $f->v=$item->{$k};
    
            $f->n=$k;
            $f->data=$item;
            $f->model=$formName;
            	
            $out.=AE_F::field($f->l, AE_F::getField($f));
        }
    
    
        return $out;
    }
    
    
    static function prepareFields($fields, $model, $item){ 
        
        foreach ($fields as $fieldName=> &$field){
            $field->n=$fieldName;
            $field->v=@$item->{$fieldName};
        }
    
        return $fields;
    }
    
    
	static function getField($f){ //u
		
		
		if ($f->t=='bool_select') {
			$f->t='select';
			$f->f=[1=>'Yes', 0=>"No"];
		}
		
		$content=call_user_func('self::'.$f->t, $f);
		
		return $content;
	}
	
	
	####
	
	
	
	static function select_state($f) { // +
	    $f->t='select';
	    $f->type=1;
	     
	    $config=(object)config($f->config);
	    $list_items=$config->{$f->state};
	    $f->f=$list_items;
	     
	    return call_user_func('self::'.$f->t, $f);
	}
	
	
	
	static function select_relation($f) { // +
	    $f->t='select';
	    $f->type=1;
	    
	    $list_items=[];
	    $list=\App\AE\C\AE_D::getDataL($f->relation_model);
	    
	    foreach ($list as $item){
	        $list_items[$item->id]=$item->{$f->showField};
	    }
	    $f->f=$list_items;
	    
	    return call_user_func('self::'.$f->t, $f);
	}
	
	
	#####
		
	static function value_plain($f) { //u
		return '<br/>'.$f->v.' <input type="hidden" value="'.$f->v.'" name="'.$f->n.'" />';
	}
	
	static function value_relation($f) { //u
	    $object=\App\AE\C\AE_D::getDataByField($f->relation_model,$f->relation_where ,$f->v);
	     if ($object!==null) return $object->{$f->showField};
	}
		
	static function value_state($f) { 
		$o='<br/>';
		$list=config('');
		
		if (array_key_exists($f['f'], $list)){
			
			if (isset($f['v'])) $f['v']=0;
			
			$o.=$list[ $f['f'] ][ $f['v'] ];
			
		} else {
			$o.='--Not defined--';
		}
		
		$o.='<input type="hidden" value="'.$f['v'].'" name="'.$f['n'].'" />';
		
		return $o;
	
	}
	
	static function value_fx($f) { //u
		$o='<br/>';
		$fxs=config('_.admin.v_fx');
		
		if (array_key_exists($f['f'], $fxs)){
			$fx=$fxs[$f['f']];
		
			$value=$fx($f['data'], $f['v']);
		
		} else {
				
			$value='[f(x) not defined]';
		}
		
		
		$o.=$value;
		
		return $o;
	}
	
	
	
	###
	
	static function fld($f){
	    return AE_F::field($f->l, AE_F::getField($f));
	}
	
	
	static function field($label, $content){ //u
	
	    return '<div class="form-group">
					<label for=""><b>'.$label.'</b></label>
					'.$content.'
				</div>';
	
	}
	
	
	static function location($f) { //u
	    if (!isset($f->arr)) $f->arr=false;
	
	    $a='';
	    if (isset($f->arr))
	        if ($f->arr) $a = '[]';
	
	        return '<input class="form-control gmaplocation"  id="' . $f->n . '" name="' . $f->n.$a. '" type="text" value="' . $f->v . '" />';
	}
	
	static function text($f) { //u 
		if (!isset($f->arr)) $f->arr=false;
	
		$a='';
		if (isset($f->arr))
			if ($f->arr) $a = '[]';
		
		$class='';
		if (!empty($f->class)) $class.=' '.$f->class;
		
		return '<input class="form-control'.$class.'"  id="' . $f->n . '" name="' . $f->n.$a. '" type="text" value="' . $f->v . '" />';
	}
	
	
	static function date($f) { //u
//	    if (!isset($f['arr'])) $f['arr']=false;
	
	    $a='';
//	    if (isset($f['arr']))
//	        if ($f['arr']) $a = '[]';
	
	        return '<input class="form-control sfm_datepicker"  name="' . $f->n. '" type="text" value="' . $f->v . '" />';
	}
	
	static function time($f) { //u
	
		if (!isset($f['arr'])) $f['arr']=false;
	
		$a='';
		if (isset($f['arr']))
			if ($f['arr']) $a = '[]';
	
		return '<input class="form-control sfm_timepicker" id="' . $f['n'] . '" name="' . $f['n'].$a. '" type="text" value="' . $f['v'] . '" />';
	
	}
	
	static function datetime($f) { //u
	    if (!isset($f['arr'])) $f['arr']=false;
	
	    $a='';
	    if (isset($f['arr']))
	        if ($f['arr']) $a = '[]';
	
	        return '<input class="form-control sfm_dtpicker"  name="' . $f['n'].$a. '" type="text" value="' . $f['v'] . '" />';
	}
	
	
	static function hidden($f) { //u
		if (!isset($f['arr'])) $f['arr']=false;
	
		$a='';
		if (isset($f['arr']))
			if ($f['arr']) $a = '[]';
	
		return '<input id="' . $f['n'] . '" name="' . $f['n'].$a. '" type="hidden" value="' . $f['v'] . '" />';
	}
	
	
	static function html($f) { //u
	    $o='<div class="summernote" data-f="' . $f->n . '">'.$f->v.'</div>  <input type="hidden" id="' . $f->n . '" name="' . $f->n.'" type="hidden" value="" /> ';
	    return $o;
	}
	
	
	static function textarea($f) { //u
		if (!isset($f->max)) $f->max=0;
		if (!isset($f->rows)) $f->rows=15;
		if (!isset($f->font_size)) $f->font_size=14;
				
		$a='';
		if (isset($f->arr))
			if ($f->arr) $a = '[]';
	
		$ml='';
		if ($f->max>0) $ml='maxlength="'.$f->max.'"';
		
		return '<textarea style="font-size: '.$f->font_size.'" class="form-control" rows="'.$f->rows.'" id="' . $f->n.'" name="' . $f->n.$a  . '" '.$ml.'>' . $f->v . '</textarea>';
	}
	
	
	
    static function checkboxes($f){
		$out='<br/>';
		
		$item=$f['data'];
		
		foreach ($f['fields'] as $name=>$title){
		    if (isset($item->$name) && $item->$name==1) $ch='checked'; else $ch='';
			$out.='<input type="checkbox" name="'.$name.'" '.$ch.' />'.$title.' &nbsp;&nbsp;&nbsp;';	
		}
		
		return $out;
		
	}
	
	
	static function select($f) { //u 
		$value=$f->v;
		$name=$f->n;
		$list=[]; 
		
		
		if (!isset($f->type)) $list=$f->f; 
		
		if (isset($f->type) && $f->type==1) $list=$f->f;
		
		
		if (!isset($f->keyValue)) $f->keyValue=true;//
		if (!isset($f->arr)) $f->arr=false;
	
		
		$class='';
		if (!empty($f->class)) $class=' '.$f->class;
		
		$a='';
		if ($f->arr) $a='[]';
	
		$select = '<select name="' .$name.$a. '" id="' . $name . '" class="form-control'.$class.'"> ';
	
		if (empty ( $value )) {
			$value = '';
		}
	
		foreach ( $list as $key => $item ) {
			if (trim ( $value ) == trim ( $key )) $s = ' selected'; else $s = '';
	
			if (!$f->keyValue) {
				if (trim ( $value ) == trim ( $item ))
					$s = ' selected';
				else
					$s = '';
					
				$key=$item;
			}
	
			$select .= '<option value="' . $key . '"' . $s . '>' . $item . '</option>';
		}
	
		return $select .= '</select>';
	}
	
	
	
	
	static function img($f) { //u
		return '<div class="wwh_img_wrapper">
					<input type="hidden" name="' . $f['n'].'" value="' . $f['v'].'" />
					<a href="#"  class="aeSelectImg" data-id="' . $f['v'].'" data-t="s" data-l="' . $f['n'].'" data-toggle="modal" data-target="#aeSysModal"><i class="fa fa-picture-o"></i> Select image</a>
					<div class="imgs">'.AEI::showImgMiniature($f['v'], false).'</div>
				</div>';
	}
	
	
	static function imgs($f) { //u
			return '<div class="wwh_img_wrapper">
						<input type="hidden" name="' . $f['n'].'" value="' . $f['v'].'" />
						<a href="#"  class="aeSelectImg" data-id="" data-t="m" data-l="' . $f['n'].'" data-toggle="modal" data-target="#aeSysModal"><i class="fa fa-picture-o"></i> Select images</a>
						<div class="imgs">'.AEI::showImgMiniature($f['v'], true).'</div>		
				   </div>';
	}
	
	/////
	
	
	static function getFormView($opt, $model, $data){ //u
	    $out='';
	
	    $arr=$opt['cnf']['md'];
	
	    foreach($arr['f'] as $k => $f){
	
	        if (empty($data)) $f['v']=''; else $f['v']=$data->$k;
	
	        $f['n']=$k;
	        $f['data']=$data;
	         
	        if (empty($data)) $f['v']=''; else $f['v']=$data->$k;
	        
	        
	        $out.=AE_F::field('<b>'.$f['l'].': </b>', $f['v']);
	    }
	
	
	    return $out;
	}
	
	
	
	
}
?>