<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="p-3">
      <div class="navbar-brand">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
          <img src="<?= base_url('/eventfussion.png'); ?>" width="50" height="50" class="d-inline-block align-top" alt="">
          <h1 class="d-inline"><?= $settings['site_name']; ?></h1>
        </a>
      </div>

    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('')?>">Domů</a></li>

          <?php if (\App\Helpers\User::isLoggedIn()): ?>            
            <?php if(\App\Helpers\User::isAdmin()): ?>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/settings')?>">Nastavení</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin/groups')?>">Skupiny</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin/users')?>">Uživatelé</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin/events')?>">Eventy</a></li>
            <?php endif; ?>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/profile')?>"><?= \App\Helpers\User::user()->email; ?></a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('/auth/logout')?>">Odhlásit</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/auth')?>">Přihlášení</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/auth/register')?>">Registrace</a></li>
          <?php endif;?>
        </ul>
    </div>
</nav>