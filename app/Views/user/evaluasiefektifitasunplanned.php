<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="col-12">

        <div class="card-header">
            <h3 class="card-title"><?= $tittle ?></h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-head-fixed display" id="example2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Training Title</th>
                        <th>Training Type</th>
                        <th>Implementation date</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($evaluasi as $evaluation) : ?>
                    <tr>
                        <td><?= $evaluation['nama'] ?></td>
                        <td><?= $evaluation['judul'] ?></td>
                        <td><?= $evaluation['jenis'] ?></td>
                        <td><?= $evaluation['tanggal'] ?></td>

                        <?php if ($evaluation['status'] == null) : ?>
                        <td>
                            <a href="<?= base_url() ?>/form_efektivitas_unplanned/<?= $evaluation['id_tna'] ?>"
                                class="btn btn-danger btn-sm" style="color:white">Not Evaluated</a>
                        </td>
                        <?php else : ?>
                        <td>
                            <a href="<?= base_url() ?>/detail_efektivitas_unplanned/<?= $evaluation['id_tna'] ?>"
                                class="btn btn-success btn-sm" style="color:white">Evaluated</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<?= $this->endSection() ?>