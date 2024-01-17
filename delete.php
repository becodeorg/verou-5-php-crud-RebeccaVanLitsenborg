<?php
require_once 'config.php';
require_once 'classes/DatabaseManager.php';
require_once 'classes/BookRepository.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

$bookRepository = new BookRepository($databaseManager);

$bookId = $_GET['id'] ?? null;

if ($bookId !== null) {
    $bookRepository->delete((int)$bookId);
    header("Location: index.php");
    exit();
} else {
    echo "Error: Book ID not provided.";
}

function delete(BookRepository $bookRepository): void
{
    $id = $_GET['id'] ?? null;

    if ($id) {
        $bookRepository->delete((int)$id);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Book ID not provided.";
    }
}
?>