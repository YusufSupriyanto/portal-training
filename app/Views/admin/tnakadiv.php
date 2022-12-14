<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Training</th>
                    <th>Training Start</th>
                    <th>Training Finished</th>
                    <th>Budget Planning</th>
                    <th>Budget Actual</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="status-kadiv">
                <?php foreach ($tna as $tnas) : ?>
                <tr>
                    <td><?= $tnas['nama'] ?></td>
                    <td><?= $tnas['departemen'] ?></td>
                    <td><?= $tnas['training'] ?></td>
                    <td><?= $tnas['mulai_training'] ?></td>
                    <td><?= $tnas['rencana_training'] ?></td>
                    <td><?= "Rp " . number_format($tnas['biaya'], 0, ',', '.') ?></td>
                    <td><?= "Rp " . number_format($tnas['biaya_actual'], 0, ',', '.')  ?></td>
                    <td>
                        <?php if ($tnas['status_approval_1'] == 'reject') : ?>
                        <a href=" javascript:;" class="item-edit" data-reject="<?= $tnas['id_tna'] ?>"
                            style="color:white;"><button class="btn btn-danger btn-sm mt-1" style="width:100px;"><i
                                    class=" fa fa-fw fa-close"></i>Reject</button></a>
                        <?php elseif ($tnas['status_approval_1'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:100px;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <div class="d-flex justify-content-center sm"
                            style="background-color:grey;width:100px;border:1px;border-radius:2px;color:white;">Wait
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class=" modal fade" id="detail-reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Reject Training</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <label for="alasan">Reason</label>
                        <textarea id="alasan" class="alasan" name="alasan" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>