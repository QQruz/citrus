<?php require('header.php'); ?>

<?php if (!count($data)): ?>
<h3>No new comments to approve</h3>
<?php endif; ?>

<?php foreach ($data as $comment) : ?>
            <li class="list-group-item">
                <a href="mailto:<?=$comment['email']?>"><strong><?=$comment['name']?>:</strong></a>
                <p><?=$comment['body']?></p>

                <form method="POST" action="<?=PUBLIC_PATH . 'comments'?>">
                <?=_method('PATCH') ?>
                <input type="hidden" name="id" value="<?=$comment['id']?>">
                <button class="btn btn-primary" type="submit">Approve</button>
                </form>
                
            </li>
<?php endforeach; ?>

<?php require('footer.php'); ?>