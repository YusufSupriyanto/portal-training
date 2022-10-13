<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-1">
    <div class="card-header">
        <?php $page = basename($_SERVER['PHP_SELF']);
        if ($page == 'status_tna') : ?>
        <h3 class="card-title">Status Training Need Analysis</h3>
        <?php else : ?>
        <h3 class="card-title">Status Unplanned Training</h3>
        <?php endif; ?>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto" id="example">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Training</th>
                    <th>Jenis Training</th>
                    <th>Kategori Training</th>
                    <th>Metode Training</th>
                    <th>Request Training</th>
                    <th>Mulai Training</th>
                    <th>Rencana Training</th>
                    <th>Tujuan Training</th>
                    <th>Notes</th>
                    <th>Budget</th>
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
                            style="background-color:grey;width:50;border:1px;border-radius:2px;color:white;">Wait</div>
                        <?php elseif ($statuses['status_approval_1'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:50;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:red;width:50px;border:1px;border-radius:2px;color:white;">Reject
                        </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($statuses['status_approval_2'] == NULL) : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:grey;width:50;border:1px;border-radius:2px;color:white;">Wait</div>
                        <?php elseif ($statuses['status_approval_2'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:50px;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:red;width:50;border:1px;border-radius:2px;color:white;">Reject</div>
                        <?php endif; ?>
                    </td>
                    <td>

                        <?php if ($statuses['status_approval_3'] == NULL) : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:grey;width:50;border:1px;border-radius:2px;color:white;">Wait</div>
                        <?php elseif ($statuses['status_approval_3'] == 'accept') : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:green;width:50;border:1px;border-radius:2px;color:white;">Accept
                        </div>
                        <?php else : ?>
                        <div class="d-flex justify-content-center"
                            style="background-color:red;width:50;border:1px;border-radius:2px;color:white;">Reject</div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.card-body -->

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
</script>
<?= $this->endSection() ?>