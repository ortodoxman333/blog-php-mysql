<?php
include "db.php";
include 'header1.php';
$query = 'SELECT * FROM posts';
$result = mysqli_query($db, $query);

?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: admin.php");
}
?>
<div>
    <h4 class="list-title">Blog posts list</h4>
</div>

<table class="posts-table">
    <colgroup>
        <col style="width:60%">
        <col style="width:30%">
        <col style="width:10%">
    </colgroup>

    <tr>
        <th>TITLE</th>
        <th>DATE</th>
        <th>ACTIONS</th>
    </tr>

    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['date']; ?></td>

            <td class="actions">
                <a href="#" class="publish2">
                    <img src="publish.png" alt="Publish" style="width:14px;height:14px;" />
                </a>

                <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="edit">
                    <img src="edit.png" alt="Edit" style="width:14px;height:14px;" />
                </a>
                <a onclick="confirmDelete(<?php echo $row['id']; ?>)" class="delete" style="cursor: pointer;">
                    <img src="delete.png" alt="Delete" style="width:10px;height:13px;" />
                </a>
            </td>
        </tr>
    <?php  }
    ?>

</table>

<?php if (isset($_SESSION['message'])) : ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<script>
    function confirmDelete(id) {
        const shouldDelete = confirm('Do you want to delete?');

        if (shouldDelete) {
            window.location = `server.php?del=${id}`;
        }
    }
</script>