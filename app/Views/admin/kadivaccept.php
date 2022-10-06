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
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Training</th>
                    <th>Start Training</th>
                    <th>End Training</th>
                    <th>Planing Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="admin-verify">
                <?php $i = 0;
                foreach ($status as $tnas) : ?>
                <tr>
                    <td><?= $tnas['nama'] ?></td>
                    <td><?= $tnas['departemen'] ?></td>
                    <td><?= $tnas['training'] ?></td>
                    <?php if ($tnas['status_approval_2'] == null) : ?>
                    <td><input type="date" value="<?= $tnas['mulai_training'] ?>" name="mulai-training<?= $i ?>"
                            id="mulai-training<?= $i ?>"></td>
                    <td><input type="date" value="<?= $tnas['rencana_training'] ?>" name="rencana-training<?= $i ?>"
                            id="rencana-training<?= $i ?>"></td>
                    <td>Rp.<?= $tnas['biaya'] ?></td>
                    <td>
                        <div class="d-flex flex-row">
                            <label for="biaya" class="h6">Rp.</label>
                            <input type="text" id="biaya<?= $i ?>" name="biaya<?= $i ?>"
                                value="<?= $tnas['biaya_actual'] ?>">
                        </div>
                    </td>
                    <td>
                        <a id="acceptadmin<?= $i ?>" href="javascript:;" class="btn btn-success btn-sm "
                            style="width:100px;color:white;" data-acceptadmin="<?= $tnas['id_tna'] ?>"
                            onclick="AcceptAdmin(<?= $i ?>)"><i class=" fa fa-fw fa-check"></i>Accept</a>
                        <a id="reject-admin<?= $i ?>" href="javascript:;"
                            class="admin-verify btn btn-danger btn-sm mt-1 " style="width:100px;"
                            data-reject-admin="<?= $tnas['id_tna']  ?>" onclick="verify_admin(<?= $i ?>)"><i
                                class="fa fa-fw fa-close"></i>Reject</a>
                        <input type="hidden" id="reject-admin-input<?= $i ?>" value="<?= $tnas['id_tna'] ?>">

                    </td>
                    <?php else : ?>
                    <td><?= $tnas['mulai_training'] ?></td>
                    <td><?= $tnas['rencana_training'] ?></td>
                    <td>Rp<?= " " . number_format($tnas['biaya'], 0, ',', '.') ?></td>
                    <td>
                        Rp<?= " " . number_format($tnas['biaya_actual'], 0, ',', '.') ?>
                    </td>
                    <td>
                        accept
                    </td>
                    <?php endif; ?>
                </tr>
                <div class=" modal fade" id="rejectAdmin<?= $i ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masukan Alasan Di Reject</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column">
                                    <label for="alasan">Alasan</label>
                                    <textarea id="alasan<?= $i ?>" class="mt-1" name="alasan<?= $i ?>"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a id="admin-reject<?= $i ?>" href="javascript:;" class="btn btn-danger btn-sm mt-1"
                                    style="width:100px;color:white;" onclick="Reject_Admin(<?= $i ?>) "><i
                                        class=" fa fa-fw fa-close"></i>Reject</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
//for change TNA 
// $("#btn-accept-admin-admin").on('click', function() {
//     var id_tna = $('#accept-admin').val();
//     var biaya_actual = $('#biaya').val();
//     console.log(id_tna);
//     console.log(biaya_actual);
//     $.ajax({
//         type: 'post',
//         url: "<?= base_url(); ?>/accept_adminfixed",
//         async: true,
//         dataType: "json",
//         data: {
//             id_tna: id_tna,
//             biaya_actual: biaya_actual
//         },
//         success: function(data) {
//             window.location.reload()

//         }

//     })
// })

// //for reject tna
// $("#btn-reject").on('click', function() {
//     var id_tna = $('#reject').val();
//     var biaya_actual = $('#biaya').val();
//     console.log(id_tna);
//     console.log(biaya_actual);
//     $.ajax({
//         type: 'post',
//         url: "<?= base_url(); ?>/reject_adminfixed",
//         async: true,
//         dataType: "json",
//         data: {
//             id_tna: id_tna,
//             biaya_actual: biaya_actual
//         },
//         success: function(data) {
//             window.location.reload()

//         }

//     })
// })
</script>
<?= $this->endSection() ?>