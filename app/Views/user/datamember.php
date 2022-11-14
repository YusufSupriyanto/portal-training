<?= $this->extend('/template/templateuser') ?>

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

<div class="warning" data-warning="<?= session()->get('warning'); ?>"></div>
<div class="card m-1">
    <div class="card-header ">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Training Need Analysis</h3>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa-solid fa-share-from-square"></i><br>
                Submit TNA
            </button>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="member">
            <thead>
                <tr>
                    <th>NPK</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Divisi</th>
                    <th>Departemen</th>
                    <th>Bagian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($user as $users) : ?>
                <tr>
                    <td><?= $users->npk ?></td>
                    <td><?php if (session()->get('bagian') == 'BOD' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'KADEPT' ||  session()->get('bagian') == 'KASIE' ||  session()->get('bagian') == 'STAFF 4UP') : ?>
                        <form action="<?= base_url() ?>\form_tna" id="dataform<?= $i ?>" method="post">
                            <input type="hidden" name="member" id="member<?= $i ?>" value="<?= $users->id_user ?>">
                        </form>
                        <a href="#"
                            onclick="document.getElementById('dataform<?= $i ?>').submit();"><?= $users->nama ?></a>
                        <?php else : ?>
                        <?= $users->nama ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $users->status ?></td>
                    <td><?= $users->divisi ?></td>
                    <td><?= $users->departemen ?></td>
                    <td><?= $users->bagian ?></td>
                    <td><?= $users->status ?></td>
                </tr>
                <?php
                    $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" action="<?= base_url() ?>\tna\send">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">TNA Tersimpan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body p-0 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class=" table table-striped table-bordered mb-0 overflow-auto">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Training</th>
                                    <th>Jenis Training</th>
                                    <th>Kategori Training</th>
                                    <th>Metode Training</th>
                                    <th>Request Training</th>
                                    <th>Tujuan Training</th>
                                    <th>Notes</th>
                                    <th>Estimasi Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum = 0;
                                foreach ($tna as $Forms) : ?>
                                <tr>
                                    <td><?= $Forms->nama ?></td>
                                    <td><?= $Forms->training ?></td>
                                    <td><?= $Forms->jenis_training ?></td>
                                    <td><?= $Forms->kategori_training ?></td>
                                    <td><?= $Forms->metode_training ?></td>
                                    <td><?= $Forms->request_training ?></td>
                                    <td><?= $Forms->tujuan_training ?></td>
                                    <td><?= $Forms->notes ?></td>
                                    <td>
                                        <div><?= "Rp " . number_format($Forms->biaya, 0, ',', '.') ?></div>
                                    </td>
                                </tr>
                                <input type="hidden" value="<?= $Forms->id_tna ?>" name="training[]">
                                <?php
                                    $sum += $Forms->biaya;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="ml-4"><strong>Jumlah</strong></div>
                        <div style="margin-right:37px;"><strong><?= "Rp " . number_format($sum, 0, ',', '.') ?></strong>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around m-4">
                        <div class="ml-4">
                            <div><strong>Alocated
                                    Buduget :</strong>
                                <?php if ($budget != null) {
                                    echo "Rp " . number_format($budget['alocated_budget'], 0, ',', '.');
                                } else {
                                    echo 0;
                                } ?>
                            </div>
                        </div>
                        <div>
                            <strong>Available
                                Buduget :</strong>
                            <?php if ($budget != null) {
                                echo "Rp " . number_format($budget['available_budget'], 0, ',', '.');
                            } else {
                                echo 0;
                            } ?>
                        </div>
                        <div class="mr-4">
                            <strong>Used
                                Buduget :</strong>
                            <?php if ($budget != null) {
                                echo "Rp " . number_format($budget['used_budget'], 0, ',', '.');
                            } else {
                                echo 0;
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-send"></i>Submit TNA</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>