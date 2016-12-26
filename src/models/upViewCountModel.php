<?php

namespace VictorLi\hw3\models;

class upViewCountModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $Identifier = $data['arg1'];

        if($connection) {
            $query = "UPDATE Story
                      SET Views=Views+" . intval(1) .
                    " WHERE Identifier='" . $Identifier . "'";
        }

        $result = $connection->query($query);
        $connection->close();
        return $result;
    }
}
