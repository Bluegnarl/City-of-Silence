<?php

$data = json_decode(file_get_contents('./assets/datas/data.json'), true);

$w = $data[0]['way'];
$i = $data[0]['place'];

require_once './assets/actions/action.php';
require_once './assets/actions/form.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>City of Silence</title>
</head>
<body>
    <main>
        <?php if($data[0]['name'] == null) require_once './assets/partials/form.php';
        else { ?>
            <div class="game" style="background: url(./assets/img/<?= $data[1]['ways'][$w][$i]['image'] ?>); no-repeat center/cover">
                <?php if($action != "character") { ?>
                    <?php foreach ($data[1]['ways'][$w][$i]['way'] as $index => $way) : ?>
                        <a class="abs" href="<?php 
                        if($data[1]['ways'][$w][$i]['way'][$index]['dest'] == null) {
                            echo "/?action=next";
                        }
                        else echo "/?action=next" . "&way=" . $data[1]['ways'][$w][$i]['way'][$index]['dest'] ?>" 
                        style="width: <?= $data[1]['ways'][$w][$i]['way'][$index]['size'] ?>; height: <?= $data[1]['ways'][$w][$i]['way'][$index]['size'] ?>; left: <?= $data[1]['ways'][$w][$i]['way'][$index]['positionX'] ?>; top: <?= $data[1]['ways'][$w][$i]['way'][$index]['positionY'] ?>;"></a>
                    <?php endforeach ?>
                    <?php foreach ($data[1]['ways'][$w][$i]['item'] as $index => $item) : ?>
                        <a class="abs" href="/?action=<?= ($data[1]['ways'][$w][$i]['item'][$index]['type'] == "character") ? "character" : "item" ?>&item=<?= $data[1]['ways'][$w][$i]['item'][$index]['name'] ?>&index=<?= $index ?>" style="left: <?= $data[1]['ways'][$w][$i]['item'][$index]['positionX'] ?>; top: <?= $data[1]['ways'][$w][$i]['item'][$index]['positionY'] ?>;">
                            <img style="width: <?= $data[1]['ways'][$w][$i]['item'][$index]['size'] ?>;"  src="<?= "./assets/img/" . $data[1]['ways'][$w][$i]['item'][$index]['name'] . "_small.png" ?>">
                        </a>
                    <?php endforeach ?>
                    <p><?= $data[1]['ways'][$w][$i]['text'] ?></p>
                    <?php
                    if($data[0]['place'] != 1) : ?>
                        <a href="/?action=back"><img class="back" src="./assets/img/arrow.png"></a>
                    <?php endif;
                    if($data[0]['place'] == 1 && $data[0]['way'] != 1) : ?>
                        <a href="/?action=back"><img class="back" src="./assets/img/arrow.png"></a>
                    <?php endif ?>
                    <?php if($data[1]['ways'][$w][$i]['choice'] != null) : ?>
                        <div class="choice">
                            <a href="/?action=choice1"><?= $data[1]['ways'][$w][$i]['choice']['choice1'] ?></a>
                            <a href="/?action=choice2"><?= $data[1]['ways'][$w][$i]['choice']['choice2'] ?></a>
                        </div>
                    <?php endif; ?>
                <?php }
                else { ?>
                    <a href="/" class="dark-background"></a>
                    <div class="character">
                        <img src="<?= "./assets/img/" . $data[1]['ways'][$w][$i]['item'][$_GET['index']]['name'] . ".png" ?>">
                    </div>
                    <div class="character-text">
                        <h2><?=  ucfirst($data[1]['ways'][$w][$i]['item'][$_GET['index']]['name']) ?></h2>
                        <p><?= $data[1]['ways'][$w][$i]['item'][$_GET['index']]['text'] ?></p>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </main>
</body>
</html>