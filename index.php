<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Subscribe Newsletter</title>
    </head>
    <body>
        <?php
        include 'db.php';

        $message = "";
        $email = "";
        $duplicate = false;

        // Submit form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check empty
            if (empty($_POST["email"])) {
                $message = "Email is required";

            } else {
                $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
                // Check format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = "Invalid email format";

                } else {
                    // Check duplicate
                    try {
                        $sql ="SELECT id, email FROM email";
                        $query = $db->prepare($sql);
                        
                        $query->execute();
                        $emails = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($emails as $row) {
                            if ($row['email'] == $email) {
                                $duplicate = true;
                            }
                        }

                        if ($duplicate) {
                            $message = "Duplicate email";

                        } else {
                            // Add email
                            try {
                                $sql = "INSERT INTO email (email) VALUES (:email)";
                                $query = $db->prepare($sql); 

                                $query->execute(array(':email' => $email));
                                $message = "Subscribe Succeed"; 

                            } catch (Exception $e) {
                                echo 'Error: ' . $e->getMessage();
                            }
                        }

                    } catch (Exception $e) {
                        echo 'Error: ' . $e->getMessage();
                    }
                }
            }
        }

        ?>

        <h2>Subscribe to our newsletter</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="email">E-mail: </label>
            <input type="email" name="email" required value="<?php echo $email;?>">
            <br />
            <br />
            <input type="submit" value="Subcribe">
            <span class="message"> <?php echo $message;?></span>
        </form>
    </body>
</html>