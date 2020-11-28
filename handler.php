<?php

if (!isset($_POST["name"]) || !isset($_POST["category"])) {
    echo "error";
    die;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=testtask", 'root', 'root');
} catch (PDOException $e) {
    echo "error";
    die;
}

$arCategory = ['A', 'B', 'C'];

if (!in_array($_POST["category"], $arCategory)) {
    echo "error";
    die;
}

if (empty($_POST["name"]) || count($_POST["name"]) < 2) {
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








