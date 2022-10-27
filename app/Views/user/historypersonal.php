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
                <tr></tr>
                <th>Nama</th>
                <th>Materi Training</th>
                <th>Waktu</th>
                <th>Sertifikat</th>
                <th>Penyelenggara</th>
                <th>Tempat</th>
                <th>Lulus/Tidak</th>
                <th>Sumber</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($history as $histories) : ?>
                <tr>
                    <td><?= $histories['nama'] ?></td>
                    <td>
                        <h6 style="width:300px;"><?= $histories['training'] ?></h6>
                    </td>
                    <td>
                        <h6 style="width:100px;"><?= $histories['rencana_training'] ?></h6>
                    </td>
                    <?php if ($histories['sertifikat'] != null) : ?>
                    <td>
                        <a href="<?= base_url() . $histories['sertifikat'] ?>" type="button"
                            class="btn btn-success btn-sm">Download</a>
                    </td>
                    <?php else : ?>
                    <td>Sertifikat Belum Ada</td>
                    <?php endif; ?>
                    <td><?= $histories['vendor'] ?></td>
                    <td><?= $histories['tempat'] ?></td>
                    <?php if ($histories['keterangan'] == null) : ?>
                    <td>Belum Diputuskan</td>
                    <?php else : ?>
                    <td><?= $histories['keterangan'] ?></td>
                    <?php endif; ?>
                    <td>
                        <?php
                            if ($histories['kelompok_training'] == 'training') {
                                echo 'TNA';
                            } else {
                                echo 'Unplanned';
                            }  ?></td>
                </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>