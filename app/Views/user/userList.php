<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1>Seznam všech uživatelů</h1>
            <div class="pt-2 pb-3">
                <a class="btn btn-primary" href="<?= base_url('admin/register') ?>">Nový uživatel</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jméno</th>
                        <th scope="col">Příjmení</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <td><?= $u->id ?></td>
                            <td><?= $u->first_name ?></td>
                            <td><?= $u->last_name ?></td>
                            <td class="d-flex mx-1">
                                <a href="<?= base_url('/admin/user/edit/' . $u->id) ?>" class="btn btn-primary mr-2">Upravit</a>
                                <a href="<?= base_url('/admin/user/delete/' . $u->id) ?>" class="btn btn-danger ">Smazat</a>
                            </td>


                        <?php endforeach; ?>
                        </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?= $this->endSection(); ?>