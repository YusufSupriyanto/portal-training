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
            <label>Name of Training Participant</label>
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
            <label>Npk/Dept/Section</label>
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
            <label>Position</label>
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
            <label>Training Name</label>
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
            <label>Implementation Date</label>
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
            <label>Organizing Agency </label>
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
                        <label>4(Baik Sekali)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="3">
                        <label>3(Baik)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="2">
                        <label>2(Cukup)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="1">
                        <label>1(Kurang)</label>
                    </div>
                    <div class="form-group">
                        <label>keterangan<span style="color:red;">*</span></label>
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
                        <label>4(Baik Sekali)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="3">
                        <label>3(Baik)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="2">
                        <label>2(Cukup)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="1">
                        <label>1(Kurang)</label>
                    </div>
                    <div class="form-group">
                        <label>keterangan<span style="color:red;">*</span></label>
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
                        <label>4(Baik Sekali)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="3">
                        <label>3(Baik)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="2">
                        <label>2(Cukup)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="performance[]" value="1">
                        <label>1(Kurang)</label>
                    </div>
                    <div class="form-group">
                        <label>keterangan<span style="color:red;">*</span></label>
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
                        <label>4(Baik Sekali)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="3">
                        <label>3(Baik)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="2">
                        <label>2(Cukup)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="1">
                        <label>1(Kurang)</label>
                    </div>
                    <div class="form-group">
                        <label>keterangan<span style="color:red;">*</span></label>
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
                        <label>4(Baik Sekali)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="3"
                            onclick="jumlah()">
                        <label>3(Baik)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="2"
                            onclick="jumlah()">
                        <label>2(Cukup)</label>
                    </div>
                    <div class="m-4">
                        <input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="1"
                            onclick="jumlah()">
                        <label>1(Kurang)</label>
                    </div>
                    <div class="form-group">
                        <label>keterangan<span style="color:red;">*</span></label>
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
                <input id="rata-rata" name="score" style="text-align:center" readonly>
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
            <h5 class="mt-3">B. Apakah Ada Peningkatan Kompetensi Karyawan Setelah Pelatihan Ini</h5>
            <div>
                <div class="styling">
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                        <select class="custom-select" name="kompetensi1" id="kompetensi1" style="width:200px;">
                            <option
                                value="<?= $competency[0]['id'] ?>,<?= $competency[0]['keterangan'] ?>,<?= $competency[0]['score'] ?>,<?= $competency[0]['category']; ?>"
                                selected><?= $competency[0]['category']; ?></option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Ada Peningkatan/Tidak<span style="color:red;">*</span></h6>
                        <select class="custom-select" name="perubahan1" id="perubahan1" style="width:200px;">
                            <option value="Ya" selected>Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6><span>Score Sebelumnya</span></h6>
                        <input type="text" class="form-control" name="keterangan1"
                            value="<?= $competency[0]['score']; ?>" readonly>

                    </div>
                    <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Score Setelah Training<span style="color:red;">*</span></h6>
                        <select class="custom-select" name="nilai1" required>
                            <option value="">Choose...</option>
                            <option value="0.5">0,5</option>
                            <option value="1">1</option>
                            <option value="1.5">1,5</option>
                            <option value="2">2</option>
                            <option value="2.5">2,5</option>
                            <option value="3">3</option>
                            <option value="3.5">3,5</option>
                            <option value="4">4</option>
                        </select>
                        <input type="hidden" value="<?= $evaluation['id_nilai'] ?>" name="id_nilai" name="id_nilai">
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-success btn-sm mt-2" style="margin-left:38px;"
                        onclick="adding(1)"><i class="fa-solid fa-plus"></i>Tambah Sasaran Kompetensi</button>
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
    $('#rata-rata').val(jumlah / 5)
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
        $('#adding').append(`<div id="${i}">
            <div class="styling">
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                     <select class="custom-select" name="kompetensi${i}" id="kompetensi${i}" style="width:200px;" onChange="getScore(${i})">
                        <option value="" selected>Choose</option>
                        <?php foreach ($target as $Target) : ?>
                        <option value="<?= $Target['id'] ?>,<?= $Target['keterangan'] ?>,<?= $Target['score'] ?>,<?= $Target['category'] ?>"><?= $Target['category'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Ada Peningkatan/Tidak<span style="color:red;">*</span></h6>
                    <select class="custom-select" name="perubahan${i}" id="perubahan${i}" style="width:200px;" >
                        <option value="Ya" selected>Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Score Sebelumnya</h6>
                    <input type="text"  class="form-control" name="keterangan${i}"  id="keterangan${i}" readonly>
                </div>
                 <div class="d-flex justify-content-center d-flex flex-column">
                        <h6>Score Setelah Training<span style="color:red;">*</span></h6>
                        <select class="custom-select" name="nilai${i}" required>
                          <option value="">Choose...</option>
                            <option value="0.5">0,5</option>
                            <option value="1">1</option>
                            <option value="1.5">1,5</option>
                            <option value="2">2</option>
                            <option value="2.5">2,5</option>
                            <option value="3">3</option>
                            <option value="3.5">3,5</option>
                            <option value="4">4</option>
                        </select>
                    </div>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-sm mt-2" onclick="adding(${i})" style="margin-left:38px;"><i
                        class="fa-solid fa-plus"></i>  Tambah Sasaran Kompetensi</button>
                        <button type="button" class="btn btn-danger btn-sm mt-2" id="removed${i}" onclick="removed(${i})"><i
                        class="fa fa-close"></i></button>
            </div>
        </div>
`)
    }
}

function removed(i) {
    $('#removed' + i).closest('#' + i).remove();
}

function getScore(id) {
    score = $('#kompetensi' + id).val();
    str = score.split(',')
    $('#keterangan' + id).val(str[2]);

}
</script>
<?= $this->endSection() ?>