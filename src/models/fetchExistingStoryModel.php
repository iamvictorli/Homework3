<?php

namespace VictorLi\hw3\models;

class fetchExistingStoryModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['Identifier'];

        if($connection) {
            $query = "SELECT S.Author AS Author, S.Title AS Title, C.Content AS Content
                      FROM Story S, StoryContent C
                      WHERE S.Identifier='" . $Identifier . "' AND
                      S.Identifier = C.Identifier";
        }
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
