<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>List Subscribers</title>
    </head>
    <body>
        <h2>List of subscribers</h3>

        <?php
        include 'db.php';

        // List emails
        try {
            $sql ="SELECT id, email FROM email";
            $query = $db->prepare($sql); 

            $query->execute();
            $emails = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($emails as $row) {
                echo $row['email'];
                echo "<br />";
            }

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        ?>
    </body>
</html>