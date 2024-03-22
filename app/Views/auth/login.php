<?php $this->extend('auth/Auth'); ?>
<?= $this->section('content'); ?>
<div class="limiter">
          <div class="container-login100">
            <div class="wrap-login100">
              <form id="myForm" action="<?= base_url('auth/login'); ?>" class="login100-form validate-form" method="post">
                <img src="<?= base_url("/eventfussion.png"); ?>" alt="logo" class="logo-login">
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
<?php $this->endSection(); ?>