<div class="container">
    <h1 class="mb-4 offset-sm-3 my-5">Sign UP</h1>

    <form method="POST" action="./server/requests.php">
        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Your User Name" name="name">
        </div>
        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email">
        </div>
        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password">
        </div>
        <div class="sm-3 col-6 mb-3 offset-sm-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter Your Address" name="address">
        </div>
      
        <button type="submit" class="btn btn-primary sm-3 col-6 mb-3 offset-sm-3" name="signup">Sign Up</button>
    </form>
</div>