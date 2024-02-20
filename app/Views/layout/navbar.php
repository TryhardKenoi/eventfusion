<nav class="navbar">
    <div class="p-3">
        <h1><b>Event</b>Fusion</h1>
    </div>
    <div class="navbar-links">
        <ul>
            <li><a href="<?= base_url('')?>">Domů</a></li>

          <?php if (\App\Helpers\User::isLoggedIn()): ?>            
            <?php if(\App\Helpers\User::isAdmin()): ?>
              <li>
                <a href="<?= base_url('/admin/groups')?>">
                  Skupiny
                </a>
              </li>
              <li>
                <a href="<?= base_url('/admin/users')?>">
                  Uzivatele
                </a>
              </li>
              <li>
                <a href="<?= base_url('/admin/events')?>">
                  Eventy
                </a>
              </li>
              <?php endif; ?>
            <li>
              <a href="<?= base_url('/profile')?>">
                <?= \App\Helpers\User::user()->email; ?>
              </a>
            </li>
            <li><a href="<?= base_url('/auth/logout')?>">Odhlásit</a></li>
          <?php else: ?>
            <li><a href="<?= base_url('/auth')?>">Přihlášení</a></li>
            <li><a href="<?= base_url('/auth/register')?>">Registrace</a></li>

          <?php endif;?>
        </ul>
</nav>
