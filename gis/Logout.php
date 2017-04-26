<?php

  session_start();
  $_SESSION = array();
  session_destroy();

  echo <<<EOE
    <meta http-equiv="refresh" content="0;URL=login.php">
EOE;
?>