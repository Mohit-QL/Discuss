<select class="sm-3 mb-3 offset-sm-3 form-select" style="width: 650px" id="category" name="category" required>
    <option value="" selected disabled>Select Category</option>
    <?php
    include './common/db.php';

    $query = "SELECT * FROM `category`";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        foreach ($result as $row) {
            $id = (int)$row['id'];
            $name = htmlspecialchars($row['name']);
            echo "<option value=\"$id\">$name</option>";
        }
    } else {
        echo "<option disabled>No categories found</option>";
    }

    ?>
</select>