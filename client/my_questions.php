<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './common/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php?login_required=true");
    exit();
}

$user_id = $_SESSION['id'];

$category_result = $conn->query("SELECT * FROM category");

if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $query = "SELECT q.*, c.name as category_name, u.name as user_name
              FROM questions q
              JOIN category c ON q.category_id = c.id
              JOIN users u ON q.user_id = u.id
              WHERE q.user_id = $user_id AND c.id = $category_id
              ORDER BY q.id DESC";
} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $check = $conn->query("SELECT id FROM questions WHERE id = $delete_id AND user_id = $user_id");

    if ($check && $check->num_rows > 0) {
        $conn->query("DELETE FROM questions WHERE id = $delete_id");
        header("Location: index.php?myquestions=true&deleted=true");
        exit();
    }
} else {
    $query = "SELECT q.*, c.name as category_name, u.name as user_name
              FROM questions q
              JOIN category c ON q.category_id = c.id
              JOIN users u ON q.user_id = u.id
              WHERE q.user_id = $user_id
              ORDER BY q.id DESC";
}

$result = $conn->query($query);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h2 class="mb-5" style="color: #2B2A5B;">
                <?= isset($category_id) ? "My Questions in Selected Category" : "All My Questions" ?>
            </h2>

            <?php if ($result && $result->num_rows > 0): ?>
                <?php foreach ($result as $row): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="?id=<?= $row['id'] ?>" class="text-decoration-none">
                                <h5 class="card-title text-primary mb-0"><?= htmlspecialchars($row['title']) ?></h5>
                            </a>

                            <a href="?myquestions=true&delete=<?= $row['id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this question?');"
                                class="text-danger ms-3"
                                title="Delete Question">
                                <i class="fa-solid fa-trash text-primary" style="cursor: pointer;"></i>
                            </a>


                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-primary text-center">No questions found.</div>
            <?php endif; ?>

            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success" id="deleteAlert">Question deleted successfully.</div>
                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('deleteAlert');
                        if (alert) {
                            alert.style.display = 'none';
                        }
                    }, 2000); 
                </script>
            <?php endif; ?>


        </div>

        <div class="col-1"></div>

        <div class="col-md-4">
            <h2 class="mb-5" style="color: #2B2A5B;">Category</h2>

            <?php if ($category_result && $category_result->num_rows > 0): ?>
                <?php while ($cat = $category_result->fetch_assoc()): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="index.php?myquestions=true&category_id=<?= $cat['id'] ?>" class="text-decoration-none">
                                <h5 class="card-title text-primary mb-0"><?= ucfirst($cat['name']) ?></h5>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>

            <?php else: ?>
                <div class="card-body">
                    <p class="text-muted mb-0">No categories found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>