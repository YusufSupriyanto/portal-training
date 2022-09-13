<?= $this->extend('/template/templateuser') ?>

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
                    <th>Training</th>
                    <th>Pendaftar</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Daftar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $jadwals) : ?>
                <tr>
                    <td><?= $jadwals['training'] ?></td>
                    <td><?= $jadwals['pendaftar'] ?></td>
                    <td><?= $jadwals['tanggal'] ?></td>
                    <td><?= $jadwals['kategori'] ?></td>
                    <td><a href="<?= base_url() ?>/unplanned_form/<?= $jadwals['training'] ?>">Daftar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>