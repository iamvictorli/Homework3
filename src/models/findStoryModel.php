<?php

namespace VictorLi\hw3\models;

class findStoryModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['Identifier'];
        if($connection) {
            $query = "SELECT Identifier
                      FROM Story
                      WHERE Identifier='" . $Identifier . "'";

        }
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
