<?php

namespace VictorLi\hw3\models;

class getGenreModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");

        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = 'SELECT GenreName FROM Genre';

        $result = $connection->query($query);
        $connection->close();

        return $result;
    }
}
