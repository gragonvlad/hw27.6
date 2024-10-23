<div class="container mt-5">
	<div class="row">
		<? if ($_COOKIE['user'] == '') : ?>
			<div class="col-3">
				<div class="h2">Регистрация</div>
				<form method="post">
					<input type="text" name="login" placeholder="Логин" class="form-control mb-2">
					<input type="password" name="pass" placeholder="Пароль" class="form-control mb-2">
					<input type="submit" name="register" value="Зарегистрироваться" class="btn btn-success mb-2">
				</form>
			</div>
			<div class="col-3">
				<div class="h2">Вход</div>
				<form method="post">
					<input type="text" name="login" placeholder="Логин" class="form-control mb-2">
					<input type="password" name="pass" placeholder="Пароль" class="form-control mb-2">
					<input type="hidden" name="token" value="<?=$data['token']?>" style="display:none;">
					<input type="submit" name="authorize" value="Войти" class="btn btn-success mb-2">
				</form>
			</div>
	</div>
	<div class="row mt-4">
		<div class="col-4">				
			<form method="post">
				<input type="hidden" name="token" value="<?=$data['token']?>" style="display:none;">
				<input type="submit" name="authorizeVK" value="Авторизация через ВК" class="btn btn-success mb-2">
			</form>
		</div>
	</div>
<? else : ?>
	<div class="row">
		<div class="col-2">
			<a class='btn btn-primary' href="/exit.php">Выйти</a>
		</div>
	</div>
<? endif; ?>
</div>
