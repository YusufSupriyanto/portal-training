<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card p-2 overflow-auto">
    <h4>
        <center>Form Evaluasi Efektivitas Training</center>
    </h4>
    <?php foreach ($evaluasi as $evaluation) : ?>
    <input type="hidden" value="<?= $evaluation['id_tna'] ?>" name="id_tna">
    <div class="form-group">
        <label>Nama Peserta Training</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $evaluation['nama'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Npk/Dept/Seksi</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-regular fa-id-badge"></i>
                </span>
            </div>
            <input type="text" class="form-control"
                value="<?= $evaluation['npk'] . "/" . $evaluation['departemen'] . "/" . $evaluation['seksi'] ?>"
                disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Jabatan</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-sitemap"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $evaluation['bagian'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Nama Training </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-book"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $evaluation['training'] ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Tanggal Pelaksanaan</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-clock"></i>
                </span>
            </div>
            <input type="text" class="form-control"
                value="<?= date('d-M-Y', strtotime($evaluation['mulai_training'])) . " ------- " . date('d-M-Y', strtotime($evaluation['rencana_training'])) ?>"
                disabled>
        </div>
    </div>
    <div class="form-group">
        <label>Lembaga Penyelenggara </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-building-columns"></i>
                </span>
            </div>
            <input type="text" class="form-control" value="<?= $evaluation['vendor'] ?>" disabled>
        </div>
    </div>
    <?php endforeach; ?>
    <div>
        <div>
            <h6>Item Penilaian</h6>
            <p>
                1. Apakah pengetahuan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti pelatihan?
                (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="4">
                    <label>4(BS)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="3">
                    <label>3(B)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="2">
                    <label>2(C)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="1">
                    <label>1(K)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note1"
                        required></textarea>
                </div>
            </div>
            <p>
                2. Apakah keterampilan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti
                pelatihan?
                (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="4">
                    <label>4(BS)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="3">
                    <label>3(B)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="2">
                    <label>2(C)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="1">
                    <label>1(K)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note2"
                        required></textarea>
                </div>
            </div>
            <p>
                3. Apakah performance karyawan meningkat setelah mengikuti pelatihan? (Beri ketarangan, mis :
                peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="4">
                    <label>4(BS)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="3">
                    <label>3(B)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="2">
                    <label>2(C)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="1">
                    <label>1(K)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note3"
                        required></textarea>
                </div>
            </div>
            <p>
                4. Apakah ada perubahan sikap (positif) setelah karyawan mengikuti training ini ? (Beri
                keterangan,
                mis : perubahan sikap karyawan apa yang dirasakan oleh Atasan)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="4">
                    <label>4(BS)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="3">
                    <label>3(B)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="2">
                    <label>2(C)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="1">
                    <label>1(K)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note4"
                        required></textarea>
                </div>
            </div>
            <p>
                5. Apakah pelatihan yang diikuti karyawan sudah diterapkan di pekerjaannya sehari - hari ?
                (beri
                keterangan, mis : diterapkan dalam bentuk apa)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="4"
                        onclick="jumlah()">
                    <label>4(BS)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="3"
                        onclick="jumlah()">
                    <label>3(B)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="2"
                        onclick="jumlah()">
                    <label>2(C)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="1"
                        onclick="jumlah()">
                    <label>1(K)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="note5"
                        required></textarea>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-center">
            <label>Rata-Rata</label><br>
            <div class="card">
                <h5 id="rata-rata"></h5>
            </div>

        </div>
    </div>
</div>
<script>
function jumlah() {
    var pengetahuan = $("input[name='pengetahuan[]']:checked").val()
    var keterampilan = $("input[name='keterampilan[]']:checked").val()
    var performance = $("input[name='performance[]']:checked").val()
    var perubahan = $("input[name='perubahan[]']:checked").val()
    var pelatihan = $("input[name='pelatihan[]']:checked").val()
    var jumlah = parseFloat(pengetahuan) + parseFloat(keterampilan) + parseFloat(performance) + parseFloat(
            perubahan) +
        parseFloat(
            pelatihan)
    $('#rata-rata').text(jumlah / 5)
    var rata_rata = jumlah / 5
    console.log(rata_rata)
    if (rata_rata <= 1.9) {
        $('#kesimpulan1').prop('checked', true)
    } else if (rata_rata <= 2.9) {
        $('#kesimpulan2').prop('checked', true)
    } else if (rata_rata <= 3.9) {
        $('#kesimpulan3').prop('checked', true)
    } else {
        $('#kesimpulan4').prop('checked', true)

    }
}
</script>
<?= $this->endSection() ?>