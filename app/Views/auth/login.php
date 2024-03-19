<!DOCTYPE html>
<html lang='en'>

<head>
  <title><?= $settings['site_name']; ?></title>
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/util.css'); ?>">

  <link rel="icon" href="<?= base_url('/eventfussion.png'); ?>">

  <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</head>
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form id="myForm" action="<?= base_url('auth/login'); ?>" class="login100-form validate-form" method="post">
          <img src="<?= base_url("eventfussion.png"); ?>" alt="logo" class="logo-login">
          <a class=" text-center" style="color: black;" href="<?= base_url('/') ?>">
            <h5 class="login-heading">EventFusion</h5>
          </a>

          <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
            <input type="email" name="identity" id="identity" class="input100" value="<?= set_value('identity') ?>">
            <span class="focus-input100" data-placeholder="Email" for="identity"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input type="password" name="password" id="password" class="input100">
            <span class="focus-input100" data-placeholder="Heslo" for="password"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" id="submit" name="submit" class="login100-form-btn btn-primary">Přihlásit se</button>
            </div>
          </div>

          <div class="text-center p-t-115">
            <span class="txt1">
              Nevlastníte účet?
            </span>

            <a class="txt2" href="<?= base_url('auth/register') ?>">
              Vytvořte si ho.
            </a>
          </div>
        </form>
        <?php if (isset($validation)) : ?>
          <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <?= $validation->listErrors() ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/jquery.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
  <script type="text/javascript" src="<?= base_url('/assets/bootstrap/js/custom.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/cs.js"></script>

  <script src="<?= base_url('/assets/bootstrap/js/login.js'); ?>"></script>
</body>

</html>