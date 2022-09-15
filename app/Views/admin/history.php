<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah Training</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $users) : ?>
                <tr>
                    <td><a href=""><?= $users->nama ?></a></td>
                    <td></td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div <?= $this->endSection() ?>