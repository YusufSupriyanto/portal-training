<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<style>
.styling {
    display: flex;
    justify-content: space-around;
    align-items: center;

}

@media (max-width: 480px) {
    .styling {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
}
</style>
<form action="<?= base_url() ?>/save_efektivitas" method="post">
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
            </div>
            <div class="d-flex justify-content-center">
                <h5 id="rata-rata"></h5>
            </div>
        </div>
        <div>
            <h4>Kesimpulan</h4>
            <h5>A. pelatihan ini</h5>
            <div class="ml-3">
                <input type="radio" class="form-check-input" id="kesimpulan4" name="kesimpulan4" value="4">Signifikan
                untuk pekerjaan (Total Hasil : 4)<br>
                <input type="radio" class="form-check-input" id="kesimpulan3" name="kesimpulan3" value="3">Bermanfaat
                untuk pekerjaan (Total Hasil : 3-3,9)<br>
                <input type="radio" class="form-check-input" id="kesimpulan2" name="kesimpulan2" value="2">Cukup
                bermanfaat untuk pekerjaan (Total Hasil : 2-2,9)<br>
                <input type="radio" class="form-check-input" id="kesimpulan1" name="kesimpulan1" value="1">Kurang
                bermanfaat untuk pekerjaan (Total Hasil : 1-1,9)
            </div>
        </div>
        <div id="adding">
            <h5 class="mt-3">B. Apakah Ada Peningkatan Kopetensi Karyawan Setelah Pelatihan Ini</h5>
            <div>
                <div class="styling">
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                        <input type="text" name="kompetensi1">
                    </div>
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Ada Peningkatan/Tidak<span style="color:red;">*</span></h6>
                        <select class="custom-select" name="perubahan1" id="perubahan1" style="width:200px;">
                            <option value="Ya" selected>Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Jika Ya<span style="color:red;">*</span></h6>
                        <input type="text" name="keterangan1">
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-success btn-sm" onclick="adding(1)"><i
                            class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end m-3">
            <button type="submit" class="btn btn-primary btn-lm"><i class="fa fa-fw fa-send"></i>Send</button>
        </div>
    </div>
</form>
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

function adding(i) {
    i++
    if (i <= 5) {
        $('#adding').append(`
<div id="${i}">
            <div class="styling">
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                    <input type="text" name="kompetensi${i}">
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Ada Peningkatan/Tidak<span style="color:red;">*</span></h6>
                    <select class="custom-select" name="perubahan${i}" id="perubahan${i}" style="width:200px;">
                        <option value="Ya" selected>Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Jika Ya<span style="color:red;">*</span></h6>
                    <input type="text" name="keterangan${i}">
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-sm" onclick="adding(${i})"><i
                        class="fa-solid fa-plus"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" id="removed${i}" onclick="removed(${i})"><i
                        class="fa fa-close"></i></button>
            </div>
        </div>
`)
    }
}

function removed(i) {
    $('#removed' + i).closest('#' + i).remove();
}
</script>
<?= $this->endSection() ?>