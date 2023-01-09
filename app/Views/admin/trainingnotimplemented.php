<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<!-- Modal -->
<div class="modal fade" id="alasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <textarea rows="4" cols="50" name="reason" id="reason" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
                    <th>Training</th>
                    <th>Training Start</th>
                    <th>Training Finished</th>
                    <th>Budget Planning</th>
                    <th>Budget Actual</th>
                    <th>Reason</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($training as $Training) : ?>
                <tr>
                    <td><?= $Training['nama'] ?></td>
                    <td><?= $Training['departemen'] ?></td>
                    <td><?= $Training['training'] ?></td>
                    <td><?= $Training['mulai_training'] ?></td>
                    <td><?= $Training['rencana_training'] ?></td>
                    <td><?= "Rp " . number_format($Training['biaya'], 0, ',', '.') ?></td>
                    <td><?= "Rp " . number_format($Training['biaya_actual'], 0, ',', '.') ?></td>
                    <td><button class="btn btn-danger btn-sm"
                            onclick="Alasan('<?= $Training['alasan'] ?>')">Alasan</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
function Alasan(reason) {
    jQuery.noConflict()
    $('#reason').val(reason)
    $('#alasan').modal('show')
}
</script>
<?= $this->endSection() ?>