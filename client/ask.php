<div class="container">
    <h1 class="mb-4 offset-sm-3 my-5">Ask Question</h1>

    <form method="POST" action="./server/requests.php">

        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" class="form-control" id="title" placeholder="Ask Your Question" name="title">
        </div>


        <div class="sm-3 mb-3 col-6 offset-sm-3">
            <label for="discription" class="form-label">Discription</label>
            <textarea class="form-control" id="discription" name="description" rows="3" placeholder="Describe Your Question"></textarea>
        </div>

        <?php
        include 'category.php'
        ?>

        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <button type="submit" class="btn btn-primary w-100" name="ask">Submit</button>
        </div>

    </form>
</div>