<?php

namespace VictorLi\hw3\models;

class getStoryModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['arg1'];

        if($connection) {
            $query = "SELECT S.Author AS Author, S.Title AS Title, C.Content AS Content,
                            IF(S.Number_Of_Ratings_So_Far=0 AND S.Sum_Of_Ratings_So_Far=0,
                                0, S.Sum_Of_Ratings_So_Far/S.Number_Of_Ratings_So_Far) AS AverageRating
                        FROM Story S, StoryContent C
                        WHERE S.Identifier='" . $Identifier . "' AND " .
                        "C.Identifier='" . $Identifier . "'";
        }
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
