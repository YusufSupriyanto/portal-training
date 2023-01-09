<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-1">
    <div class="card-header">
        <h3 class="card-title">Status Unplanned Training</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto" id="example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Training</th>
                    <th>Training Type</th>
                    <th>Training Category</th>
                    <th>Training Method</th>
                    <th>Training Requests</th>
                    <th>Training Start</th>
                    <th>Training Finished</th>
                    <th>Training Goal</th>
                    <th>Notes</th>
                    <th>Budget Estimate</th>
                    <th>Approval KADEPT</th>
                    <th>Approval KADIV</th>
                    <th>Approval Admin</th>
                    <th>Approval BOD</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($status as $statuses) : ?>
                <tr>
                    <td><?= $statuses['nama'] ?></td>
                    <td><?= $statuses['training'] ?></td>
                    <td><?= $statuses['jenis_training'] ?></td>
                    <td><?= $statuses['kategori_training'] ?></td>
                    <td><?= $statuses['metode_training'] ?></td>
                    <td>
                        <div style="width:60px;"><?= $statuses['request_training'] ?></div>
                    </td>
                    <td><?= $statuses['mulai_training'] ?></td>
                    <td><?= $statuses['rencana_training'] ?></td>
                    <td><?= $statuses['tujuan_training'] ?></td>
                    <td><?= $statuses['notes'] ?></td>
                    <td>
                        <div style="width:80px;"><?= "Rp " . number_format($statuses['biaya_actual'], 0, ',', '.') ?>
                        </div>
                    </td>
                    <td>
                        <?php if ($statuses['status_approval_1'] == NULL) : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:grey;width:100px;border:1px;border-radius:2px;color:white;">Wait
                        </div>
                        <?php elseif ($statuses['status_approval_1'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:100px;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <button class="btn btn-danger btn-sm" style="width:100px"
                            onclick="alasan('<?= $statuses['alasan'] ?>')">Reject</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($statuses['status_approval_2'] == NULL) : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:grey;width:100px;border:1px;border-radius:2px;color:white;">Wait
                        </div>
                        <?php elseif ($statuses['status_approval_2'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:100px;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <button class="btn btn-danger btn-sm" style="width:100px;"
                            onclick="alasan('<?= $statuses['alasan'] ?>')">Reject</button>
                        <?php endif; ?>
                    </td>
                    <td>

                        <?php if ($statuses['status_approval_3'] == NULL) : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:grey;width:100px;border:1px;border-radius:2px;color:white;">Wait
                        </div>
                        <?php elseif ($statuses['status_approval_3'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:100px;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <button class="btn btn-danger btn-sm" style="width:100px"
                            onclick="alasan('<?= $statuses['alasan'] ?>')">Reject</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="alasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alasan Rejected</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <label for="alasan">Alasan</label>
                    <textarea id="text" class="mt-1" name=""></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
var id_tna = $('#tna').val();
var id_user = $('#user').val();

$.ajax({
    type: 'post',
    url: "<?= base_url(); ?>/tna_user_status",
    async: true,
    dataType: "json",
    data: {
        id_tna: id_tna,
        id_user: id_user
    },
    success: function(data) {

    }

})


function alasan(alasan) {

    $('#alasan #text').val(alasan)
    jQuery.noConflict();
    $('#alasan').modal('show')
}
</script>
<?= $this->endSection() ?>