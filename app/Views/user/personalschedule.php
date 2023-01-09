<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <?php $page = basename($_SERVER['PHP_SELF']);
        if ($page == 'personal_schedule') : ?>
        <h3 class="card-title">Schedule Personal Training</h3>
        <?php else : ?>
        <h3 class="card-title">Schedule Personal Unplanned Training</h3>
        <?php endif; ?>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="personal-schedule">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Department</th>
                    <th>Training Title</th>
                    <th>Training Type</th>
                    <th>Training Category</th>
                    <th>Training Method</th>
                    <th>Training Goals</th>
                    <th>Training Start</th>
                    <th>Training Finished</th>
                    <th>Training Description</th>
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
                <td><?= $Atmps['mulai_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <?php if ($Atmps['status_training'] == null) : ?>
                <td>
                    <div class="d-flex justify-content-center sm"
                        style="background-color:red;width:100px;border:1px;border-radius:2px;color:white;font-size:10px;">
                        Not Implemented
                    </div>
                </td>
                <?php else : ?>
                <td>
                    <div class="d-flex justify-content-center sm"
                        style="background-color:green;width:100px;border:1px;border-radius:2px;color:white;font-size:10px;">
                        Implemented
                    </div>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>