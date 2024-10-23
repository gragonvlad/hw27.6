<?php
class Model_auth extends Model {
	private $clientId = '1111'; // ID приложения
	private $clientSecret = 'mysecret'; // Защищённый ключ
	private $redirectUrl  = 'http://application.local/?url=auth'; // Адрес, на который будет переадресован пользователь после прохождения авторизации

	public function getAuthorizeVkQuery() {
		// Формируем ссылку для авторизации
		$params = array(
			'client_id'     => $this->clientId,
			'redirect_uri'  => $this->redirectUrl,
			'response_type' => 'code',
			'v'             => '5.126', // (обязательный параметр) версия API https://vk.com/dev/versions
		
			// Права доступа приложения https://vk.com/dev/permissions
			// Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
			// Если не указать "offline", то полученный токен будет жить 12 часов.
			'scope'         => 'photos,offline',
		);
		
		// возвращает параметры запроса
		$query = http_build_query( $params );

		// отправка реального запроса в ВК 
		// header("Location: http://oauth.vk.com/authorize?".$query); exit();

		// использование фейковых данных
		$this->authorizeVK();
	}

	public function authorizeVK() {
		$params = array(
			'client_id'     => $this->clientId,
			'client_secret' => $this->clientSecret,
			'code'          => $_GET['code'],
			'redirect_uri'  => $this->redirectUrl,
		);

		// отправка реального запроса в ВК 
		/*
		if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
			$error = error_get_last();
			throw new Exception('HTTP request failed. Error: ' . $error['message']);
		}
		*/

		// получение фейковых данных
		$content = $this->getFakeVkToken();
		// var_dump(json_decode($content)); die();

		$response = json_decode($content);

		// Если при получении токена произошла ошибка
		if (isset($response->error)) {
			throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
		}
		//А вот здесь выполняем код, если все прошло хорошо
		$token = $response->access_token; // Токен
		$expiresIn = $response->expires_in; // Время жизни токена
		$userId = $response->user_id; // ID авторизовавшегося пользователя

		$userExists = $this->checkUserExists($userId);

		if (!$userExists) {
			$query = 'INSERT INTO `users` SET `login`="'.$userId.'", role=2, token="'.$token.'"';
			setDbData($query);
		}

		// Сохраняем токен в сессии
		$_SESSION['token'] = $token;
		setcookie('role', 2);
		setcookie('isauth', true);

		header('Location: /'); exit();
	}

	public function authorize($login, $pass, $token) {
		if($_POST["token"] == $_SESSION["CSRF"]) {
			session_unset();
			$pass = md5($pass.'salt');
			$user = getDbData("SELECT * FROM users WHERE `login` = '$login' AND `pass` = '$pass'");
			
			if (!$user || count($user) == 0) {
				$err = "Вы ввели неправильный логин/пароль";
				logError([$login, $pass, $err]);
				exit();
			}
			setcookie('role', $user[0]['role']);
			setcookie('isauth', true);

			header('Location: /'); exit();
		}
  }

  public function register($login, $pass) {
		$err = null;
		// проверяем логин
		if (!preg_match("/^[a-zA-Z0-9]+$/",$login)) {
			$err = "Логин может состоять только из букв английского алфавита и цифр";
			logError([$login, $pass, $err]);
			exit();
		} 

		if (strlen($login) < 3 or strlen($login) > 30) {
			$err = "Логин должен быть не меньше 3-х символов и не больше 30";
			logError([$login, $pass, $err]);
			exit();
		} 
		// проверяем, не существует ли пользователя с таким именем
		$userExists = $this->checkUserExists($login);
		if (!$userExists) {
			// зарегистрировать пользователя
			$login = $login;
			$pass = md5($pass.'salt');
			$query = 'INSERT INTO `users` SET `login`="'.$login.'", pass="'.$pass.'", role=1';
			setDbData($query);
			header("Location: index.php?url=main"); exit();
		}
		else {
			$err = "Пользователь с логином ".$login." уже существует.";
			logError([$login, null, $err]);
		}
  }

	function checkUserExists($login) {
		$query = 'SELECT * FROM `users` WHERE `login`="'.$login.'"';
		$data = getDbData($query);
		if (count($data) > 0) {
			return true;
		} 
		else {
			return false;
		}
	}

	function getFakeVkToken() {
		return '{"access_token":"1","expires_in":1,"user_id":1}';
	}
}