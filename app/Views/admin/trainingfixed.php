<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title">Annual Training Master Plan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Npk</th>
                    <th>Departemen</th>
                    <th>Judul Training</th>
                    <th>Jenis Training</th>
                    <th>Kategori Training</th>
                    <th>Metode Training</th>
                    <th>Tujuan Training</th>
                    <th>Mulai Training</th>
                    <th>Selesai Training</th>
                    <th>Biaya</th>
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
                <td><?= $Atmps['mulai_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <td>Rp<?= number_format($Atmps['biaya'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>