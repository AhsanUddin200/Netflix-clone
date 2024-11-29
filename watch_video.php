<?php
// Include database connection
include 'db.php';

// Get the video ID from the URL
$video_id = $_GET['id'];

// Query to fetch the video details from the database
$query = "SELECT * FROM netflix_uploads WHERE id = $video_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Get video details
    $row = $result->fetch_assoc();
    $video_file = $row['video_file'];  // Path to the video
    $video_title = $row['title'];      // Video title
} else {
    echo "Video not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Video</title>
    <style>
        /* General body styles */
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://as2.ftcdn.net/v2/jpg/03/95/62/61/1000_F_395626122_nMED2txPGXVOTGfiLfmNLBDf5Au8eisI.jpg');
            background-size: cover;
            background-position: center;
            color: #fff; /* White text color for contrast */
            margin: 0;
            padding: 0;
        }

        /* Container for the page content */
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 50px;
            text-align: center;
            background: rgba(0, 0, 0, 0.6); /* Dark background for contrast */
            border-radius: 10px;
            padding: 30px;
        }

        /* Title styling */
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #fff;
        }

        /* Video player styling */
        .video-container {
            max-width: 100%;
            margin-bottom: 20px;
        }

        video {
            width: 100%;
            height: auto;
            max-width: 800px;
            border-radius: 10px;
        }

        /* Optional: Play button or other features below video */
        .video-info {
            margin-top: 20px;
            font-size: 18px;
            color: #fff;
        }

        /* Optional styling for footer if required */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1><?php echo $video_title; ?></h1>
        <div class="video-container">
            <video controls>
                <source src="<?php echo $video_file; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-info">
            <p>Enjoy the movie! Let us know your thoughts.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>

</body>
</html>
