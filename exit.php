<?php
setcookie('user', $user['login'], 0, '/');
header('Location: /');
?>