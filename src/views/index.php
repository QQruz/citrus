<?php require('header.php'); ?>
<div class="row">
    <?php foreach ($data['products'] as $product) : ?>
        
        <div class="col-sm-4 mt-3">
            <div class="card">
                <img src="<?=PUBLIC_PATH . 'img/products/' . $product['image']?>" class="card-img-top" alt="" style="max-height:250px;">
                <div class="card-body">
                    <h5 class="card-title"><?=$product['title']?></h5>
                    <p class="card-text"><?=$product['description']?></p>
                </div>
            </div>
        </div>
       
    <?php endforeach; ?>
</div>

<div class="my-5">
    <h4 class="mb-3">Comments:</h4>
    <ul class="list-group">
        <?php foreach ($data['comments'] as $comment) : ?>
            <li class="list-group-item">
                <a href="mailto:<?=$comment['email']?>"><strong><?=$comment['name']?>:</strong></a>
                <p><?=$comment['body']?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="my-5">
    <h4 class="mb-3">Leave a comment:</h4>
    <form class="needs-validation" novalidate action="<?=PUBLIC_PATH . 'comments'?>" method="POST">
    
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="" placeholder="Name" name="name" id="name"  required pattern=".{3,30}">
            <div class="invalid-feedback">
                Name needs to have between 3 and 30 characters
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="" placeholder="Email" name="email" id="email" required>
            <div class="invalid-feedback">
                Please enter valid email
            </div>
        </div>

        <div class="form-group">
            <label for="body">Your comment</label>
            <textarea class="form-control" value="" placeholder="Your comment" name="body" id="body" required pattern=".{3,255}"></textarea>
            <div class="invalid-feedback">
                Comment needs to have between 3 and 255 characters
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
<?php require('footer.php'); ?>