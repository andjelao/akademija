<?php 

    if( isset($_POST['tekst']) && $_POST['tekst'] != "" ){
        $tekst = $_POST['tekst'];
    }else{
        exit("Greska 1 - morate unijeti tekst...");
    }
    if( isset($_POST['opis']) && $_POST['opis'] != "" ){
        $opis = $_POST['opis'];
    }else{
        exit("Greska 2 - morate unijeti opis...");
    }

    $data = file_get_contents('./todo.db');
    $data_arr = json_decode($data, true);
    if($data == null){
        $data_arr = [];
    }

    function generisiNoviID(){
        global $data_arr;
        $max = 0;
        foreach( $data_arr as $arr ){
            if( $arr['id'] > $max ) $max = $arr['id'];
        }
        return $max+1;
        }

    // radimo dodavanje
    $data_arr[] = [ 'id' => generisiNoviID() , 'tekst' => $tekst, 'opis' => $opis, 'zavrsen' => false ];

    // cuvamo u fajl
    if( file_put_contents( './todo.db', json_encode($data_arr) ) ){
        echo "OK";
    }else{
        echo "Greska 3 - pogresan upis podataka...";
    }

?>