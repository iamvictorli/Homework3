<?php

namespace VictorLi\hw3\models;

class getMostViewedModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        if($connection) {
            if($data['genre'] === 'All Genres') { //if there is not filtering by genres
                $query="SELECT Identifier, Title
                        FROM Story
                        WHERE Title LIKE '%" . $data['PhraseFilter'] . "%'
                        ORDER BY Story.Views DESC
                        LIMIT 10";

            } else { //filtering by both genre and phrases
                $query = "SELECT GenreID
                            FROM Genre
                            WHERE GenreName='" . $data['genre'] . "'";
                $result = $connection->query($query);
                $gID = $result->fetch_assoc();
                $GenreID = $gID['GenreID'];

                $query = "SELECT S.Identifier AS Identifier, S.Title AS Title
                          FROM Story S, StoryGenre G
                          WHERE S.Identifier=G.Identifier AND
                            G.GenreID=" . intval($GenreID) . " AND
                            S.Title LIKE '%" . $data['PhraseFilter'] . "%'
                            ORDER BY S.Views DESC
                            LIMIT 10";
            }
        }

        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
