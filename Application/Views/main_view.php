<?php if ($data['isauth']):?>
<div class="row">
	<div class="col-6">
		<img src="/images/stock-photo-rear-view-of-hiker-approaching-scenic-viewpoint-washington-usa-2432687911.jpg" alt="" class="img-fluid">
	</div>
	<?php if ($data['role'] == 2): ?>
	<div class="col-6">Текст, который видят только пользователи ВК.</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<div class="row mt-5">
	<div class="col-3">
		<?php if ($data['isauth']):?>
		<a class='btn btn-primary' href="/?url=auth&action=logout">Выйти</a>
		<?php else: ?>
		<a class='btn btn-primary' href="/?url=auth">Войти</a>
		<?php endif; ?>
	</div>
</div>