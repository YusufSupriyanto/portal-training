<?= $this->extend('/template/template') ?>
<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <?php $i = 0;


    foreach ($departemen as $dept) : ?>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Training</th>
                    <th>Vendor</th>
                    <th>Start Training</th>
                    <th>Finished Training</th>
                    <th>Planning Budget</th>
                    <th>Actual Budget</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="admin-verify">
                <?php
                    $status = $stat->getKadivAccept($date, $year, $dept['departemen']);
                    // dd($status);
                    foreach ($status as $tnas) : ?>
                <tr>
                    <td><?= $tnas['nama'] ?></td>
                    <td><?= $tnas['departemen'] ?></td>
                    <td><?= $tnas['training'] ?></td>
                    <?php if ($tnas['status_approval_2'] == null) : ?>
                    <td><input style="width:130px;" class=" form-control" type="text" name="vendor<?= $i ?>"
                            id="vendor<?= $i ?>" value="<?= $tnas['vendor'] ?>"></td>
                    <td><input class="form-control" type="date" value="<?= $tnas['mulai_training'] ?>"
                            name="mulai-training<?= $i ?>" id="mulai-training<?= $i ?>"></td>
                    <td><input class="form-control" type="date" value="<?= $tnas['rencana_training'] ?>"
                            name="rencana-training<?= $i ?>" id="rencana-training<?= $i ?>"></td>
                    <td><?= "Rp. " . number_format($tnas['biaya'], 0, ',', '.'); ?></td>
                    <td>
                        <div class="d-flex flex-row">
                            <input style="width:130px;" class="form-control" type="text" id="biaya<?= $i ?>"
                                name="biaya<?= $i ?>"
                                value="<?= "Rp. " . number_format($tnas['biaya_actual'], 0, ',', '.'); ?>"
                                onkeyup="rupiah('biaya<?= $i ?>')">
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
                    <td><?= $tnas['vendor'] ?></td>
                    <td><?= $tnas['mulai_training'] ?></td>
                    <td><?= $tnas['rencana_training'] ?></td>
                    <td>Rp<?= " " . number_format($tnas['biaya'], 0, ',', '.') ?></td>
                    <td>
                        Rp<?= " " . number_format($tnas['biaya_actual'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <?= $tnas['status_approval_2'] ?>
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
    <?php $budgets = $budget->getDataBudgetById($status[0]['id_budget']); ?>
    <div class="m-3 d-flex justify-content-around">
        <div><strong>Alocated Budget : </strong>
            <?= "Rp " . number_format($budgets['alocated_budget'], 0, ',', '.') ?>
        </div>
        <div><strong>Available
                Budget : </strong><?= "Rp " . number_format($budgets['available_budget'], 0, ',', '.') ?></div>
        <div><strong>Used Budget : </strong><?= "Rp " . number_format($budgets['used_budget'], 0, ',', '.') ?></div>
        <div><strong>Accrual Budget:

            </strong><?= "Rp " . number_format($budgets['temporary_calculation'], 0, ',', '.') ?>
        </div>

    </div>
    <?php endforeach; ?>
    <!-- /.card-body -->
</div>
<script>
function rupiah(id) {

    var rupiah = document.getElementById(id);
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

}
</script>
<?= $this->endSection() ?>