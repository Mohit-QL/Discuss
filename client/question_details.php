<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php?login=true");
    exit();
}
include './common/db.php';

$question_id = $_GET['id'] ?? null;

if (!$question_id) {
    echo "<div class='container mt-5'><p class='alert alert-warning'>Invalid question ID.</p></div>";
    exit;
}

$stmt = $conn->prepare("SELECT q.*, c.name as category_name, u.name as user_name 
                        FROM questions q 
                        JOIN category c ON q.category_id = c.id 
                        JOIN users u ON q.user_id = u.id 
                        WHERE q.id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();
$question = $result->fetch_assoc();

if (!$question) {
    echo "<div class='container mt-5'><p class='alert alert-danger'>Question not found.</p></div>";
    exit;
}
?>

<div class="container">
    <h2 class="text-center my-5" style="color: #2B2A5B;">
        Question Details
    </h2>
</div>
<div class="container">

    <div class="row">
        <div class="col-md-7  my-4">
            <div class="mb-4">
                <h4 class=" text-primary mb-2">Question: <?= htmlspecialchars($question['title']) ?></h4>
                <p class="mb-2"><?= nl2br(htmlspecialchars($question['discription'])) ?></p>
            </div>

            <?php include 'client/answers.php' ?>

            <div>
                <h5 class="mb-3 mt-4" style="color: #2B2A5B;">Submit Your Answer</h5>
                <form action="./server/requests.php" method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="answer" rows="3" placeholder="Write your answer here..." required></textarea>
                    </div>
                    <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="submit_answer">Submit Your Answer</button>
                </form>
            </div>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-4">
            <h5 class="my-4" style="color: #2B2A5B;">Related Questions For :- <?= ucfirst($question['category_name']) ?></h5>

            <?php
            $related_stmt = $conn->prepare("SELECT id, title FROM questions WHERE category_id = ? AND id != ?");
            $related_stmt->bind_param("ii", $question['category_id'], $question['id']);
            $related_stmt->execute();
            $related_result = $related_stmt->get_result();

            if ($related_result && $related_result->num_rows > 0):
                while ($related = $related_result->fetch_assoc()):
            ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <a href="?id=<?= $related['id'] ?>" class="text-decoration-none">
                                <h6 class="card-title text-primary mb-0"><?= htmlspecialchars($related['title']) ?></h6>
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
            else:
                ?>
                <p class="text-muted">No related questions found in <?= ucfirst($question['category_name']) ?> category.</p>
            <?php endif; ?>
        </div>
    </div>
</div>