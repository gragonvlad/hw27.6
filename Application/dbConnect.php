<?php
function getDbData($query) {
  $result = dbConnect($query);

  for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
  return $data; 
}

function setDbData($query) {
	$result = dbConnect($query);
	return $result;
}

function dbConnect($query) {
	$link = mysqli_connect(HOST, USER, PASSWORD, DB);
  mysqli_query($link, "SET NAMES 'utf8'");
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	return $result;
}
