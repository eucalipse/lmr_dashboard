<?php

return (object)[
    
    'ae_route'=>[
        'f'=>[
            'url'=>['l'=>'Посилання до сторінки', 't'=>'text'],
            'title'=>['l'=>'Титул', 't'=>'text'],
            'title_en'=>['l'=>'Титул (EN)', 't'=>'text'],
            'keywords'=>['l'=>'Ключові слова (Кeywords)', 't'=>'text'],
            'keywords_en'=>['l'=>'Ключові слова (Кeywords) (EN)', 't'=>'text'],
            'description'=>['l'=>'Опис (Description)', 't'=>'text'],
            'description_en'=>['l'=>'Опис (Description) (EN)', 't'=>'text'],
        ],
    ],
    
    'content' => [
        'f'=>[ 
            'content'=>['l'=>'Контент', 't'=>'html'],
            'content_en'=>['l'=>'Контент (EN)', 't'=>'html'] 
        ],
        'model'=>'content'
    ],

    'article' => [
        'f'=>[
//            'slug'=>['l'=>'URL', 't'=>'text'],
            'title'=>['l'=>'Титул', 't'=>'text'],
            'img'=>['l'=>'Фото(урл)', 't'=>'text'],
            'short'=>['l'=>'Скорочений контент', 't'=>'text'],
            'content'=>['l'=>'Контент', 't'=>'textarea'],

            'date'=>['l'=>'Дата', 't'=>'date']

        ],
        'model'=>'article'
    ],
    
    'category' => [
        'f'=>[
            'type'=>['l'=>'Тип', 't'=>'select_state', 'state'=>'category_state', 'config'=>'_._s'],
            'parent'=>['l'=>'Батьківська категорія', 't'=>'select_relation', 'relation_model'=>'category', 'showField'=>'title'],
            'code'=>['l'=>'Код категорії','t'=>'text'],
            'title'=>['l'=>'Назва','t'=>'text'],
            'title_en'=>['l'=>'Назва (EN)','t'=>'text'],
        ],
        
        'model'=>'category'
    ],
	
    'stat_details'=>[
        'function'=>['type'=>'single', 'name'=>'stat_details'],
    ]
    
    ,
    
    'stat' => [
        
        'f'=>[
            '_id'=>['l'=>'Уніальний ідентифікатор','t'=>'text'],
            'category_id'=>['l'=>'Категорія', 't'=>'select_relation', 'relation_model'=>'category', 'showField'=>'title', 'class'=>''],
            'type'=>['l'=>'Тип показника', 't'=>'select_state', 'state'=>'stat_type', 'config'=>'_._s'],
            'widget_type'=>['l'=>'Тип віджету', 't'=>'select_state', 'state'=>'widget_type', 'config'=>'_._s'],

            'title'=>['l'=>'Титул','t'=>'text'],
            'title_en'=>['l'=>'Титул (EN)','t'=>'text'],
            'measurement'=>['l'=>'Одиниця вимірювання','t'=>'text'],
            'measurement_en'=>['l'=>'Одиниця вимірювання (EN)','t'=>'text'],
            // 'vendor_id'=>['l'=>'Надавач даних', 't'=>'select_relation', 'relation_model'=>'vendor', 'showField'=>'name', ],
            'formula'=>['l'=>'Розрахункова формула', 't'=>'text'],

            'p_icon'=>['l'=>'Параметр Іконка',  't'=>'select_state', 'state'=>'icon', 'config'=>'_._s'],
            'p_text'=>['l'=>'Параметр Текст', 't'=>'html'],
            'content'=>['l'=>'Опис показника', 't'=>'html'],
            // 'content_en'=>['l'=>'Опис показника (EN)', 't'=>'html'],
            'order'=>['l'=>'Порядок', 't'=>'text'],

            'min'=>['l'=>'Min', 't'=>'text'],
            'max'=>['l'=>'Max', 't'=>'text'],
            'step'=>['l'=>'Step', 't'=>'text'],

            'key1'=>['l'=>'Key 1', 't'=>'text'],
            'key2'=>['l'=>'Key 2', 't'=>'text'],
        ],
        
        'model'=>'stat'
    ],
    
];

?>