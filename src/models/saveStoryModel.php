<?php

namespace VictorLi\hw3\models;

class saveStoryModel extends Model {
    public function doQuery($data = []) {
        require_once("./src/configs/Config.php");
        $connection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        $query = '';
        $result = false;

        if($connection) {
            date_default_timezone_set('America/Los_Angeles');
            $date = date('Y-m-d H:i:s');
            $query = "INSERT INTO Story(Identifier, Author, Title, SubmissionDate) VALUES
                        ('" . $data['Identifier'] . "', '" . $data['Author'] . "', '" . $data['Title'] . "', '" . $date . "')";

            $result = $connection->query($query);

            $query = "INSERT INTO StoryContent(Identifier, Content) VALUES
                        ('" . $data['Identifier'] . "', '" . $data['Content'] . "')";
            $result = $connection->query($query);

            foreach($data['genremultiselect'] as $genrename) {
                $query = "SELECT GenreID
                            FROM Genre
                            WHERE GenreName='" . $genrename . "'";

                $resultQuery = $connection->query($query);
                $GenreID = $resultQuery->fetch_assoc();

                $query = "INSERT INTO StoryGenre(Identifier, GenreID) VALUES
                            ('" . $data['Identifier'] . "', " . intval($GenreID['GenreID']) . ")";
                $success = $connection->query($query);
            }
        }

        $connection->close();
        return $result;
    }
}
