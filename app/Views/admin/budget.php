<?= $this->extend('/template/template') ?>

<?= $this->section('content') ?>
<div class="success" data-success="<?= session()->get('success'); ?>"></div>
<div class="card m-1" style="height:600px;">
    <div class="d-flex">
        <div class="card card-primary m-1 " style="width:40%;">
            <div class="card-header">
                <h3 class="card-title">Input Budget</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>/save_budget" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Departemen</label>
                        <select class="form-control">
                            <option>choose....</option>
                            <?php foreach ($department as $dept) : ?>
                            <option value="<?= $dept['departemen'] ?>"><?= $dept['departemen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Alocated Budget Training</label>
                        <input type="alocated" class="form-control" id="rupiah" name="alocated" placeholder="Alocated">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputtahun1">Tahun Training</label>
                        <input type="tahun" class="form-control" id="exampleInputtahun1" placeholder="Tahun">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="card m-1" style="width:60%;">
            <div class="card-header">
                <h3 class="card-title"><?= $tittle ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Departemen</th>
                            <th>Alocated Budget Training</th>
                            <th>Tahun Training</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
var rupiah = document.getElementById("rupiah");
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
</script>

<?= $this->endSection() ?>