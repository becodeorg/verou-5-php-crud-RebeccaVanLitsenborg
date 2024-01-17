<?php

class BookRepository
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function create(string $title, string $author, string $genre): void
    {
        try {
            $query = "INSERT INTO favorites (title, author, genre) VALUES (:title, :author, :genre)";
            $statement = $this->databaseManager->connection->prepare($query);

            $statement->bindParam(':title', $title, PDO::PARAM_STR);
            $statement->bindParam(':author', $author, PDO::PARAM_STR);
            $statement->bindParam(':genre', $genre, PDO::PARAM_STR);

            $statement->execute();
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }

    public function find(int $id): ?array
    {
        try {
            $query = "SELECT * FROM favorites WHERE id = :id";
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
    
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            return $data ? $data : null;
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
            return null;
        }
    }

    public function get(): array
    {
        try {
            $query = "SELECT * FROM favorites";
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->execute();

            $data = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return array();
        }
    }

    public function edit(int $id): ?array
    {
        try {
            $query = "SELECT * FROM favorites WHERE id = :id";
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);

            return $data ? $data : null;
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
            return null;
        }
    }

    public function update(int $id, string $title, string $author, string $genre): void
    {
        try {
            $query = "UPDATE favorites SET title = :title, author = :author, genre = :genre WHERE id = :id";
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':title', $title, PDO::PARAM_STR);
            $statement->bindParam(':author', $author, PDO::PARAM_STR);
            $statement->bindParam(':genre', $genre, PDO::PARAM_STR);

            $statement->execute();
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try {
            $query = "DELETE FROM favorites WHERE id = :id";
            $statement = $this->databaseManager->connection->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }

}