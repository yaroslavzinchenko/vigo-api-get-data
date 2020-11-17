<?php

require_once('MysqlConfig.php');

$post = file_get_contents('php://input');
$post = json_decode($post);

if (!empty($post->lastTimeInVigo))
{
    $sql = "
        update LAST_TIME_IN_VIGO set LAST_TIME_IN_VIGO = '{$post->lastTimeInVigo}'
    ";

    if (mysqli_query($link, $sql) === TRUE) {
        printf("LAST_TIME_IN_VIGO updated.\n");
    }
}

# Закрываем подключение.
mysqli_close($link);