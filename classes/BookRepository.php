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
    public function find(): array
    {

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
    

    public function update(): void
    {

    }

    public function delete(): void
    {

    }

}