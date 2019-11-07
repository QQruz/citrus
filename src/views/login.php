<?php require('header.php'); ?>
<form class="needs-validation" novalidate action="<?=PUBLIC_PATH . 'users'?>" method="POST">
    
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="" placeholder="Name" name="name" id="name"  required pattern=".{3,30}">
            <div class="invalid-feedback">
                Name needs to have between 3 and 30 characters
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" value="" placeholder="Password" name="password" id="password" required>
            <div class="invalid-feedback">
                Please enter your password
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>

<?php require('footer.php'); ?>