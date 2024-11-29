<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('https://static1.moviewebimages.com/wordpress/wp-content/uploads/2024/08/netflix-logo.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: flex-end; /* Align buttons to the bottom */
            height: 100vh;
            margin: 0;
        }

        /* Footer for buttons */
        .footer {
            width: 100%;
            text-align: center;
            padding: 20px 0;
        }

        .btn {
            background-color: #800000;
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin: 10px;
      
        }

        .btn:hover {
            background-color: #f8b400;
        }
    </style>
</head>
<body>

    <!-- Footer for buttons -->
    <div class="footer">
        <a href="signup.php"><button class="btn">Signup</button></a>
        <a href="login.php"><button class="btn">Login</button></a>
    </div>

</body>
</html>
