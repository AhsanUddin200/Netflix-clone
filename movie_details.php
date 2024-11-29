<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        $movie_id = $_GET['id'];
        $result = $conn->query("SELECT * FROM movies WHERE id='$movie_id'");
        $movie = $result->fetch_assoc();
        echo '<h1>' . $movie['title'] . '</h1>';
        echo '<p>' . $movie['description'] . '</p>';
        echo '<p>Category: ' . $movie['category'] . '</p>';
        echo '<p>Release Date: ' . $movie['release_date'] . '</p>';

        // Fetch video file for the movie
        $video_result = $conn->query("SELECT * FROM uploads WHERE movie_id='$movie_id' LIMIT 1");
        $video = $video_result->fetch_assoc();
        
        echo '<video controls width="500">';
        echo '<source src="' . $video['file_path'] . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
    }
    ?>
</body>
</html>
