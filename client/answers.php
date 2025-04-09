<h4 class="mt-5" style="color: #2B2A5B;">Answers</h4>

<?php
$query = "SELECT a.*, u.name AS user_name FROM answers a 
          JOIN users u ON a.user_id = u.id 
          WHERE question_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="accordion" id="answersAccordion">';
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $answer = htmlspecialchars($row['answer']);
        $user = htmlspecialchars($row['user_name']);
        $itemId = 'collapse' . $i;
        $headingId = 'heading' . $i;

        echo "
        <div class='accordion-item'>
            <h2 class='accordion-header' id='$headingId'>
                <button class='accordion-button ".($i !== 0 ? "collapsed" : "")."' type='button' data-bs-toggle='collapse' data-bs-target='#$itemId' aria-expanded='".($i === 0 ? "true" : "false")."' aria-controls='$itemId'>
                    Answered by: <strong class='ms-1'>$user</strong>
                </button>
            </h2>
            <div id='$itemId' class='accordion-collapse collapse ".($i === 0 ? "show" : "")."' aria-labelledby='$headingId' data-bs-parent='#answersAccordion'>
                <div class='accordion-body'>
                    $answer
                </div>
            </div>
        </div>";
        $i++;
    }
    echo '</div>';
} else {
    echo "<p class='text-muted'>No answers yet. Be the first to respond!</p>";
}
?>
