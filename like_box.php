<?php foreach($likes as $key => $like): ?>
<?php  $user = User::getUser($like->userId) ?>
<li class="like_holder_li" id="<?php echo $like->likes_id; ?>">
	<h3 class="username_field">
		<?php echo $user->username; ?>
	</h3>
</li>
<?php endforeach; ?>