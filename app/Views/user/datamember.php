<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<style>
.my-custom-scrollbar {
    position: relative;
    height: 350px;
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
            <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KASIE' || session()->get('bagian') == 'BOD') : ?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fa-solid fa-share-from-square"></i><br>
                Submit TNA
            </button>
            <?php else : ?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalKadiv">
                <i class="fa-solid fa-share-from-square"></i><br>
                Submit TNA
            </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="member">
            <thead>
                <tr>
                    <th>NPK</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Section</th>
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
            <div class="modal-content"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">TNA Save</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card-body p-0 table-wrapper-scroll-y my-custom-scrollbar">
                    <table class=" table table-striped table-bordered mb-0 overflow-auto">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Training</th>
                                <th>Training Type</th>
                                <th>Training Category</th>
                                <th>Training Method</th>
                                <th>Training Request</th>
                                <th>Training Goals</th>
                                <th>Notes</th>
                                <th>Budget Estimation</th>
                                <th>Action</th>
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
                                <td></td>
                                <div><?= "Rp " . number_format($Forms->biaya, 0, ',', '.') ?></div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="DeleteTnaOther(<?= $Forms->id_tna ?>)">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <input type="hidden" value="<?= $Forms->id_tna ?>" name="training[]">
                            <?php
                                $sum += $Forms->biaya;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-around">
                    <div class="ml-4">
                        <div><strong>Alocated
                                Budget :</strong>
                            <?php if ($budget != null) {
                                echo "Rp " . number_format($budget['alocated_budget'], 0, ',', '.');
                            } else {
                                echo 0;
                            } ?>
                        </div>
                    </div>
                    <div>
                        <strong>Available
                            Budget :</strong>
                        <?php if ($budget != null) {
                            echo "Rp " . number_format($budget['available_budget'], 0, ',', '.');
                        } else {
                            echo 0;
                        } ?>
                    </div>
                    <div class="mr-4">
                        <strong>Used
                            Budget :</strong>
                        <?php if ($budget != null) {
                            echo "Rp " . number_format($budget['used_budget'], 0, ',', '.');
                        } else {
                            echo 0;
                        } ?>
                    </div>
                    <div class="ml-4"><strong>Total Budget Estimation:
                        </strong><?= "Rp " . number_format($sum, 0, ',', '.') ?>
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
<!-- Modal -->
<div class="modal fade" id="DeleteModalOther" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>\delete_training_user" method="post">
                <div class="modal-body"></div>
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="url" id="url" value="0">
                <h6><strong>Are You Sure !</strong></h6>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes!</button>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalKadiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" action="<?= base_url() ?>\tna\send">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">TNA Save</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body p-0 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class=" table table-bordered mb-0 overflow-auto">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Training</th>
                                    <th>Training Type</th>
                                    <th>Training Category</th>
                                    <th>Training Method</th>
                                    <th>Training Request</th>
                                    <th>Training Goals</th>
                                    <th>Notes</th>
                                    <th>Budget Estimation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php foreach ($user as $dept) : ?>
                            <tbody>
                                <?php

                                    $sum = 0;
                                    $tnafixes = $tnaKadept->getTnaFilterKadept(session()->get('id'), $dept->departemen);
                                    foreach ($tnafixes as $Forms) : ?>
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
                                    <?php $sum += $Forms->biaya ?>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="DeleteTna(<?= $Forms->id_tna ?>)">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <input type="hidden" value="<?= $Forms->id_tna ?>" name="training[]">
                                <?php endforeach; ?>
                                <?php $budgets = $budgetKadept->getBudgetCurrent($dept->departemen) ?>
                                <?php if (isset($budgets)) : ?>
                                <tr style="background-color:aliceblue;">
                                    <td><strong><?= $dept->departemen ?></strong></td>
                                    <td><strong>Alocated Budget</strong></td>
                                    <td><?= "Rp " . number_format($budgets['alocated_budget'], 0, ',', '.') ?></td>
                                    <td><strong>Available Budget</strong></td>
                                    <td><?= "Rp " . number_format($budgets['available_budget'], 0, ',', '.') ?></td>
                                    <td><strong>Used Budget</strong></td>
                                    <td><?= "Rp " . number_format($budgets['used_budget'], 0, ',', '.') ?></td>
                                    <td><strong>Total Budget Estimation</strong></td>
                                    <td><?= "Rp " . number_format($sum, 0, ',', '.') ?></td>

                                </tr>
                                <?php else : ?>
                                <tr style="background-color:aliceblue;">
                                    <td><strong><?= $dept->departemen ?></strong></td>
                                    <td><strong>Alocated Budget</strong></td>
                                    <td><?= "Rp " . number_format(0, 0, ',', '.') ?></td>
                                    <td><strong>Available Budget</strong></td>
                                    <td><?= "Rp " . number_format(0, 0, ',', '.') ?></td>
                                    <td><strong>Used Budget</strong></td>
                                    <td><?= "Rp " . number_format(0, 0, ',', '.') ?></td>
                                    <td><strong>Total Budget Estimation</strong></td>
                                    <td><?= "Rp " . number_format(0, 0, ',', '.') ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                            <?php
                            endforeach; ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-send"></i>Submit
                            TNA</button>
                    </div>
                </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url() ?>\delete_training_user" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="idkadiv">
                    <input type="hidden" name="url" id="url" value="0">
                    <h6><strong>Are You Sure!</strong></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function DeleteTna(id) {
    jQuery.noConflict();
    $('#DeleteModal').modal('show')
    $('#idkadiv').val(id);

}

function DeleteTnaOther(id) {
    jQuery.noConflict();
    $('#DeleteModalOther').modal('show')
    $('#id').val(id);

}
</script>


<?= $this->endSection() ?>