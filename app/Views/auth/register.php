<!DOCTYPE html>
<html lang='cs'>

<head>
    <title><?= $settings['site_name']; ?></title>
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/util.css'); ?>">
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="<?= base_url('/eventfussion.png'); ?>">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</head>


<body">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form id="registerForm" action="<?= base_url('auth/register') ?>" method="post">
                    <span class="login100-form-title p-b-26">
                        Registrace
                    </span>
                    <span class="login100-form-title p-b-48">
                        <i class="zmdi zmdi-font"></i>
                    </span>
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger alert-dismissible text-center mt-1" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input type="text" class="input100" name="first_name" id="first_name" value="<?= set_value('first_name') ?>">
                        <span class="focus-input100" data-placeholder="Jméno"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input type="text" class="input100" name="last_name" id="last_name" value="<?= set_value('last_name') ?>">
                        <span class="focus-input100" data-placeholder="Příjmení"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input type="email" class="input100" name="email" id="email" value="<?= set_value('email') ?>">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input type="password" name="password" id="password" class="input100">
                        <span class="focus-input100" data-placeholder="Heslo"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input type="password" name="password_confirm" id="password_confirm" class="input100">
                        <span class="focus-input100" data-placeholder="Heslo znovu"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" id="submit" name="submit" class="login100-form-btn btn-primary">Registrujte se</button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">
                            Vlastníte účet?
                        </span>

                        <a class="txt2" href="<?= base_url('auth/login') ?>">
                            Přihlašte se.
                        </a>
                    </div>
                </form>
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