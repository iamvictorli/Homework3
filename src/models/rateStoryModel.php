<?php

namespace VictorLi\hw3\models;

class rateStoryModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['arg1'];
        $UserRating = $data['arg2'];

        if($connection) {
            $query = "UPDATE Story
                      SET Sum_Of_Ratings_So_Far = Sum_Of_Ratings_So_Far+" . intval($UserRating) . ",
                      Number_Of_Ratings_So_Far = Number_Of_Ratings_So_Far+" . intval(1) . "
                      WHERE Identifier='" . $Identifier . "'";
        }

        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
