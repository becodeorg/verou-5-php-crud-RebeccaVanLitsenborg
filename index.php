<?php

// Require the correct variable type to be used (no auto-converting)
declare (strict_types = 1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Load you classes
require_once 'config.php';
require_once 'classes/DatabaseManager.php';
require_once 'classes/BookRepository.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

// Update the naming if you'd like to work with another collection
$bookRepository = new BookRepository($databaseManager);
$books = $bookRepository->get();

// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;


// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
switch ($action) {
    case 'create':
        create($bookRepository);
        break;
    case 'update':
        update($bookRepository);
        break;
    default:
        overview($books);
        break;
}

function overview($books)
{
    // Load your view
    // Tip: you can load this dynamically and based on a variable, if you want to load another view
    require 'overview.php';
}


function create(BookRepository $bookRepository): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $genre = $_POST['genre'] ?? '';

        if (!empty($title) && !empty($author) && !empty($genre)) {
            $bookRepository->create($title, $author, $genre);
            header("Location: index.php");
            exit();
        } else {
            echo "Error: All fields are required.";
        }
    }
}
