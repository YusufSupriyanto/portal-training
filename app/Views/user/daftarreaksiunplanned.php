<?= $this->extend('/template/templateuser') ?>

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
                    <th>Name</th>
                    <th>Department</th>
                    <th>Training Title</th>
                    <th>Training Type</th>
                    <th>Training Category</th>
                    <th>Training Method</th>
                    <th>Training Goals</th>
                    <th>Training Implementation</th>
                    <th>Description</th>
                </tr>
            </thead>
            <?php foreach ($evaluasi as $Atmps) : ?>
            <tr>
                <td><?= $Atmps['nama'] ?></td>
                <td><?= $Atmps['departemen'] ?></td>
                <td><?= $Atmps['training'] ?></td>
                <td><?= $Atmps['jenis_training'] ?></td>
                <td><?= $Atmps['kategori_training'] ?></td>
                <td><?= $Atmps['metode_training'] ?></td>
                <td><?= $Atmps['tujuan_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <?php if ($Atmps['status_evaluasi'] == null) : ?>
                <td>
                    <div class="d-flex justify-content-center sm">
                        <a href="<?= base_url() ?>/form_evaluasi_unplanned/<?= $Atmps['id_tna'] ?>"
                            class="btn btn-danger btn-sm" style="font-size:10px;">Not Evaluated</a>
                    </div>
                </td>
                <?php else : ?>
                <td>
                    <div class="d-flex justify-content-center sm">
                        <a href="<?= base_url() ?>/form_unplanned_selesai/<?= $Atmps['id_tna'] ?>"
                            class="btn btn-success btn-sm" style="font-size:10px;">Evaluated</a>
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