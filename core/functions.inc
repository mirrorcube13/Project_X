<?php

define('PAGE_LIMIT', 10);

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
  $input['u_email'] = strtolower($input['u_email']);
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
  $input['u_email'] = strtolower($input['u_email']);
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

function get_page_title() {
  global $config;
  $path = ltrim($_SERVER['REQUEST_URI'], '/');
  return isset($config['page_titles'][$path]) ? $config['page_titles'][$path] : $config['page_titles']['index'];
}

function mb_ucfirst($text) {
  return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function get_search_form($params = [], $convs = FALSE) {
  require_once __DIR__ . '/../pages/parts/search_form.php';
}

function render(&$item) {
  return (isset($item)) ? $item : '';
}

function render_selected(&$item, $value) {
  return (isset($item) && $item == $value) ? 'selected="selected"' : '';
}

function render_checked(&$item, $value) {
  return (isset($item) && is_array($item) && in_array($value, $item)) ? 'checked' : '';
}

function get_hotels($params) {
  $db = DB::getObject();
  build_hotels_query($params);
  $offset = isset($_GET['page']) ? $_GET['page'] : 0;
  $db->limit($offset, PAGE_LIMIT);

  return $db->get();
}

function count_hotels($params) {
  $db = DB::getObject();
  build_hotels_query($params);
  return $db->count();
}

function build_hotels_query($params) {
  $db = DB::getObject();
  $db->select('rooms')
    ->join('cities', 'r_city', 'c_id')
    ->join('rooms_convs', 'r_id', 'rc_room_id');

  if (!empty($params['r_start'])) {
    $db->where('r_start', strtotime($params['r_start']), '>=');
  }
  unset($params['r_start']);
  if (!empty($params['r_end'])) {
    $db->where('r_end', strtotime($params['r_end']), '<=');
  }
  unset($params['r_end']);

  if (!empty($params['convs'])) {
    foreach ($params['convs'] as $conv) {
      $db->where($conv, 1);
    }
  }
  unset($params['convs']);

  foreach ($params as $column => $value) {
    if (is_array($value)) {
      $db->whereIn($column, $value);
    } else {
      $db->where($column, $value);
    }
  }
}

function render_hotels($hotels = []) {
  require_once __DIR__ . '/../pages/parts/hotels.php';
}