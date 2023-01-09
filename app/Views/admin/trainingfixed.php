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
                    <th>Name</th>
                    <th>NPK</th>
                    <th>Department</th>
                    <th>Training Title</th>
                    <th>Training Type</th>
                    <th>Training Category</th>
                    <th>Training Method</th>
                    <th>Training Goals</th>
                    <th>Training Start</th>
                    <th>Training Finished</th>
                    <th>Budget</th>
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