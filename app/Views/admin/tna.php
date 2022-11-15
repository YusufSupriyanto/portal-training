<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<style>
.my-custom-scrollbar {
    position: relative;
    height: 200px;
    overflow: auto;
}

.table-wrapper-scroll-y {
    display: block;
}
</style>
<div class="card m-1 " style="font-size:15px;">
    <?php $i = 0;
    foreach ($dept as $d) : ?>
    <div class="card">
        <div class="card-header h6 d-flex justify-content-between">
            <div>
                <h3 class="card-title">Daftar Training Need Analysis</h3>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-hover table-striped table-bordered mb-0 overflow-auto">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Training</th>
                        <th>Request Training</th>
                        <th>Mulai Training</th>
                        <th>Selesai Training</th>
                        <th>Planing Budget</th>
                        <th>Actual Budget</th>
                        <th>Vendor</th>
                        <th>Tempat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tna-admin">
                    <?php
                        $deptTna = $tna->getStatusWaitAdmin($d->departemen);
                        foreach ($deptTna as $tnas) : ?>
                    <tr>
                        <td><?= $tnas->nama ?></td>
                        <td><?= $tnas->departemen ?></td>
                        <td><?= $tnas->training ?></td>
                        <td>
                            <div style="width:60px;"><?= $tnas->request_training ?></div>
                        </td>
                        <td><input type="date" value="<?= $tnas->mulai_training ?>" name="mulai-training<?= $i ?>"
                                id="mulai-training<?= $i ?>"></td>
                        <td><input type="date" value="<?= $tnas->rencana_training ?>" name="rencana-training<?= $i ?>"
                                id="rencana-training<?= $i ?>"></td>
                        <td>
                            <h6 style="width:90px;">
                                Rp<span><?= " " . number_format($tnas->biaya, 0, ',', '.') ?></span></h6>
                        </td>
                        <td>
                            <div class="d-flex flex-row">
                                <label for="biaya" class="h6">Rp</label>
                                <input type="text" id="biaya<?= $i ?>" name="biaya<?= $i ?>"
                                    onchange="format(<?= $i ?>)">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-row">
                                <input type="text" id="vendor<?= $i ?>" name="vendor<?= $i ?>">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-row">
                                <input type="text" id="tempat<?= $i ?>" name="tempat<?= $i ?>">
                            </div>
                        </td>
                        <td>
                            <a id="accept<?= $i ?>" href="javascript:;" class="btn btn-success btn-sm "
                                style="width:100px;color:white;" data-accept="<?= $tnas->id_tna ?>"
                                onclick="Accept(<?= $i ?>)"><i class=" fa fa-fw fa-check"></i>Accept</a>
                            <a id="reject<?= $i ?>" href="javascript:;" class="btn btn-danger btn-sm mt-3"
                                style="width:100px;color:white;" data-reject="<?= $tnas->id_tna ?>"
                                onclick="Reject(<?= $i ?>)"><i class=" fa fa-fw fa-close"></i>Reject</a>
                            <a href="javascript:;" class="item-edit btn btn-primary btn-sm mt-3"
                                style="width:100px;color:white;" data="<?= $tnas->id_tna ?>"><i
                                    class=" fa fa-fw fa-file-text-o"></i>Detail</a>
                        </td>
                    </tr>
                    <?php $i++;
                        endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php $budgets = $budget->getBudgetCurrent($d->departemen); ?>
        <div class="d-flex justify-content-around">
            <div><strong>Alocated Budget : </strong>
                <?= "Rp " . number_format($budgets['alocated_budget'], 0, ',', '.') ?>
            </div>
            <div><strong>Available
                    Budget : </strong><?= "Rp " . number_format($budgets['available_budget'], 0, ',', '.') ?></div>
            <div><strong>Used Budget : </strong><?= "Rp " . number_format($budgets['used_budget'], 0, ',', '.') ?></div>
            <div><strong>Actual Jumlah :
                </strong><?= "Rp " . number_format($budgets['temporary_calculation'], 0, ',', '.') ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- /.card-body -->
    <div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Training Need Analysis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <label for="nama">Nama</label>
                        <input id="nama" class="nama" name="nama" readonly></input>
                        <label for="dic">Dic</label>
                        <input id="dic" class="dic" name="dic" readonly></input>
                        <label for="divisi">Divisi</label>
                        <input id="divisi" class="divisi" name="divisi" readonly></input>
                        <label for="departemen">Departemen</label>
                        <input id="departemen" class="departemen" name="departemen" readonly></input>
                        <label for="training">Training</label>
                        <input id="training" class="mt-1" name="training" readonly></input>
                        <label for="jenis-training">Jenis Training</label>
                        <input id="jenis-training" class="mt-1" name="jenis-training" readonly></input>
                        <label for="kategori-training">Kategori Training</label>
                        <input id="kategori-training" class="mt-1" name="kategori-training" readonly></input>
                        <label for="metode-training">Metode Training</label>
                        <input id="metode-training" class="mt-1" name="metode-training" readonly></input>
                        <label for="mulai-training">Mulai Training</label>
                        <input id="mulai-training" class="mt-1" name="mulai-training" readonly></input>
                        <label for="Selesai-training">Selesai Training</label>
                        <input id="Selesai-training" class="mt-1" name="Selesai-training" readonly></input>
                        <label for="tujuan-training">Tujuan Training</label>
                        <input id="tujuan-training" class="mt-1" name="tujuan-training" readonly></input>
                        <label for="notes">Note</label>
                        <textarea id="notes" class="mt-1" name="notes" readonly></textarea>
                        <label for="budget">Budget</label>
                        <input id="budget" class="mt-1" name="budget" readonly></input>
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