<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>

<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<style>
.mini-input {
    width: 30px;
}
</style>
<div class="d-flex">
    <div class="card m-1">
        <div class="card-header d-flex justify-content-center">
            <h3 class=" card-title">Technical Competency Departemen <?= $department ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" id="CompetencyAstra">

                <thead>
                    <tr>
                        <th>Technical Competency</th>
                        <th>Kepala Sub Seksi</th>
                        <th>Kepala Regu</th>
                        <th>Staff</th>
                        <th>Adm / Data Entry</th>
                        <th>Operator</th>
                        <th>Security</th>
                        <th>Supply Man</th>
                        <th>Supporting Assembling A</th>
                        <th>Supporting Assembling B</th>
                        <th>Driver Forklift</th>
                        <th>Driver</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($department0 as $position) : ?>
                    <tr>
                        <td><?= $position['technicalB'] ?></td>
                        <td><?= $position['kepala_sub_seksi'] ?></td>
                        <td><?= $position['kepala_regu'] ?></td>
                        <td><?= $position['staff'] ?></td>
                        <td><?= $position['data_entry'] ?></td>
                        <td><?= $position['operator'] ?></td>
                        <td><?= $position['security'] ?></td>
                        <td><?= $position['supply_man'] ?></td>
                        <td><?= $position['supporting_assembly_a'] ?>
                        </td>
                        <td><?= $position['supporting_assembly_b'] ?>
                        </td>
                        <td><?= $position['driver_forklift'] ?></td>
                        <td><?= $position['driver'] ?></td>
                        <td>
                            <div class="d-flex">
                                <div class="mr-2">
                                    <form
                                        action="<?= base_url() ?>/delete_technicalB/<?= $position['id_technicalB'] ?>/<?= $department ?>"
                                        method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        onclick="ModalCompetency('<?= $position['id_technicalB'] ?>','<?= $position['technicalB'] ?>','<?= $position['kepala_sub_seksi'] ?>','<?= $position['kepala_regu'] ?>','<?= $position['staff'] ?>','<?= $position['data_entry'] ?>','<?= $position['operator'] ?>','<?= $position['security'] ?>','<?= $position['supply_man'] ?>','<?= $position['supporting_assembly_a'] ?>','<?= $position['supporting_assembly_b'] ?>','<?= $position['driver_forklift'] ?>','<?= $position['driver'] ?>')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalCompetency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Competency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?= base_url() ?>/save_single_technicalB" method="post">
                    <div class="d-flex">
                        <div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="technical">Tecnical</label>
                                    <input type="hidden" class="form-control" id="department" name="department"
                                        value="<?= $department ?>">
                                    <input type="hidden" class="form-control" id="id_technical" name="id_technical">
                                    <input type="text" class="form-control" id="technical" name="technical"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="kesubsek">Kepala Sub Seksi</label>
                                    <input type="text" class="form-control" id="kesubsek" name="kesubsek"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="kepreg">Kepala Regu</label>
                                    <input type="text" class="form-control" id="kepreg" name="kepreg"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="staff">Staff</label>
                                    <input type="text" class="form-control" id="staff" name="staff"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="ade">ADM/Data Entry</label>
                                    <input type="text" class="form-control" id="ade" name="ade"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="operator">Operator</label>
                                    <input type="text" class="form-control" id="operator" name="operator"
                                        placeholder="Competency">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="security">Security</label>
                                    <input type="text" class="form-control" id="security" name="security"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="supply">Supply Man</label>
                                    <input type="text" class="form-control" id="supply" name="supply"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="assembling_a">Supporting Assembling A</label>
                                    <input type="text" class="form-control" id="assembling_a" name="assembling_a"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="assembling_b">Supporting Assembling B</label>
                                    <input type="text" class="form-control" id="assembling_b" name="assembling_b"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="driver_forklift">Driver Forklift</label>
                                    <input type="text" class="form-control" id="driver_forklift" name="driver_forklift"
                                        placeholder="Competency">
                                </div>
                                <div class="form-group">
                                    <label for="driver">Driver</label>
                                    <input type="text" class="form-control" id="driver" name="driver"
                                        placeholder="Competency">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="ml-4">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                        <div class="mr-4">
                            <button type="button" class="btn btn-warning" onclick="CleanCompetency()"><i
                                    class="fa-solid fa-broom"></i>Clean</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function ModalCompetency(id, technical, kesubsek, kepreg, staff, ade, operator, security, supply, assembling_a,
    assembling_b, driver_forklift, driver) {
    jQuery.noConflict()
    $('#ModalCompetency').modal('show')
    $('#id_technical').val(id)
    $('#technical').val(technical)
    $('#kesubsek').val(kesubsek)
    $('#kepreg').val(kepreg)
    $('#staff').val(staff)
    $('#ade').val(ade)
    $('#operator').val(operator)
    $('#security').val(security)
    $('#supply').val(supply)
    $('#assembling_a').val(assembling_a)
    $('#assembling_b').val(assembling_b)
    $('#driver_forklift').val(driver_forklift)
    $('#driver').val(driver)

}


function CleanCompetency() {
    $('#id_technical').val("")
    $('#technical').val("")
    $('#kesubsek').val("")
    $('#kepreg').val("")
    $('#staff').val("")
    $('#ade').val("")
    $('#operator').val("")
    $('#security').val("")
    $('#supply').val("")
    $('#assembling_a').val("")
    $('#assembling_b').val("")
    $('#driver_forklift').val("")
    $('#driver').val("")
}
</script>
<?= $this->endSection() ?>