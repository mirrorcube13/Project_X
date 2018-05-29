<?php


function validate_user($input) {
  foreach ($input as $key => $item) {
    if (is_string($item)) {
      $input[$key] = trim($item);
      if (empty($input[$key])) {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }
  if ($input['u_pass'] !== $input['u_pass2']) {
    return FALSE;
  }
  if (DB::getObject()->select('users')
    ->where('u_email', $input['u_email'])
    ->get()) {
    return FALSE;
  }
  return TRUE;
}

function save_user($input) {
  $input['u_pass'] = sha1($input['u_pass']);
  unset($input['u_pass2']);
  $input['u_registered'] = time();
  $db = DB::getObject();
  $db->insert('users', $input);
  return $db->getLastId();
}

function back($path = '') {
  $path = isset($path) ? $path : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
  header("Location: $path");
}

function log_in_user($u_id) {
  try {
    $user = DB::getObject()->select('users')->where('u_id', $u_id)->first();
  } catch (Exception $exception) {
    return FALSE;
  }
  unset($user['u_pass']);
  $_SESSION['user'] = $user;
  $_SESSION['logged_in'] = TRUE;

  return TRUE;
}

function log_out_user() {
  session_destroy();
}

function is_user_logged_in() {
  return isset($_SESSION['logged_in']);
}

function auth_user($input) {
  foreach (array('u_email', 'u_pass') as $key) {
    if (!(isset($input[$key]) && is_string($input[$key]))) {
      return FALSE;
    }
  }
  $input['u_pass'] = sha1($input['u_pass']);
  try {
    $user = DB::getObject()->select('users')
      ->where('u_email', $input['u_email'])
      ->where('u_pass', $input['u_pass'])
      ->first();
  } catch (Exception $e) {
    return FALSE;
  }
  return $user['u_id'];
}

function is_admin() {
  return (isset($_SESSION['user']) && $_SESSION['user']['u_admin']);
}