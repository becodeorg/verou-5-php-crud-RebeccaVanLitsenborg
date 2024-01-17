<?php
require_once 'config.php';
require_once 'classes/DatabaseManager.php';
require_once 'classes/BookRepository.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

$bookRepository = new BookRepository($databaseManager);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Book</h1>

<?php
$bookId = $_GET['id'] ?? null;
$bookDetails = $bookRepository->edit((int)$bookId);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';

    if (!empty($title) && !empty($author) && !empty($genre)) {
        $bookRepository->update((int)$bookId, $title, $author, $genre);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: All fields are required.";
    }
}
?>

<!-- Form to edit the book -->
<form action="?action=update&id=<?= $bookDetails['id'] ?>" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?= $bookDetails['title'] ?>" required><br>

    <label for="author">Author:</label>
    <input type="text" name="author" value="<?= $bookDetails['author'] ?>" required><br>

    <label for="genre">Genre:</label>
    <input type="text" name="genre" value="<?= $bookDetails['genre'] ?>" required><br>

    <input type="submit" value="Update Book">
</form>

</body>
</html>