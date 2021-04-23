<?php
include 'header.php';
include 'db.php';
include('server.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <h2 class="page_title">New Blog Post</h2>
    <form method="post" action="post.php">
        <div class="input-groupe">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>">
        </div>
        <div class="input-groupe">
            <label>Content</label>
            <input type="text-area" name="content" value="<?php echo $content; ?>">
        </div>
        <div class="input-groupee">
            <label>Date</label>
            <input type="date" name="date" value="<?php echo $date; ?>">
        </div>
        <div class="input-groupee">
            <label>Featured Image</label>
            <input type="image" name="image" value="<?php echo $imageURL; ?>">
        </div>
        <div class="input-groupe">
            <button type="button" class="btn_cancel" name="cancel_button">Cancel</button>
        </div>
        <div class="input-groupe">
            <button type="button" class="btn_publish" name="publish_button">Publish Post</button>
        </div>
</body>