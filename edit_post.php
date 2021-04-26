<?php
include 'header1.php';
include 'db.php';
include('server.php');

if (!isset($_SESSION['username'])) {
    header("location: admin.php");
}

$id = $_GET['id'];

if (!isset($id['id'])) {
    header("location: add_post.php");
}

$result = mysqli_query($db, "SELECT * FROM posts WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
    $title = $res['title'];
    $content = $res['content'];
    $date = $res['date'];
    $imageURL = $res['imageURL'];
}

?>

<!DOCTYPE html>
<html>
<div>
    <h4 class="page-title">New Blog Post</h4>
</div>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <form method="post" action="server.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div>
            <label class="post-title">Title</label>
            <input class="title-input" type="text" name="title" value="<?php echo $title; ?>">
        </div>
        <div>
            <label class="content-title">Content</label>
            <textarea class="content-area" type="text-area" name="content"><?php echo htmlspecialchars($content); ?></textarea>
        </div>
        <div>
            <label class="date-title">Date</label>
            <?php
            $newDate = date("Y-m-d", strtotime($date)); ?>
            <input class="date-input" type="date" name="date" value="<?php echo $newDate; ?>">
        </div>
        <div>
            <label class="image-title">Featured Image</label>
            <img id="preview-image" class="img-place" name="imageurl" src="image.png" alt="javascript.png" width="234" height="168" />

            <label for="file-input">
                <input class="img-placee" id="file-input" style="display: none;" type="file" name="imagefile" onchange="document.getElementById('preview-image').
 src = window.URL.createObjectURL(this.files[0])">
                <a class="publish" style="cursor: pointer;">Select Image</a>
            </label>

            <a id="remove-image" class="publish1" style="cursor: pointer;">Remove Image</a>

        </div>

        <div>
            <button onclick="document.location='post.php'" type="button" class="btn_cancel" name="cancel_button">Cancel</button>
        </div>
        <div>
            <button type="submit" class="btn_publish" name="update">
                <img src="edit_white.png" />
                <span>Update Post</span>
            </button>
        </div>

    </form>
</body>
<script>
    const removeImageEl = document.getElementById('remove-image');
    const previewImageEl = document.getElementById('preview-image');

    function onClick(e) {
        previewImageEl.setAttribute('src', 'image.png');
    }

    removeImageEl.addEventListener('click', onClick);
</script>

</html>