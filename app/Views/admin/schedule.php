<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="personal-schedule">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Judul Training</th>
                    <th>Jenis Training</th>
                    <th>Kategori Training</th>
                    <th>Metode Training</th>
                    <th>Tujuan Training</th>
                    <th>Rencana Training</th>
                    <th>Action</th>
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
                <td><?= $Atmps['rencana_training'] ?></td>
                <?php $page = basename($_SERVER['PHP_SELF']);
                    if ($page == 'schedule_training') : ?>
                <td>
                    <a href="<?= base_url() ?>/schedule_action/<?= $Atmps['id_tna'] ?>" class="btn btn-success btn-sm"
                        style="font-size:10px;">Sudah Terlaksana</a>
                </td>
                <?php else : ?>
                <td>
                    <a href="<?= base_url() ?>/schedule_action_unplanned/<?= $Atmps['id_tna'] ?>"
                        class="btn btn-success btn-sm" style="font-size:10px;">Sudah Terlaksana</a>
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