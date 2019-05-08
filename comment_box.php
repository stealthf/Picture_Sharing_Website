<?php foreach($comments as $key => $comment): ?>
<?php  $user = User::getUser($comment->uid) ?>
<li class="comment_holder_li" id="<?php echo $comment->cid; ?>">
	<h3 class="username_field">
		<?php echo $user->username; ?>
	</h3>
	<div class="comment_text">
		<?php echo $comment->content; ?>
	</div>
	<div class="comment_time">
	<?php echo $comment->time; ?> 
	</div>
	<?php if($userId == $comment->uid): ?>
	<div class="comment_button_holder">
	<ul>
		<li id="<?php echo $comment->cid; ?>" class="delete_button">X</li>
	</ul>
	</div>
<?php endif; ?>
</li>
<?php endforeach; ?>