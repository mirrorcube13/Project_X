<?php

  if (is_user_logged_in()) {
      back();
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (validate_user($_POST)) {
        $user = save_user($_POST);
        log_in_user($user);
        back('/');
    }
  }
?>

<div id="registration">
  <div class="container">
    <div class="row">
      <div class="page-header">
        <h1 class="centered">Регистрация</h1>
      </div>
      <form action="registration" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Имя</label>
          <div class="col-sm-10">
            <input type="text" name="u_name" class="form-control" id="inputText" placeholder="Имя">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="u_email" class="form-control" id="inputEmail" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-sm-2 control-label">Введите пароль</label>
          <div class="col-sm-10">
            <input type="password" name="u_pass" class="form-control" id="inputPassword" placeholder="Введите пароль">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-sm-2 control-label">Введите пароль повторно</label>
          <div class="col-sm-10">
            <input type="password" name="u_pass2" class="form-control" id="inputPassword" placeholder="Введите пароль повторно">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Зарегистрироваться</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>