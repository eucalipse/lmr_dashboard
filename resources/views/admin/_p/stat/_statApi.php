<div class="tab-pane" id="tab2">

    <a href="<?php print url('').'/statApi/'.$p->item->id?>">Стягнути дані з API</a><br/><br/>

    <div class="row">
        <form method="post">
            <?php  ($p->item->type==0)?print '<a class="btn btn-primary c_add_element"> <i class="fa fa-plus-square-o"></i> Додати дані в динаміці</a><br/><br/>':''; ?>

            <div class="c_element_rows">
                <?php







                    if($p->item->type==1){
                        foreach ($p->list as $item) {
                            print '
                                <div class="c_element_row ">
                                   <div class="row m-t-15">
                                        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Рік </label>
                                             <input type="text" value="' . $item->year . '" class="c_1" />
                                        </div>
                    
                                        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Значення </label>
                                            <input type="text" value="' . $item->value . '" class="c_2" /> </br>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-3 col-xs-3"> <label for="">Тип </label>
                                            <select class="c_3">
                                                <option value="0" ' . ($item->type == 0 ? 'selected' : '') . '>Звичайний</option>
                                                <option value="1" ' . ($item->type == 1 ? 'selected' : '') . '>План</option>
                                            </select>
                                        </div>
                    
                                        <div class="col-md-3">
                                            <label for=""></label>
                                            <a href="#" class="c_delete_element"><i class="fa fa-minus-square-o"></i>  Усунути</a>
                                        </div>
                    
                                      </div>
                                </div>';
                        }

                     } else {

                        print '<h3>Розрахункова формула: <i>'.$p->item->formula.'</i></h3>';

                        /// mock
                        ///
                        $values=['1.1.1.1.2','1.1.1.1.3'];
                        $items=[];

                        foreach($values as $v){
                            $stat=\App\Model\Stat::where('_id', $v)->first();
                            $details=\App\Model\StatDetails::where('stat_id', $stat->id)->where('type', 0)->orderBy('year', 'desc')->get()->toArray();
                            $items[$v]=$details;
                        }

                        print_r($items);


                        foreach($items as $i=>$v ){
                            $formula=$p->item->formula;

                            foreach($v as $j=>$l ){
//                                print_r();

                                $items[$i][$j];

                            }



                        }


                     }
               ?>
            </div>

            <br/>

          <?php  ($p->item->type==0)?print '<input class="btn btn-primary saveSubForm saveCompose2" data-f="stat_details"  data-id="'.$p->id.'" value=" Зберегти дані">':'' ?>
        </form>
    </div>

</div>