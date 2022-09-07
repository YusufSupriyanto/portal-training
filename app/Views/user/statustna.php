<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-3">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto">
            <thead></thead>
            <tr>
                <th>Nama</th>
                <th>Training</th>
                <th>Jenis Training</th>
                <th>Kategori Training</th>
                <th>Metode Training</th>
                <th>Rencana Training</th>
                <th>Tujuan Training</th>
                <th>Notes</th>
                <th>Estimasi Budget</th>
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
                    <td><?= $statuses['rencana_training'] ?></td>
                    <td><?= $statuses['tujuan_training'] ?></td>
                    <td><?= $statuses['notes'] ?></td>
                    <td><?= $statuses['biaya_actual'] ?></td>
                    <td>
                        <?php if ($statuses['status_approval_1'] == NULL) : ?>
                        <button style="width:100px;" class="btn btn-secondary btn-sm mt-1"><i
                                class="fa fa-fw fa-clock-o" disabled></i><span>Wait</span></button>
                        <?php elseif ($statuses['status_approval_1'] == 'accept') : ?>
                        <button style="width:100px;" class="btn btn-success btn-sm mt-1"><i class="fa fa-fw fa-check"
                                disabled></i><span>Accept</span></button>
                        <?php else : ?>
                        <a href=" javascript:;" class="item-edit" data-reject="" style="color:white;"><button
                                class="btn btn-danger btn-sm mt-1" style="width:100px;"><i class=" fa fa-fw fa-close"
                                    disabled></i>Reject</button></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($statuses['status_approval_2'] == NULL) : ?>
                        <button style="width:100px;" class="btn btn-secondary btn-sm mt-1"><i
                                class="fa fa-fw fa-clock-o" disabled></i><span>Wait</span></button>
                        <?php elseif ($statuses['status_approval_2'] == 'accept') : ?>
                        <button style="width:100px;" class="btn btn-success btn-sm mt-1"><i class="fa fa-fw fa-check"
                                disabled></i><span>Accept</span></button>
                        <?php else : ?>
                        <a href=" javascript:;" class="item-edit" data-reject="" style="color:white;"><button
                                class="btn btn-danger btn-sm mt-1" style="width:100px;"><i class=" fa fa-fw fa-close"
                                    disabled></i>Reject</button></a>
                        <?php endif; ?>
                    </td>
                    <td>


                        <?php if ($statuses['status_approval_3'] == NULL) : ?>
                        <button style="width:100px;" class="btn btn-secondary btn-sm mt-1"><i
                                class="fa fa-fw fa-clock-o" disabled></i><span>Wait</span></button>
                        <?php elseif ($statuses['status_approval_3'] == 'accept') : ?>
                        <button style="width:100px;" class="btn btn-success btn-sm mt-1"><i class="fa fa-fw fa-check"
                                disabled></i><span>Accept</span></button>
                        <?php else : ?>
                        <a href=" javascript:;" class="item-edit" data-reject="" style="color:white;"><button
                                class="btn btn-danger btn-sm mt-1" style="width:100px;"><i class=" fa fa-fw fa-close"
                                    disabled></i>Reject</button></a>
                        <?php endif; ?>




                        <!-- <div class="d-flex flex-row">
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm mr-1"><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                            <button style="width:100px;" class="btn btn-secondary btn-sm "><i
                                    class="fa fa-fw fa-clock-o"></i><span>Wait</span></button>
                        </div> -->
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