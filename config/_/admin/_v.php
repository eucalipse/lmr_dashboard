<?php

return [
			
    'route' => [
        'title'=>'Статичні сторінки',
        'head'=>['',  'Url', 'Тип', 'HTML'],
        'content'=>[
            ''=>['type'=>'function', 'f'=>'btn_route'], 
            'url'=>['type'=>'f'],
            'type'=>['type'=>'state', 'f'=>'route_type'], 
            'p1'=>['type'=>'f'] 
        ],
    
        'mm'=>'route',
        'mt'=>'route',
        'url'=>'edit'
    ],
    
    'content' => [
        'title'=>'Контент',
        'head'=>['', ''],
        'content'=>[
            '_'=>['type'=>'function', 'f'=>'btns_edit'],
            'slug'=>['type'=>'plain'],
            '__'=>['type'=>'function', 'f'=>'excerpt'],
            '__en'=>['type'=>'function', 'f'=>'excerpt_en'],
        ],
        'model'=>'content'
    ],

    'article' => [
        'title'=>'Публікації',
        'head'=>['', ''],
        'content'=>[
            'title'=>['type'=>'plain'],
            'url'=>['type'=>'plain'],
            'short'=>['type'=>'plain'],
            '_'=>['type'=>'function', 'f'=>'btns_edit'],
//            '__'=>['type'=>'function', 'f'=>'excerpt'],
        ],
        'model'=>'article'
    ],
    
    'categories' => [
            'title'=>'Категорії',
           	'head'=>['',  'Батьківська катерорія', 'Титул'],
			'content'=>[
			    ''=>['type'=>'function', 'f'=>'btns_edit_delete_view'],
			    '_parent'=>['type'=>'function', 'f'=>'category_parent'],
			    'title'=>['type'=>'plain'], 
			],
        
            'model'=>'category',
            'rawSql'=>true,
            'sql'=>'SELECT * FROM `category` ORDER BY case when parent=0'
    ],
    
    'stats' => [
        'title'=>'Показники',
        'head'=>[ '', 'Категорія', 'ID', 'Назва показника', 'Розпорядник даних', 'Віджет', 'Дані'],
        'content'=>[ 
            ''=>['type'=>'function', 'f'=>'btns_edit_delete_view'],
            'category'=>['type'=>'function', 'f'=>'stat_category'],
            '_id'=>['type'=>'plain'],
            'title'=>['type'=>'plain'],
            'vendor_name'=>['type'=>'plain'],
            'widget_type'=>['type'=>'state', 'f'=>'widget_type'],
            
            '_data'=>['type'=>'function', 'f'=>'stat_data'],
         ],
        'model'=>'stat'


     ],

    'statsCalc' => [
        'title'=>'Показники',
        'head'=>[ '', 'Категорія', 'ID', 'Назва показника', 'Розпорядник даних', 'Віджет', 'Дані'],
        'content'=>[
            ''=>['type'=>'function', 'f'=>'btns_edit_delete_view'],
            'category'=>['type'=>'function', 'f'=>'stat_category'],
            '_id'=>['type'=>'plain'],
            'title'=>['type'=>'plain'],
            '_vendor_name'=>['type'=>'function', 'f'=>'task_vendor_name'],
            'widget_type'=>['type'=>'state', 'f'=>'widget_type'],

            '_data'=>['type'=>'function', 'f'=>'stat_data'],
        ],
        'model'=>'stat',

        'rawSql'=>true,
        'sql'=>'SELECT * FROM `stat` where type="1" '

    ],

    'statsApi' => [
        'addDisabled'=>true,

        'title'=>'Новостворені показники з API',
        'head'=>[ '', 'Категорія', 'ID', 'Назва показника', 'Розпорядник даних', 'Віджет', 'Дані'],
        'content'=>[
            ''=>['type'=>'function', 'f'=>'btns_edit_delete_view'],
            'category'=>['type'=>'function', 'f'=>'stat_category'],
            '_id'=>['type'=>'plain'],
            'title'=>['type'=>'plain'],
            '_vendor_name'=>['type'=>'function', 'f'=>'task_vendor_name'],
            'widget_type'=>['type'=>'state', 'f'=>'widget_type'],

            '_data'=>['type'=>'function', 'f'=>'stat_data'],
        ],
        'model'=>'stat',

        'rawSql'=>true,
        'sql'=>'SELECT * FROM `stat` where type="3" '

    ],

    'statsPie' => [
        'addDisabled'=>false,

        'title'=>'Показники Pie-chart',
        'head'=>[ '', 'Категорія', 'ID', 'Назва показника', ],//'Розпорядник даних', 'Віджет', 'Дані'],
        'content'=>[
            ''=>['type'=>'function', 'f'=>'btns_edit_delete_view'],
            'category'=>['type'=>'function', 'f'=>'stat_category'],
            '_id'=>['type'=>'plain'],
            'title'=>['type'=>'plain'],
//            '_vendor_name'=>['type'=>'function', 'f'=>'task_vendor_name'],
//            'widget_type'=>['type'=>'state', 'f'=>'widget_type'],

//            '_data'=>['type'=>'function', 'f'=>'stat_data'],
        ],
        'model'=>'stat',

        'rawSql'=>true,
        'sql'=>'SELECT * FROM `stat` where type="4" '

    ],


		
];

?>