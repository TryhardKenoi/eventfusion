<?php $this->extend('auth/Auth'); ?>
<?= $this->section('content'); ?>
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
<?php $this->endSection(); ?>