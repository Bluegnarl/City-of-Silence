<?php 

$name = $_POST['name'] ?? null;
$gender = $_POST['gender'] ?? null;

if($name && $gender) {
    $data[0]['name'] = $name;
    $data[0]['gender'] = $gender;

    file_put_contents('./assets/datas/data.json', json_encode($data));

    header('Location: /');
}