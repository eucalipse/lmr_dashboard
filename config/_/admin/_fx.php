<?php

use App\AE\C\AE_D;
use App\Model\TaskDetails;
use App\Model\Vendor;
use App\Model\StatDetails;
use App\Model\User;
use App\Model\Stat;

return [
    
    #### VIEW FX
    
    'btns_edit_delete'=>function($item, $p){
        return '
            <a href="#" class="ae_delete_item" data-m="'.$p->model.'" data-id="'.$item->id.'" data-toggle="tooltip" title="Видалити"><i class="fa fa-times-circle"></i></a> 
            <a href="'.url('lmr_access/'.$p->model.'/edit/'.$item->id).'"><i class="fa fa-edit"></i></a>
        ';
    },
    
    'btns_edit'=>function($item, $p){
      return '
            <a href="'.url('lmr_access/'.$p->model.'/edit/'.$item->id).'"><i class="fa fa-edit"></i></a>
        ';
    },
    
    'btns_edit_delete_view'=>function($item, $p){
       $url=\App\AE\C\AE_Router::link($p->model, $item->id);
       $v ='<a href="' . $url . '" target="_blank"><i class="fa fa-eye"></i></a> ';
    
       return '
             <a href="#" class="ae_delete_item" data-m="'.$p->model.'" data-id="'.$item->id.'" data-toggle="tooltip" title="Видалити"><i class="fa fa-times-circle"></i></a>
             <a href="'.url('lmr_access/'.$p->model.'/edit/'.$item->id).'"><i class="fa fa-edit"></i></a>
            '.$v;
    },
  
    
    'excerpt'=>function($item, $p){
        return strlen($item->content)>300?substr($item->content, 0, 300).'..':$item->content;
     },
     'excerpt_en'=>function($item, $p){
        return strlen($item->content_en)>300?substr($item->content_en, 0, 300).'..':$item->content_en;
     },
    
    
    # Tasks
    'task_vendor_name'=>function($item, $p){
        $o='';
        $data=AE_D::getDataById('vendor', $item->vendor_id);
        if($data!=null) $o=$data->name;
        return $o;
    },
    
    'task_vendor_person'=>function($item, $p){
        $o='';
        $data=AE_D::getDataById('vendor', $item->vendor_id);
        if($data!=null) $o=$data->person_name.' '.$data->person_surname;
        return $o;
     },
    
    
    
    # VENDOR
    
    'vendor_name'=>function($item, $p){
        return $item->person_name.' '.$item->person_surname;
    },
    
    
    'category_parent'=>function($item, $p){
        $o='--';
        
        $data=AE_D::getDataById('category', $item->parent);
        if($data!=null) $o=$data->title;
    
       return $o;
    },
    
    
    'category_type'=>function($item, $p){
        return $item->type;
    },


    
    # STAT
    
    
    'stat_category'=>function($item, $p){
        $o='--';
        
        $data=AE_D::getDataById('category', $item->category_id);
        if($data!=null) $o=$data->title; 
    
        return $o;
    },
    
    
    'stat_data'=>function($item, $p){
        $o='';
    
        $list=\App\Model\StatDetails::where('stat_id', $item->id)->orderBy('year','asc')->get();
         
        foreach($list as $item){
            if ($item->type==1) {
                $o.='(Plan) '.$item->year.': '.$item->value.'<br/>';
            } else{
                $o.=$item->year.': '.$item->value.'<br/>';
            }
        }
      return $o;
    },
    
    
    
    ### FORM FX
    'vendor_password'=>function($p){
        $vendor=\App\AE\C\AE_D::getDataById('vendor', $p->id);
            $vendor->email=$p->post->email;
        $vendor->save();
        
        $user=\App\AE\C\AE_D::getDataByField('user', 'model_id', $p->id);
        
        if ($user==null){
            $user=new User();
            $user->type=0;
            $user->model_id=$vendor->id;
        }
        
            $user->email=$p->post->email;
            $user->password=\Hash::make($p->post->vendor_password);
        $user->save();
    }
    
    ,
    
    'task_details'=>function($p){
          $i=0;
          
          $ids=[];
          foreach ($p->post->task_stat as $task_stat){
              $id=$p->post->task_detail[$i];

              $taskDetail=TaskDetails::where('id', $id)->first();
              if ($taskDetail==null){
                  $taskDetail = new TaskDetails();
              }
                  $taskDetail->task_id=$p->id;
                  $taskDetail->stat=$p->post->task_stat[$i];
                  $taskDetail->year=$p->post->task_year[$i];
                  $taskDetail->state=$p->post->task_state[$i];
              $taskDetail->save();
              
              $ids[]=$taskDetail->id;
              
              $i++;
          }
          
          $taskDetails=TaskDetails::where('task_id', $p->id)->whereNotIn('id', $ids)->get();
          foreach ($taskDetails as $detail){
              $detail->delete();
          }
          
          
    }
    
    ,
    
    'stat_details'=>function($p){

        $statDetails=StatDetails::where('stat_id', $p->id)->get();
         foreach ($statDetails as $statDetail){
             $statDetail->delete();
         }
         
         $i=0;
         foreach ($p->post->year as $year){
             $statDetail = new StatDetails();
                 $statDetail->stat_id=$p->id;
                 $statDetail->year=$p->post->year[$i];
                 $statDetail->value=$p->post->value[$i];
                 $statDetail->type=$p->post->type[$i];
             $statDetail->save();
             
            $i++;
         }
         
    
         return 1;
    }
    
    ,
    
    'task_add'=>function($p){
            $p->entity->created_at=date('Y-m-d h:i');
            $p->entity->state=0;
        $p->entity->save();
        
        $stats=Stat::where('vendor_id', $p->entity->vendor_id)->get();
        foreach ($stats as $stat){
            $taskDetail = new TaskDetails();
                $taskDetail->task_id=$p->entity->id;
                $taskDetail->stat=$stat->id;
                $taskDetail->state=0;
            $taskDetail->save();
        }
        
    }
    
    ,
    
    '_task_detail_count'=>function($p){
    
        return TaskDetails::where('task_id', $p->id)->get()->count();
    
    }
    
    
    
];

?>