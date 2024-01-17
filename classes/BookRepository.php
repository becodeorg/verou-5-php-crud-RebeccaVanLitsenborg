<?php

// This class is focussed on dealing with queries for one type of data
// That allows for easier re-using and it's rather easy to find all your queries
// This technique is called the repository pattern
class BookRepository
{
    private DatabaseManager $databaseManager;

    // This class needs a database connection to function
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

    // Get one
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

    // Get all
    public function get(): array
    
        // TODO: Create an SQL query
        // TODO: Use your database connection (see $databaseManager) and send your query to your database.
        // TODO: fetch your data at the end of that action.
        // TODO: replace dummy data by real one
        
            // Your SQL query to retrieve data from the database
            {
                try {
                    $query = "SELECT * FROM favorites";
                    $statement = $this->databaseManager->connection->prepare($query);
                    $statement->execute();
        
                    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        
                    return $data;
                } catch (PDOException $error) {
                    // Handle any exceptions that may occur during the query execution
                    echo $error->getMessage();
                    return array();
                }
            }

        // We get the database connection first, so we can apply our queries with it
        // return $this->databaseManager->connection-> (runYourQueryHere)
    

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