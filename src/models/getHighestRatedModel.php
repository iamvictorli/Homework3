<?php

namespace VictorLi\hw3\models;

class getHighestRatedModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        if($connection) {

            if($data['genre'] === 'All Genres') { //if there is no filtering of genres
                $query = "SELECT Identifier, Title,
                            IF(Number_Of_Ratings_So_Far=0 AND Sum_Of_Ratings_So_Far=0,
                                0,Sum_Of_Ratings_So_Far/Number_Of_Ratings_So_Far) AS AVGRating
                          FROM Story
                          WHERE Title LIKE '%" . $data['PhraseFilter'] . "%'
                          ORDER BY AVGRating DESC
                          LIMIT 10";
            }
            else { //filtering by genre and phrases
                //select the genreid from chosen genre
                $query = "SELECT GenreID
                            FROM Genre
                            WHERE GenreName='" . $data['genre'] . "'";
                $result = $connection->query($query);
                $gID = $result->fetch_assoc();
                $GenreID = $gID['GenreID'];

                $query = "SELECT S.Identifier AS Identifier, S.Title AS Title,
                            IF(S.Number_Of_Ratings_So_Far=0 AND S.Sum_Of_Ratings_So_Far=0,
                                0,S.Sum_Of_Ratings_So_Far/S.Number_Of_Ratings_So_Far) AS AVGRating
                          FROM Story S, StoryGenre G
                          WHERE S.Identifier=G.Identifier AND
                            G.GenreID=" . intval($GenreID) .
                            " AND S.Title LIKE '%" . $data['PhraseFilter'] . "%'
                          ORDER BY AVGRating DESC
                          LIMIT 10";
            }
        }
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
