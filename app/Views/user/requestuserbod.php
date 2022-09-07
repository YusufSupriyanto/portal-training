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
                <th>Budget</th>
                <th>Actual Budget</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody id="bod-verify">
                <?php $i = 0;
                foreach ($status as $statuses) : ?>
                <tr>
                    <td><?= $statuses['nama'] ?></td>
                    <td><?= $statuses['training'] ?></td>
                    <td><?= $statuses['jenis_training'] ?></td>
                    <td><?= $statuses['kategori_training'] ?></td>
                    <td><?= $statuses['metode_training'] ?></td>
                    <td><?= $statuses['rencana_training'] ?></td>
                    <td><?= $statuses['biaya'] ?></td>
                    <td><?= $statuses['biaya_actual'] ?></td>
                    <td>
                        <a onclick="AcceptBod(<?= $i ?>)" id="accept-bod<?= $i ?>" href="javascript:;"
                            class="btn btn-success btn-sm " style="width:100px;color:white;"
                            data-accept-kadiv="<?= $statuses['id_tna'] ?>"><i class=" fa fa-fw fa-check"></i>Accept</a>
                        <input type="hidden" id="accept-bod-input<?= $i ?>" value="<?= $statuses['id_tna'] ?>">
                        <a onclick="verify_bod(<?= $i ?>)" id="reject-bod<?= $i ?>" href="javascript:;"
                            class="bod-verify btn btn-danger btn-sm mt-1 " style="width:100px;"><i
                                class="fa fa-fw fa-close"></i>Reject</a>
                        <input type="hidden" id="reject-bod-input<?= $i ?>" value="<?= $statuses['id_tna'] ?>">
                    </td>
                </tr>
                <div class=" modal fade" id="rejectBod<?= $i ?>" tabindex="-1" role="dialog"
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
                                    style="width:100px;color:white;" onclick="Reject_Bod(<?= $i ?>) "><i
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
</div>
<?= $this->endSection() ?>