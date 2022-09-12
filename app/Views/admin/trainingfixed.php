<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Annual Training Master Plan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>NPK</th>
                    <th>DEPARTEMEN</th>
                    <th>JUDUL TRAINING</th>
                    <th>JENIS TRAINING</th>
                    <th>KATEGORI TRAINING</th>
                    <th>METODE TRAINING</th>
                    <th>TUJUAN TRAINING</th>
                    <th>RENCANA TRAINING</th>
                    <th>BIAYA</th>
                </tr>
            </thead>
            <?php foreach ($Atmp as $Atmps) : ?>
            <tr>
                <td><?= $Atmps['nama'] ?></td>
                <td><?= $Atmps['npk'] ?></td>
                <td><?= $Atmps['departemen'] ?></td>
                <td><?= $Atmps['training'] ?></td>
                <td><?= $Atmps['jenis_training'] ?></td>
                <td><?= $Atmps['kategori_training'] ?></td>
                <td><?= $Atmps['metode_training'] ?></td>
                <td><?= $Atmps['tujuan_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <td><?= $Atmps['biaya'] ?></td>
            </tr>
            <?php endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>