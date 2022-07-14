<?php 
include'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/main.css" rel="stylesheet">
    <title>Index.php</title>

    <script src="https://cdn.tiny.cloud/1/qdhagk3d3npd94r5reejhxrr4fqeua1t751wz4p7ipnw6pto/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        // selector: '#mytextarea'
        entity_encoding : "raw",
        selector: '#mytextarea',
        plugins: "table print textcolor colorpicker anchor link searchreplace media emoticons lists visualblocks preview wordcount hr contextmenu",
        mediaembed_service_url: 'SERVICE_URL',
        mediaembed_max_width: 450,
        toolbar: "save print forecolor backcolor anchor link searchreplace emoticons visualblocks preview",
      });
    </script>
</head>
<body>
    <div class="header">
        <?php
            $sql = "SELECT * from allposts";
            if ($result = mysqli_query($conn, $sql)) {
                $rowcount = mysqli_num_rows( $result );
                printf("Total posts:  %d\n", $rowcount);
            }

            $query = "SELECT * FROM allposts ORDER BY id DESC LIMIT 1";
            $query_run = mysqli_query($conn, $query);
            if(mysqli_num_rows($query_run)) {
                foreach($query_run as $row) {
                    echo "<br>Date latest post: " . $row['dateOfPost'];
                    echo "<br>Username latest post: " . $row['username'];
                }
            }
        ?>
    </div>

    <div class="padding"></div>

    <div class="messageContainer">
        <div class="messageBox">
            <?php 
            $sql = "SELECT username, dateOfPost, messages FROM allposts";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<span class='username'> Username: " . $row['username'] . "</span>"
                . "  -  "
                . "<span class='dateOfPost'> Date of post: " . $row['dateOfPost'] . "</span><br><br>"
                . "<div class='message'> Message: " . "<br>" . $row['messages'] . "</div>  <br><br>";
              }
            }
            ?>
        </div>
    </div>

    <div class="padding"></div>

    <form method="post" action="post.php">
        <label>Username: </label>           
        <input type="text" name="username" size="" maxlength="30" class="inputForm"> 
        <br><br>        
        <textarea id="mytextarea" name="mytextarea" placeholder="Message"></textarea>
        <br>
        <input type="submit" class="btn btn-beautuful-blue" name="submit" value="CREATE POST">
    </form>
</body>
</html>