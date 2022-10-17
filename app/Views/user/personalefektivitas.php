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
                        <th>Nama</th>
                        <th>Judul Training</th>
                        <th>Jenis Training</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Keterangan</th>
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
                            <a class="btn btn-danger btn-sm" style="color:white">Belum
                                dievaluasi</a>
                        </td>
                        <?php else : ?>
                        <td>
                            <a href="<?= base_url() ?>/detail_efektivitas/<?= $evaluation['id_tna'] ?>"
                                class="btn btn-success btn-sm" style="color:white">Sudah
                                dievaluasi</a>
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