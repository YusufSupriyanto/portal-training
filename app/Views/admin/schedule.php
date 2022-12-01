<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="card m-1">
    <div class="card-header">
        <h3 class="card-title"><?= $tittle ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="personal-schedule">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Judul Training</th>
                    <th>Jenis Training</th>
                    <th>Kategori Training</th>
                    <th>Metode Training</th>
                    <th>Tujuan Training</th>
                    <th>Rencana Training</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach ($schedule as $Atmps) : ?>
            <tr>
                <td><?= $Atmps['nama'] ?></td>
                <td><?= $Atmps['departemen'] ?></td>
                <td><?= $Atmps['training'] ?></td>
                <td><?= $Atmps['jenis_training'] ?></td>
                <td><?= $Atmps['kategori_training'] ?></td>
                <td><?= $Atmps['metode_training'] ?></td>
                <td><?= $Atmps['tujuan_training'] ?></td>
                <td><?= $Atmps['rencana_training'] ?></td>
                <?php $page = basename($_SERVER['PHP_SELF']);
                    if ($page == 'schedule_training') : ?>
                <td>
                    <div class="d-flex flex-column">
                        <a href="<?= base_url() ?>/schedule_action/<?= $Atmps['id_tna'] ?>"
                            class="btn btn-success btn-sm" style="font-size:10px;">Sudah Terlaksana</a>
                        <button onclick="ModalReasons(<?= $Atmps['id_tna'] ?>)" class="btn btn-danger btn-sm mt-2"
                            style="font-size:10px;">Tidak
                            Terlaksana</button>
                    </div>

                </td>
                <?php else : ?>
                <td>
                    <div>
                        <a href="<?= base_url() ?>/schedule_action_unplanned/<?= $Atmps['id_tna'] ?>"
                            class="btn btn-success btn-sm" style="font-size:10px;">Sudah Terlaksana</a>
                        <button onclick="ModalReasons(<?= $Atmps['id_tna'] ?>)" class="btn btn-danger btn-sm mt-2"
                            style="font-size:10px;">Tidak
                            Terlaksana</button>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- Modal -->
<div class="modal fade" id="Reason" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Alasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>/schedule_not_implemented" method="post">
                    <input type="hidden" name="id_tna" id="id_tna">
                    <div class="d-flex justify-content-center">
                        <textarea rows="4" cols="50" name="alasan"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary" "><i class=" fa-solid fa-paper-plane"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
function ModalReasons(id) {
    jQuery.noConflict();
    $('#id_tna').val(id)
    $('#Reason').modal('show')

}
</script>
<?= $this->endSection() ?>