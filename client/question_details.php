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

        <div class="col-md-5">
           
        </div>
    </div>
</div>