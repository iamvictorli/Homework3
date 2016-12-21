<?php
//when this script runs, it creates a database along with tables and data inserted into tables
namespace VictorLi\hw3\configs;

require_once("Config.php");
$connection = mysqli_connect(HOST, USERNAME, PASSWORD);
$query = "CREATE DATABASE " . DB_NAME;
$connection->query($query);

//if there happens to be an error connecting to database or creating a database
//make sure specified DB_NAME does not exist, or else delete it
if($connection->connect_error) {
    echo("Error connecting/creating database");
    exit;
} else { // when connected and creating database is successful
    mysqli_select_db($connection, DB_NAME); //select specified DB_NAME

    $CREATE_TABLE_STATEMENT = 'CREATE TABLE Story (
        Identifier VARCHAR(20) NOT NULL,
        Author VARCHAR(35),
        Title VARCHAR(75),
        Sum_Of_Ratings_So_Far INT DEFAULT 0,
        Number_Of_Ratings_So_Far INT DEFAULT 0,
        Views INT DEFAULT 0,
        SubmissionDate DateTime,
        PRIMARY KEY(Identifier)
    )';
    $connection->query($CREATE_TABLE_STATEMENT);

    $CREATE_TABLE_STATEMENT = 'CREATE TABLE Genre(
        GenreID INT NOT NULL AUTO_INCREMENT,
        GenreName VARCHAR(20),
        PRIMARY KEY(GenreID)
    )';
    $connection->query($CREATE_TABLE_STATEMENT);

    $CREATE_TABLE_STATEMENT = 'CREATE TABLE StoryGenre(
        Identifier VARCHAR(20) NOT NULL,
        GenreID INT NOT NULL,
        PRIMARY KEY(Identifier, GenreID),
        FOREIGN KEY(Identifier) REFERENCES Story(Identifier)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        FOREIGN KEY(GenreID) REFERENCES Genre(GenreID)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    )';
    $connection->query($CREATE_TABLE_STATEMENT);

    $CREATE_TABLE_STATEMENT = 'CREATE TABLE StoryContent(
        Identifier VARCHAR(20) NOT NULL,
        Content VARCHAR(5000),
        PRIMARY KEY(Identifier),
        FOREIGN KEY(Identifier) REFERENCES Story(Identifier)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    )';
    $connection->query($CREATE_TABLE_STATEMENT);

    $query = "INSERT INTO Genre(GenreName)
        VALUES
            ('Fiction'), ('Non-Fiction'), ('Comedy'), ('Horror'),
            ('Drama'), ('Romance'), ('Action'), ('Satire')
    ";
    $connection->query($query);

    $query = "INSERT INTO Story
        VALUES
        ('magic', 'J.K Rowling', 'Harry Potter and The Philsopher''s Stone', 20, 5 ,6, '1997-6-26 01:12:00'),
        ('whale', 'Herman Melville', 'Moby Dick', 15, 3, 7, '1851-11-14 01:01:01')
    ";
    $connection->query($query);

    $query = "INSERT INTO StoryContent
        VALUES ('magic', 'Mr. and Mrs. Dursley, of number four, Privet Drive, were proud to say that they were perfectly normal thank you very much')";
    $connection->query($query);

    $query = "INSERT INTO StoryContent
        VALUES ('whale', 'Call me Ishmael. Some years ago--never mind how long precisely')";
    $connection->query($query);

    $query = "INSERT INTO StoryGenre
        VALUES ('magic', 1)";
    $connection->query($query);

    $query = "INSERT INTO StoryGenre
        VALUES ('magic', 7)";
    $connection->query($query);

    $query = "INSERT INTO StoryGenre
        VALUES ('whale', 1)";
    $connection->query($query);

    $query = "INSERT INTO StoryGenre
        VALUES ('whale', 4)";
    $connection->query($query);
    
    $connection->close();
}
