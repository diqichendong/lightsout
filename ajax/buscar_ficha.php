<?php

require_once "../config/config.php";

if (isset($_POST["query"])) {
  $query = $_POST["query"];
  $c = curl_init();
  curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/multi?api_key=" . API_KEY . "&language=es&query=" . urlencode($query));
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($c);
  curl_close($c);

  echo $data;
} else {
  echo "{}";
}

?>