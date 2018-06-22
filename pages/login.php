<?php
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($user = auth_user($_POST)) {
    log_in_user($user);
  }
}
back('/');
die();