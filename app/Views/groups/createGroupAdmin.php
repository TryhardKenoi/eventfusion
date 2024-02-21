<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

 <form action="<?= base_url('/admin/group/create') ?>" method="post">
    <div class="text-center">
        <div class="text-center pt-3">
            <h1>Vytvoř skupinu</h1>
            <hr>
        </div>
    </div>

    <div class="container">
        <div class="form-group">
            <label for="name">Název skupiny</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="name">Popisek skupiny</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <button type="submit" class="btn btn-primary">Vytvořit</button>
    </div>


 </form>


  <script src="../../plugins/jquery/jquery.min.js"></script>

  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>

<?= $this->endSection(); ?>
