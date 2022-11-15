<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card overflow-auto m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <?php $i = 0;
    foreach ($departemen as $dept) : ?>
    <div class="card-body p-0 overflow-auto">
        <table class="table table-striped overflow-auto">
            <thead>
                <div class=" float-right mr-4">
                    <h6>Departemen : <?= $dept['departemen'] ?></h6>
                </div>

            </thead>
            <tr>
                <th>Nama</th>
                <th>Training</th>
                <th>Jenis Training</th>
                <th>Kategori Training</th>
                <th>Metode Training</th>
                <th>Mulai Training</th>
                <th>Selesai Training</th>
                <th>Tujuan Training</th>
                <th>Notes</th>
                <th>Estimasi Budget</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody id="kadiv-verify">
                <?php
                    $sum = 0;
                    $bagian = session()->get('bagian');
                    $dic = session()->get('dic');
                    $divisi = session()->get('divisi');
                    $departemen = session()->get('departemen');
                    $page = basename($_SERVER['PHP_SELF']);
                    if ($page == 'request_tna') {
                        if ($bagian == 'BOD') {
                            $stat = $status->getRequestTna($bagian, $dic, $dept['departemen']);
                        } elseif ($bagian == 'KADIV') {
                            $stat = $status->getRequestTna($bagian, $divisi, $dept['departemen']);
                        } elseif ($bagian == 'KADEPT') {
                            $stat = $status->getRequestTna($bagian, $departemen, $dept['departemen']);
                        }
                    } else {
                        if ($bagian == 'BOD') {
                            $stat = $status->getRequestTnaUnplanned($bagian, $dic, $dept['departemen']);
                        } elseif ($bagian == 'KADIV') {
                            $stat = $status->getRequestTnaUnplanned($bagian, $divisi, $dept['departemen']);
                        } elseif ($bagian == 'KADEPT') {
                            $stat = $status->getRequestTnaUnplanned($bagian, $departemen, $dept['departemen']);
                        }
                    }

                    foreach ($stat as $statuses) : ?>
                <tr>
                    <td><?= $statuses['nama'] ?></td>
                    <td><?= $statuses['training'] ?></td>
                    <td><?= $statuses['jenis_training'] ?></td>
                    <td><?= $statuses['kategori_training'] ?></td>
                    <td><?= $statuses['metode_training'] ?></td>
                    <td><?= $statuses['mulai_training'] ?></td>
                    <td><?= $statuses['rencana_training'] ?></td>
                    <td><?= $statuses['tujuan_training'] ?></td>
                    <td><?= $statuses['notes'] ?></td>
                    <td><?= "Rp " . number_format($statuses['biaya_actual'], 0, ',', '.') ?></td>
                    <td>

                        <a onclick="AcceptKadiv(<?= $i ?>)" id="accept-kadiv<?= $i ?>" href="javascript:;"
                            class="btn btn-success btn-sm " style="width:100px;color:white;"
                            data-accept-kadiv="<?= $statuses['id_tna'] ?>"><i class=" fa fa-fw fa-check"></i>Accept</a>
                        <input type="hidden" id="accept-kadiv-input<?= $i ?>" value="<?= $statuses['id_tna'] ?>">
                        <a id="reject-kadiv<?= $i ?>" href="javascript:;"
                            class="kadiv-verify btn btn-danger btn-sm mt-1 " style="width:100px;"
                            data-reject-kadiv="<?= $statuses['id_tna']  ?>" onclick="Kadiv_verify(<?= $i ?>)"><i
                                class="fa fa-fw fa-close"></i>Reject</a>
                        <input type="hidden" id="reject-kadiv-input<?= $i ?>" value="<?= $statuses['id_tna'] ?>">
                    </td>
                </tr>
                <div class=" modal fade" id="rejectKadiv<?= $i ?>" tabindex="-1" role="dialog"
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
                                    <textarea id="alasan<?= $i ?>" class="mt-1" name="alasan<?= $i ?>"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a id="kadiv-reject<?= $i ?>" href="javascript:;" class="btn btn-danger btn-sm mt-1"
                                    style="width:100px;color:white;" onclick="reject_kadiv(<?= $i ?>) "><i
                                        class=" fa fa-fw fa-close"></i>Reject</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        $sum += $statuses['biaya_actual'];
                        $i++;
                    endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php $budgets = $budget->getBudgetCurrent($dept['departemen']); ?>
    <div class="m-3 d-flex justify-content-around">
        <div><strong>Alocated Budget : </strong>
            <?= "Rp " . number_format($budgets['alocated_budget'], 0, ',', '.') ?>
        </div>
        <div><strong>Available
                Budget : </strong><?= "Rp " . number_format($budgets['available_budget'], 0, ',', '.') ?></div>
        <div><strong>Used Budget : </strong><?= "Rp " . number_format($budgets['used_budget'], 0, ',', '.') ?></div>
        <div><strong>Jumlah Actual Budget:

            </strong><?= "Rp " . number_format($budgets['temporary_calculation'], 0, ',', '.') ?>
        </div>

    </div>
    <?php endforeach; ?>
</div>
<script>

</script>
<?= $this->endSection() ?>