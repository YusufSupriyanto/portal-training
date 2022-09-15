<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-2">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="personal-schedule">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>DEPARTEMEN</th>
                    <th>JUDUL TRAINING</th>
                    <th>JENIS TRAINING</th>
                    <th>KATEGORI TRAINING</th>
                    <th>METODE TRAINING</th>
                    <th>TUJUAN TRAINING</th>
                    <th>RENCANA TRAINING</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <?php foreach ($schedule as $Atmps) : ?>
            <tr>
                <td><?= $Atmps['nama'] ?></td>
                <td><?= $Atmps['departemen'] ?></td>
                <td><?= $Atmps['training'] ?></td>
                <td><?= $Atmps['jenis_training'] ?></td>
                <td><?= $Atmps['kategori_training'] ?></td>
                <td><?= $Atmps['metode_training'] ?></td>
                <td><?= $Atmps['tujuan_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <td>
                    <a href="<?= base_url() ?>/schedule_action/<?= $Atmps['id_tna'] ?>" class="btn btn-success btn-sm"
                        style="font-size:10px;">Sudah Terlaksana</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>