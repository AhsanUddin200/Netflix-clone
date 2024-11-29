<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('https://i.pinimg.com/736x/19/8b/2f/198b2f01e73b905772279616eccc7c65.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Light translucent background */
            backdrop-filter: blur(10px); /* Optional: Blur background behind the card */
        }

        .image-header {
            background-image: url('https://wallpapercat.com/w/full/c/8/7/116411-3840x2160-desktop-4k-netflix-wallpaper-photo.jpg');
            background-size: cover;
            background-position: center;
            height: 150px;
            border-radius: 20px 20px 0 0;
        }

        .container h2 {
            font-size: 28px;
            margin-top: 20px;
            font-weight: 600;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 6px;
            text-align: left;
            display: block;
        }

        input {
            width: 100%;
            padding: 15px;
            margin: 12px 0;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
            color: #333;
        }

        input:focus {
            border-color: #f8b400;
            background-color: #fff;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background-color: #000000; /* Black button */
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #333;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="image-header"></div>
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button class="btn" type="submit" name="submit">Login</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if user exists
        $result = $conn->query("SELECT * FROM netflix_user WHERE email='$email'");
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Redirect to homepage.php after successful login
                header('Location: homepage.php');
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with this email!";
        }
    }
    ?>
</body>
</html>
