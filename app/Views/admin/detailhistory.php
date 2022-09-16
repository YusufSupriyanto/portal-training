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
                <form action="<?= base_url() ?>/sertifikat_upload" method="post" id="form<?= $i ?>">
                    <tr>
                        <td><?= $histories['nama'] ?></td>
                        <td>
                            <h6 style="width:300px;"><?= $histories['training'] ?></h6>
                        </td>
                        <td>
                            <h6 style="width:100px;"><?= $histories['rencana_training'] ?></h6>
                        </td>
                        <td>
                            <input type="file" name="file<?= $histories['id_tna'] ?>"
                                id="file<?= $histories['id_tna'] ?>">
                            <input type="hidden" name="history[]" id="history[]" value="<?= $histories['id_tna'] ?>">
                        </td>
                        <td><?= $histories['vendor'] ?></td>
                        <td><?= $histories['tempat'] ?></td>
                        <td><input type="text" name="keterangan[]"></td>
                        <td><button type="submit" class="btn btn-primary btn-sm">Upload</button></td>
                    </tr>
                </form>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>