<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="m-1">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Training</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed display" id="example2">
                    <thead>
                        <tr>
                            <th>Training Title</th>
                            <th>Training Type</th>
                            <th>Description</th>
                            <th>Vendor</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jenis as $trainings) : ?>
                        <tr>
                            <td><?= $trainings->judul_training ?></td>
                            <td><?= $trainings->jenis_training ?></td>
                            <td><?= $trainings->deskripsi ?></td>
                            <td><?= $trainings->vendor ?></td>
                            <td><?= "Rp " . number_format($trainings->biaya, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?= $this->endSection() ?>