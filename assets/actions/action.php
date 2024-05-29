<?php 

$action = $_GET['action'] ?? null;
$way = $_GET['way'] ?? null;
$item = $_GET['item'] ?? null;

switch ($action) {
    case 'next':
        if($way){
            $data[0]['way'] = $way;
            $data[0]['place'] = 1;
        }
        else {
            $i += 1;
            $data[0]['place'] = $i;
        }
        break;
    case 'back':
        if($i == 1){
            $w -= 1;
            $i = count($data[1]['ways'][$w]);
            $i -= 1;
        }
        else{
            $i -= 1;
        }
        $data[0]['place'] = $i;
        $data[0]['way'] = $w;
        break;
    case 'reset':
        $data[0]['name'] = null;
        $data[0]['gender'] = null;
        $data[0]['place'] = 1;
        $data[0]['way'] = 1;
        break;
    case 'choice1':
        $data[0]['way'] = $data[1]['ways'][$w][$i]['choice']['destinationchoice1'][0];
        $data[0]['place'] = $data[1]['ways'][$w][$i]['choice']['destinationchoice1'][1];
        break;
    case 'choice2':
        $data[0]['way'] = $data[1]['ways'][$w][$i]['choice']['destinationchoice2'][0];
        $data[0]['place'] = $data[1]['ways'][$w][$i]['choice']['destinationchoice2'][1];
        break;
    case 'item':
        $character = $item;
        break;
}

if($action && $action != "character") {
    file_put_contents('./assets/datas/data.json', json_encode($data));
    
    header('Location: /');
}