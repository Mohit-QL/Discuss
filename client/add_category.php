<?php


if (!isset($_SESSION['id'])) {
    header("Location: index.php?login=true");
    exit();
}
?>
<div class="container">
    <h2 class="mb-4 offset-sm-3 my-5" style="color: #2B2A5B;">Add New Category</h2>
    <form method="POST" action="./server/requests.php">

        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>


        <button type="submit" class="btn btn-primary sm-3 col-6 mb-3 offset-sm-3" name="category">Add Category</button>
    </form>
</div>