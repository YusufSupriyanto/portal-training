<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Training</th>
                    <th>Rencana Training</th>
                    <th>Planing Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($training as $tnas) : ?>
                <tr>
                    <td><?= $tnas['nama'] ?></td>
                    <td><?= $tnas['departemen'] ?></td>
                    <td><?= $tnas['training'] ?></td>
                    <td><?= $tnas['rencana_training'] ?></td>
                    <td><?= "Rp " . number_format($tnas['biaya'], 2, ',', '.') ?></td>
                    <td><?= "Rp " . number_format($tnas['biaya_actual'], 2, ',', '.') ?></td>
                    <td>
                        <div class="d-flex justify-content-center sm"
                            style="background-color:red;width:100px;border:1px;border-radius:2px;color:white;">Reject
                        </div>
                    </td>
                    <td><?= $tnas['alasan'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>