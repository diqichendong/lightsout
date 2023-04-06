<?php

require_once "../config/config.php";

if (isset($_POST["query"])) {
  $query = $_POST["query"];
  echo file_get_contents(API_REQUEST_BASE . "/search/multi?api_key=" . API_KEY . "&language=es&query=" . urlencode($query));
} else {
  echo "{}";
}

?>