<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Training Material</th>
                <th>Time</th>
                <th>Certificate</th>
                <th>Organizer</th>
                <th>Place</th>
                <th>Passed/Not Pass</th>
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
                        <form action="<?= base_url() ?>/download_sertifikat" method="post">
                            <input type="hidden" name="input[]" value="<?= $histories['id_tna'] ?>">
                            <button type=" submit" value="View" class="btn btn-success btn-sm">View</button>
                        </form>

                    </td>
                    <?php else : ?>
                    <td>Certificate Sent</td>
                    <?php endif; ?>
                    <td><?= $histories['vendor'] ?></td>
                    <td><?= $histories['tempat'] ?></td>
                    <?php if ($histories['keterangan'] == null) : ?>
                    <td>Not yet decided</td>
                    <?php else : ?>
                    <td><?= $histories['keterangan'] ?></td>
                    <?php endif; ?>
                </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>