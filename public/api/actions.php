<?php

require 'connections.php';


function getNews($connect) {
    $news = mysqli_query($connect, "SELECT * FROM `news`");
    $newsList = [];
    while($item = mysqli_fetch_assoc($news)) {
        $newsList[] = $item;
    }
    echo json_encode($newsList);
}

function getNewsById($connect, $id) {
$item = mysqli_query($connect,"SELECT * FROM `news` WHERE `id` = '$id'");
if(mysqli_num_rows($item) === 0) {
    http_response_code(404);
    $res = [
        "status" => false,
        "message" => "Not found"
    ];
    echo json_encode($res);
} else {
    $item = mysqli_fetch_assoc($item);
    echo json_encode($item);
}
}


function addNews($connect, $data) {
    $title = $data['title'];
    $content = $data['content'];
    $source = $data['source'];
    mysqli_query($connect, "INSERT INTO `news` (`id`, `title`, `content`) VALUES 
                                                     (NULL, '$title', '$content','$source')");
    http_response_code(201);
    $res = [
        "status" => true,
        "news_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}


function updateNews($connect, $id, $data) {
    $title = $data['title'];
    $content = $data['content'];
    $source = $data['source'];
    mysqli_query("UPDATE `news` SET `title`= ''$title'', `content` = '$content', `source` = '$source' WHERE `id` = '$id' ");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => 'News updated successfully'
    ];
    echo json_encode($res);
}

function deleteNews ($connect, $id) {
    mysqli_query($connect, "DELETE FROM `news` WHERE `id` = '$id' ");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "News deleted"
    ];
    echo json_encode($res);
}