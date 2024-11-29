<?php 
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title = $_POST['title'];
    $category = $_POST['category'];

    // Handle the video upload
    $video_file = $_FILES['video_file']['name'];
    $video_tmp_name = $_FILES['video_file']['tmp_name'];
    $video_path = 'uploads/videos/' . $video_file;

    // Handle the thumbnail image upload
    $thumbnail_file = $_FILES['thumbnail']['name'];
    $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
    $thumbnail_path = 'uploads/thumbnails/' . $thumbnail_file;

    // Move the files to the upload directories
    move_uploaded_file($video_tmp_name, $video_path);
    move_uploaded_file($thumbnail_tmp_name, $thumbnail_path);

    // Insert video details into the database
    $query = "INSERT INTO netflix_uploads (title, category, video_file, thumbnail) 
              VALUES ('$title', '$category', '$video_path', '$thumbnail_path')";
    if ($conn->query($query)) {
        // Redirect to homepage.php after successful upload
        header("Location: homepage.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-image: url('https://www.shutterstock.com/image-photo/rzeszow-poland-18052024-netflix-lettering-260nw-2471586493.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }

        /* Heading styling */
        h1 {
            color: #f8b400;
        }

        /* Input fields styling */
        input[type="file"], input[type="text"], select {
            margin: 20px 0;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #f8b400;
            width: 80%;
            max-width: 500px;
        }

        /* Button styling */
        .btn {
            background-color: #f8b400;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        /* Button hover effect */
        .btn:hover {
            background-color: #e69500;
        }

        /* Container for the form */
        .container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <h1>Upload Your Video</h1>

    <div class="container">
        <form action="upload_video.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Enter video title" required><br>
            <input type="text" name="category" placeholder="Enter video category" required><br>
            <input type="file" name="video_file" accept="video/*" required><br>
            <input type="file" name="thumbnail" accept="image/*" required><br>
            <button type="submit" class="btn">Upload Video</button>
        </form>
    </div>

</body>
</html>
