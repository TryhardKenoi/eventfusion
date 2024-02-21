<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1>Seznam clenu skupiny</h1>
            <div class="pt-2 pb-3">
                <a class="btn btn-primary" href="<?= base_url('admin/group/create') ?>">Nová skupina </a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Název</th>
                    <th scope="col">Popisek</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($groups as $g): ?>
                    <tr>
                        <td><?= $g->id ?></td>
                        <td><?= $g->name ?></td>
                        <td><?= $g->description ?></td>
                        <td class="d-flex mx-1">
                            <a href="<?= base_url('/admin/group/delete/'.$g->id) ?>" class="btn btn-danger">Smazat</a>
                            <a href="<?= base_url('/admin/group/edit/'.$g->id) ?>" class="btn btn-primary">Upravit</a>
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
