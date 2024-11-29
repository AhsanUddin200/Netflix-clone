<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        /* Add the background image to the body */
        body { 
            font-family: Arial, sans-serif; 
            background: url('https://cdn.mos.cms.futurecdn.net/rDJegQJaCyGaYysj2g5XWY-320-80.jpg') no-repeat center center fixed; 
            background-size: cover;
            color: white; /* Text color to stand out against the background */
            padding: 20px;
        }

        /* New CSS for the top left image */
        .top-left-image {
            position: absolute; /* Position it absolutely */
            top: 20px; /* Adjust as needed */
            left: 20px; /* Adjust as needed */
            width: 100px; /* Set width as needed */
            height: auto; /* Maintain aspect ratio */
            z-index: 10; /* Ensure it appears above other content */
        }

        h1 { text-align: center; }
        .section-title { font-size: 24px; margin-bottom: 10px; color: #fff; }
        h4 { text-align: center; }
        .section-title { font-size: 24px; margin-bottom: 10px; color: #fff; }

        /* Grid layout for displaying movies */
        .movie-grid { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 20px; 
            justify-items: center; 
            margin-bottom: 50px;
        }

        .movie-item { 
            width: 100%; 
            text-align: center; 
            border-radius: 15px; /* Slightly rounded corners for a smoother look */
            background: #000; /* Black background */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15); /* Soft shadow for depth */
            overflow: hidden; 
            height: 400px; /* Adjusted card height for better spacing */
            display: flex;
            flex-direction: column; /* Stack content vertically */
            justify-content: space-between; /* Space out the content */
            transition: all 0.3s ease; /* Smooth hover effect */
        }

        .movie-item:hover {
            transform: translateY(-10px); /* Slightly raise the card on hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* Add more shadow on hover */
        }

        .movie-thumbnail { 
            width: 100%; 
            height: 250px; /* Adjust height of the image */
            object-fit: cover; /* Ensures the image fits without distortion */
            border-bottom: 3px solid #444; /* Soft border between image and text */
            border-radius: 10px 10px 0 0; /* Rounded top corners for image */
        }

        .movie-title { 
            padding: 12px 10px; 
            color: #fff; /* White text for title */
            font-size: 20px; /* Larger font size for better visibility */
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.7); /* Slight black background with transparency */
        }

        .movie-category { 
            padding: 10px 15px; /* Added padding for better spacing */
            color: #fff; /* White text for category */
            font-size: 16px; /* Adjust font size for category */
            background-color: rgba(0, 0, 0, 0.7); /* Black background with slight transparency */
            margin-bottom: 15px; /* Add space below category */
        }

        .movie-button {
            margin-top: 10px; /* Space above the button */
            padding: 12px 20px; /* Larger button padding */
            background-color: #ff6600; /* Orange button color */
            color: white; /* White text on the button */
            border: none; 
            border-radius: 5px; /* Rounded corners for the button */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease; /* Smooth color transition */
        }

        .movie-button:hover {
            background-color: #e65c00; /* Darker orange on hover */
        }

        .watch-btn { 
            background-color: #f8b400; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
            text-decoration: none; 
        }

        .watch-btn:hover { 
            background-color: #e69500; 
        }

        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 50px;
        }

        .upload-btn {
            padding: 12px 20px; /* Button padding */
            background-color: #007bff; /* Blue button color */
            color: white; /* White text on the button */
            border: none; 
            border-radius: 5px; /* Rounded corners for the button */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease; /* Smooth color transition */
        }

        .upload-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <img src="https://t3.ftcdn.net/jpg/04/81/76/22/360_F_481762281_Xcvl3QsGh1pBMvQuyKIoIqq8aYksXEwX.jpg" class="top-left-image" alt="Top Left Image">
    <h1>Unlimited movies, TV shows, and more</h1>
    <h4>Starts at Rs 250. Cancel anytime.</h4>

    <!-- Trending Now Section -->
    <div class="section-title">Trending Now</div>
    <div class="movie-grid">
        <?php
        // Query to get the latest 5 videos
        $query = "SELECT * FROM netflix_uploads ORDER BY id DESC LIMIT 4";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $video_id = $row['id'];
                $video_title = $row['title'];
                $video_thumbnail = $row['thumbnail'];
                $video_category = $row['category'];
                $video_file = $row['video_file'];
                echo "<div class='movie-item'>
                        <img src='$video_thumbnail' class='movie-thumbnail' alt='$video_title'>
                        <div class='movie-details'>
                            <div class='movie-title'>$video_title</div>
                            <div class='movie-category'>$video_category</div>
                            <a href='watch_video.php?id=$video_id' class='watch-btn'>Watch Now</a>
                        </div>
                    </div>";
            }
        } else {
            echo "No videos found!";
        }
        ?>
    </div>

    <!-- New Releases Section -->
    <div class="section-title">New Releases</div>
    <div class="movie-grid">
        <?php
        // Query to get the rest of the videos (excluding the top 5)
        $query = "SELECT * FROM netflix_uploads ORDER BY id DESC LIMIT 4, 9999"; // Skip first 5 for new releases
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $video_id = $row['id'];
                $video_title = $row['title'];
                $video_thumbnail = $row['thumbnail'];
                $video_category = $row['category'];
                $video_file = $row['video_file'];
                echo "<div class='movie-item'>
                        <img src='$video_thumbnail' class='movie-thumbnail' alt='$video_title'>
                        <div class='movie-details'>
                            <div class='movie-title'>$video_title</div>
                            <div class='movie-category'>$video_category</div>
                            <a href='watch_video.php?id=$video_id' class='watch-btn'>Watch Now</a>
                        </div>
                    </div>";
            }
        } else {
            echo "No new releases found!";
        }
        ?>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <a href="upload_video.php" class="upload-btn">Upload Video</a>
    </div>

</body>
</html>
