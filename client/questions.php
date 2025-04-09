<?php
include './common/db.php';

$query = "SELECT q.*, c.name as category_name, u.name as user_name
FROM questions q
JOIN category c ON q.category_id = c.id
JOIN users u ON q.user_id = u.id
ORDER BY q.id DESC";

$category_result = $conn->query("SELECT * FROM category");

$result = $conn->query($query);
?>

<div class="container mt-5">
   
    <div class="row">

        <div class="col-md-7">
        <h2 class="mb-5 " style="color: #2B2A5B;">All Questions</h2>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php foreach ($result as $row): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="?id=<?= $row['id'] ?>" class="text-decoration-none">
                                <h5 class="card-title text-primary mb-0"><?= htmlspecialchars($row['title']) ?></h5>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center">No questions found.</div>
            <?php endif; ?>
        </div>


        <div class="col-1"></div>

        <div class="col-md-4">
        <h2 class="mb-5" style="color: #2B2A5B;">Category</h2>

            <?php if ($category_result && $category_result->num_rows > 0): ?>
                <?php while ($cat = $category_result->fetch_assoc()): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="?category_id=<?= $cat['id'] ?>" class="text-decoration-none">
                                <h5 class="card-title text-primary mb-0"><?= htmlspecialchars($cat['name']) ?></h5>
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