<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-3 overflow-auto">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover overflow-auto">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Materi Training</th>
                    <th>Waktu</th>
                    <th>Sertifikat</th>
                    <th>Penyelenggara</th>
                    <th>Tempat</th>
                    <th>Lulus/Tidak</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($history as $histories) : ?>
                <form action="<?= base_url() ?>/sertifikat_upload" method="post" id="form<?= $i ?>"
                    enctype="multipart/form-data">
                    <tr>
                        <td><?= $histories['nama'] ?></td>
                        <td>
                            <h6 style="width:300px;"><?= $histories['training'] ?></h6>
                        </td>
                        <td>
                            <h6 style="width:100px;"><?= $histories['rencana_training'] ?></h6>
                        </td>
                        <?php if ($histories['sertifikat'] == null) : ?>
                        <td>
                            <input type="file" name="file<?= $histories['id_tna']  ?>" Accept="Application/Pdf"
                                id="file<?= $histories['id_tna'] ?>">
                            <input type="hidden" name="history[]" id="history[]" value="<?= $histories['id_tna'] ?>">
                        </td>
                        <?php else : ?>
                        <td>Sertifikat Sudah Dikirim</td>
                        <?php endif; ?>
                        <td><?= $histories['vendor'] ?></td>
                        <td><?= $histories['tempat'] ?></td>
                        <?php if ($histories['keterangan'] == null) : ?>
                        <td><input type="text" name="keterangan[]"></td>
                        <?php else : ?>
                        <td><?= $histories['keterangan'] ?></td>
                        <?php endif; ?>
                        <td><button type="submit" class="btn btn-success btn-sm">Confirm</button></td>
                    </tr>
                </form>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>