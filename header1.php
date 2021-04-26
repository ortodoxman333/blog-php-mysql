<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&display=swap" rel="stylesheet">
</head>

<header class="headerr">
    <h2 class="blog-title">Blog menagment</h2>
    <div>
        <button onclick="document.location='add_post.php'" type="submit" class="new-post-btn" name="new-post-btn">
            <img src="edit_white.png" />
            <span>New Blog Post</span>
        </button>
    </div>
    <div>
        <button onclick="document.location='server.php?logout=true'" type="submit" class="logout-btn" name="logout-btn">Logout</button>
    </div>
</header>