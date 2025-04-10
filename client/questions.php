<?php
include './common/db.php';

$category_result = $conn->query("SELECT * FROM category");

if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    if (isset($_GET['latest'])) {
        $query = "SELECT q.*, c.name AS category_name, u.name AS user_name
                  FROM questions q
                  JOIN category c ON q.category_id = c.id
                  JOIN users u ON q.user_id = u.id
                  WHERE c.id = $category_id
                  ORDER BY q.id DESC";
    } else {
        $query = "SELECT q.*, c.name AS category_name, u.name AS user_name
                  FROM questions q
                  JOIN category c ON q.category_id = c.id
                  JOIN users u ON q.user_id = u.id
                  WHERE c.id = $category_id
                  ORDER BY q.id ASC";
    }
} elseif (isset($_GET['latest'])) {
    $query = "SELECT q.*, c.name AS category_name, u.name AS user_name
              FROM questions q
              JOIN category c ON q.category_id = c.id
              JOIN users u ON q.user_id = u.id
              ORDER BY q.id DESC";
} else {
    $query = "SELECT q.*, c.name AS category_name, u.name AS user_name
              FROM questions q
              JOIN category c ON q.category_id = c.id
              JOIN users u ON q.user_id = u.id
              ORDER BY q.id ASC";
}
if (isset($_GET['search']) && !empty($_GET['q'])) {
    $search = $conn->real_escape_string($_GET['q']);
    $query = "SELECT q.*, c.name AS category_name, u.name AS user_name
              FROM questions q
              JOIN category c ON q.category_id = c.id
              JOIN users u ON q.user_id = u.id
              WHERE q.title LIKE '%$search%'
              ORDER BY q.id DESC";
}
$result = $conn->query($query);
?>

<div class="container mt-5">
    <div class="row">

        <div class="col-md-7">
            <h2 class="mb-5" style="color: #2B2A5B;">
                <?php
                if (isset($category_id)) {
                    echo "Questions By Category";
                } elseif (isset($_GET['latest'])) {
                    echo "Latest Questions";
                } else {
                    echo "All Questions";
                }
                ?>
            </h2>


            <?php if ($result && $result->num_rows > 0): ?>
                <?php foreach ($result as $row): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="<?= isset($_SESSION['name']['name']) ? '?id=' . $row['id'] : '#' ?>"
                                class="text-decoration-none"
                                onclick="<?= isset($_SESSION['name']['name']) ? '' : "alert('Please log in to view question details.')" ?>">
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
            <h2 class="mb-5" style="color: #2B2A5B;">Category</h2>

            <?php if ($category_result && $category_result->num_rows > 0): ?>
                <?php while ($cat = $category_result->fetch_assoc()): ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="?category_id=<?= $cat['id'] ?><?= isset($_GET['latest']) ? '&latest=true' : '' ?>" class="text-decoration-none">
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