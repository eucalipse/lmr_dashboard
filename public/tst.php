<?php
 header('Content-type: text/html');
   header('Access-Control-Allow-Origin: *');
$key2='d11ad6b0-4bbb-44cb-862c-86ed67b7c220';
$url='https://opendata.city-adm.lviv.ua/api/3/action/datastore_search?resource_id='.$key2;

#         $ch = curl_init();
#  curl_setopt( $ch, CURLOPT_AUTOREFERER, TRUE );
#  curl_setopt( $ch, CURLOPT_HEADER, 0 );
#  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
#  curl_setopt( $ch, CURLOPT_URL,$url );
#  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
#  $content = curl_exec( $ch );
#  curl_close( $ch );
        $content=@file_get_contents("http://opendata.city-adm.lviv.ua/api/3/action/datastore_search?resource_id=".$key2);
#        $content=file_get_contents($cont);
        $object=json_decode($content);
        print '<h2>                     : '.$content.'</h2><br/><br/>';
<------>return;
?>

