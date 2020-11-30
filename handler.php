<?php

if (!isset($_POST["name"]) || !isset($_POST["category"])) {
    echo "error";
    die;
}


try {
    $pdo = new PDO("mysql:host=localhost;dbname=testTask", 'root', 'root');
} catch (PDOException $e) {
    echo "error";
    die;
}

$arCategory = ['A', 'B', 'C'];

if (!in_array($_POST["category"], $arCategory)) {
    echo "error";
    die;
}

if (empty($_POST["name"]) || strlen($_POST["name"]) < 2) {
    echo "error";
    die;
}

$preparedStatement = $pdo->prepare("INSERT INTO `client_record` (`username`, `category`) VALUES (:name, :category);");

$count = $preparedStatement->execute([
    ':name' => $_POST["name"],
    ':category' => $_POST["category"]
]);

if ($count) {
    echo "success";
} else {
    echo "error";
}
die;



/*
 * CREATE TABLE `client_record` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
    `category` ENUM('A','B','C'),
    `username` VARCHAR(50),
    `datecreate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 * */




