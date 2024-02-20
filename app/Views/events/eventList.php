<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1>Seznam eventů</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Název</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($event as $e): ?>
                    <tr>
                        <td><?= $e->id ?></td>
                        <td><?= $e->nazev_eventu ?></td>
                        <td class="d-flex mx-1">
                            <a href="<?= base_url('/admin/event/del/'.$e->id) ?>" class="btn btn-danger mr-2">Smazat</a>
                            <a href="<?= base_url('/admin/event/edit/'.$e->id) ?>" class="btn btn-primary mr-2">Upravit</a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?= $this->endSection(); ?>
