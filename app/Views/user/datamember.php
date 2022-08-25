<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="member">
            <thead>
                <tr>
                    <th>NPK</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Bagian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->npk ?></td>
                    <td><a href="<?= base_url() ?>\form_tna\<?= $users->id_user ?>"><?= $users->nama ?></a></td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->bagian ?></td>
                    <td><?= $users->status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>