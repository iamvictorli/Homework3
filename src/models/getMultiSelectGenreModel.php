<?php

namespace VictorLi\hw3\models;

class getMultiSelectGenreModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['Identifier'];

        if($connection) {
            $query = "SELECT G.GenreName AS GenreName
                      FROM Genre G, StoryGenre S
                      WHERE G.GenreID=S.GenreID AND
                      S.Identifier='" . $Identifier . "'";
        }

        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
