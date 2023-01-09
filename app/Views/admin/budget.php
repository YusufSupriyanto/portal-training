<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-1" style="height:700px;">
    <div class="d-flex">
        <div class="card card-primary m-1 " style="width:30%">
            <div class="card-header">
                <h3 class="card-title">Input Budget</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>/save_budget" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="id_budget" id="id_budget">
                        <label>Department</label>
                        <select class="form-control" name="department" id="department" required>
                            <option>choose....</option>
                            <?php foreach ($department as $dept) : ?>
                            <option value="<?= $dept['departemen'] ?>"><?= $dept['departemen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alocated">Alocated Budget Training</label>
                        <input type="alocated" class="form-control" id="alocated" name="alocated"
                            placeholder="Alocated Budget" onkeyup="rupiah('alocated')" required>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Used Budget Training</label>
                        <input type="used" class="form-control" id="used" name="used" placeholder="Used Budget"
                            onkeyup="rupiah('used')" required>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Available Budget Training</label>
                        <input type="available" class="form-control" id="available" name="available"
                            placeholder="Available Budget" onkeyup="rupiah('available')" required>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Temporary Calculation</label>
                        <input type="temporary" class="form-control" onkeyup="rupiah('temporary')" id="temporary"
                            name="temporary" placeholder="Temporary Calculation" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputtahun1">Training Year</label>
                        <input type="text" class="form-control" name="year" id="year" required placeholder="Tahun">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-left">
                        <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-floppy-disk"></i>Save</button>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-warning" onclick="clean()"><i
                                class="fa-solid fa-broom"></i>Clean</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card m-1" style="width:80%;">
            <div class="card-header">
                <h3 class="card-title"><?= $tittle ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" id="budgetTable">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Alocated Budget Training</th>
                            <th>Used Budget Training</th>
                            <th>Available Budget Training</th>
                            <th>Temporary Calculation</th>
                            <th>Tahun Training</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($budget as $budgets) : ?>
                        <tr>
                            <td><?= $budgets['department'] ?></td>
                            <td><?= $number = "Rp. " . number_format($budgets['alocated_budget'], 0, ',', '.'); ?></td>
                            <td><?= $used = "Rp. " . number_format($budgets['used_budget'], 0, ',', '.'); ?></td>
                            <td><?= $available = "Rp. " . number_format($budgets['available_budget'], 0, ',', '.'); ?>
                            </td>
                            <td><?= $temporary = "Rp. " . number_format($budgets['temporary_calculation'], 0, ',', '.'); ?>
                            </td>
                            <td><?= $budgets['year'] ?></td>
                            <td>
                                <div>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="edit('<?= $budgets['id_budget'] ?>','<?= $budgets['department'] ?>','<?= $number ?>','<?= $used ?>','<?= $available ?>','<?= $temporary ?>','<?= $budgets['year'] ?>')"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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


function edit(id, department, number, used, available, temporary, year) {
    $('#id_budget').val(id)
    $('#department').val(department)
    $('#alocated').val(number)
    $('#available').val(available)
    $('#used').val(used)
    $('#temporary').val(temporary)
    $('#year').val(year)

}


function clean() {
    $('#id_budget').val("")
    $('#department').val("choose....")
    $('#alocated').val("")
    $('#used').val("")
    $('#available').val("")
    $('#temporary').val("")
    $('#year').val("")
}
</script>

<?= $this->endSection() ?>