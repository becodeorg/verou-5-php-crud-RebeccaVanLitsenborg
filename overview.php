<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Track your collection of Books</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

<h1>Track your collection of Books</h1>

<ul>
    <?php 
        if (isset($books) && is_array($books)) {
            foreach ($books as $book) :
    ?>
            <li><?= $book['title']?> | 
                <?= $book['author']?> | 
                <?= $book['genre']?> | 
                <a href="edit.php?id=<?= $book['id'];  ?>" class="edit-link">Edit</a> | 
                <a href="delete.php?id=<?= $book['id']; ?>" class="delete-link">Delete</a>
            </li>
    <?php 
            endforeach;
        } else {
            echo "<li>No books available</li>";
        }
    ?>
</ul>

<!-- Add a new book -->
<form action="?action=create" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" required><br>

    <label for="author">Author:</label>
    <input type="text" name="author" required><br>

    <label for="genre">Genre:</label>
    <input type="text" name="genre" required><br>

    <input type="submit" value="Add Book">
</form>

</body>
</html>