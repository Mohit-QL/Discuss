<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include './common/db.php';

$category_result = $conn->query("SELECT * FROM category");

// Get only latest questions
$query = "SELECT q.*, c.name as category_name, u.name as user_name
          FROM questions q
          JOIN category c ON q.category_id = c.id
          JOIN users u ON q.user_id = u.id
          ORDER BY q.id DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Latest Questions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row">

            <!-- Questions Section -->
            <div class="col-md-7">
                <h2 class="mb-5" style="color: #2B2A5B;">Latest Questions</h2>

                <?php if ($result && $result->num_rows > 0): ?>
                    <?php foreach ($result as $row): ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <a href="<?= isset($_SESSION['id']) ? 'question_detail.php?id=' . $row['id'] : '#' ?>"
                                    class="text-decoration-none"
                                    onclick="<?= isset($_SESSION['id']) ? '' : "alert('Please log in to view question details.')" ?>">
                                    <h5 class="card-title text-primary mb-0"><?= htmlspecialchars($row['title']) ?></h5>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-primary text-center">No questions found.</div>
                <?php endif; ?>
            </div>

            <div class="col-1"></div>

            <div class="col-md-4">
                <h2 class="mb-5" style="color: #2B2A5B;">Categories</h2>

                <?php if ($category_result && $category_result->num_rows > 0): ?>
                    <?php while ($cat = $category_result->fetch_assoc()): ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <a href="index.php?latest=true&?category_id=<?= $cat['id'] ?>" class="text-decoration-none">
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

</body>

</html>