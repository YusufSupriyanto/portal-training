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
<div class="card p-2 overflow-auto">
    <?php
    $page = basename($_SERVER['PHP_SELF']);
    if ($page  == 'detail_efektivitas') : ?>
    <h4>
        <center>Form Evaluasi Efektivitas Training</center>
    </h4>
    <?php else : ?>
    <h4>
        <center>Form Evaluasi Unplanned Training</center>
    </h4>
    <?php endif; ?>

    <?php foreach ($evaluasi as $evaluation) : ?>
    <input type="hidden" value="<?= $evaluation['id_tna'] ?>" name="id_tna" id="id_tna">
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
    <div id="efektivitas">
        <div>
            <h6>Item Penilaian</h6>
            <p>
                1. Apakah pengetahuan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti pelatihan?
                (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="4">
                    <label>4(Baik Sekali)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="3">
                    <label>3(Baik)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="2">
                    <label>2(Cukup)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="1">
                    <label>1(Kurang)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                        name="note1"><?= $evaluasi[0]['note1'] ?></textarea>
                </div>
            </div>
            <p>
                2. Apakah keterampilan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti
                pelatihan?
                (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="4">
                    <label>4(Baik Sekali)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="3">
                    <label>3(Baik)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="2">
                    <label>2(Cukup)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="1">
                    <label>1(Kurang)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                        name="note2"><?= $evaluasi[0]['note2'] ?></textarea>
                </div>
            </div>
            <p>
                3. Apakah performance karyawan meningkat setelah mengikuti pelatihan? (Beri ketarangan, mis :
                peningkatan seperti apa dan sejauh mana)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance" value="4">
                    <label>4(Baik Sekali)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance" value="3">
                    <label>3(Baik)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance" value="2">
                    <label>2(Cukup)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="performance" value="1">
                    <label>1(Kurang)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                        name="note3"><?= $evaluasi[0]['note3'] ?></textarea>
                </div>
            </div>
            <p>
                4. Apakah ada perubahan sikap (positif) setelah karyawan mengikuti training ini ? (Beri
                keterangan,
                mis : perubahan sikap karyawan apa yang dirasakan oleh Atasan)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan" value="4">
                    <label>4(Baik Sekali)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan" value="3">
                    <label>3(Baik)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan" value="2">
                    <label>2(Cukup)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="perubahan" value="1">
                    <label>1(Kurang)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                        name="note4"><?= $evaluasi[0]['note4'] ?></textarea>
                </div>
            </div>
            <p>
                5. Apakah pelatihan yang diikuti karyawan sudah diterapkan di pekerjaannya sehari - hari ?
                (beri
                keterangan, mis : diterapkan dalam bentuk apa)
            </p>
            <div class="d-flex justify-content-center">
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="4">
                    <label>4(Baik Sekali)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="3">
                    <label>3(Baik)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="2">
                    <label>2(Cukup)</label>
                </div>
                <div class="m-4">
                    <input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="1">
                    <label>1(Kurang)</label>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                        name="note5"><?= $evaluasi[0]['note5'] ?></textarea>
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
        <h5 class="mt-3">B. Apakah Ada Peningkatan Kompetensi Karyawan Setelah Pelatihan Ini</h5>
        <div>
            <div class="styling">
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                    <input class="form-control" type="text" name="kompetensi1" id="kompetensi1" readonly>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Ada Peningkatan/Tidak<span style="color:red;">*</span></h6>
                    <select class="custom-select" name="perubahan1" id="perubahan1" style="width:200px;">
                        <option value="Ya" selected>Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Score Sebelum Training</h6>
                    <input class="form-control" type="text" name="keterangan1" id="keterangan1" readonly>
                </div>
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Score Setelah Training<span style="color:red;">*</span></h6>
                    <select class="custom-select" name="nilai1" required>
                        <option value=""><?= $evaluasi[0]['nilai1'] ?></option>
                    </select>
                </div>
            </div>

            <div>
                <button type="button" class="btn btn-success btn-sm mt-2" style="margin-left:38px;"
                    onclick="adding(1)"><i class="fa-solid fa-plus"></i> Tambah Sasaran Kompetensi</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    const id_training = $('#id_tna').val()
    console.log(id_training)
    $.ajax({
        type: 'post',
        url: "<?= base_url(); ?>/data_evaluasiEfektivitas",
        async: true,
        dataType: "json",
        data: {
            id_training: id_training
        },
        success: function(data) {
            console.log(data)
            for (var i = 1; i <= 4; i++) {
                if (data[0].pengetahuan == i) {
                    $('#efektivitas').find(':radio[name = pengetahuan][value="' + i + '"]').prop(
                        'checked',
                        true)

                }
                if (data[0].keterampilan == i) {
                    $('#efektivitas').find(':radio[name = keterampilan][value="' + i + '"]').prop(
                        'checked',
                        true)

                }
                if (data[0].performance == i) {
                    $('#efektivitas').find(':radio[name = performance][value="' + i + '"]').prop(
                        'checked',
                        true)

                }
                if (data[0].perubahan == i) {
                    $('#efektivitas').find(':radio[name = perubahan][value="' + i + '"]').prop(
                        'checked',
                        true)

                }
                if (data[0].pelatihan == i) {
                    $('#efektivitas').find(':radio[name = pelatihan][value="' + i + '"]').prop(
                        'checked',
                        true)
                }
            }
            $('#score1').html(data[0].pengetahuan)
            $('#score2').html(data[0].keterampilan)
            $('#score3').html(data[0].performance)
            $('#score4').html(data[0].perubahan)
            $('#score5').html(data[0].pelatihan)

            var rata = parseFloat(data[0].pengetahuan) + parseFloat(data[0].keterampilan) +
                parseFloat(data[0]
                    .performance) + parseFloat(data[0].perubahan) + parseFloat(data[0].pelatihan)
            var rata_rata = rata / 5

            $('#rata-rata').html(rata_rata)
            $('#note1').val(data[0].note1)
            $('#note2').val(data[0].note2)
            $('#note3').val(data[0].note3)
            $('#note4').val(data[0].note4)
            $('#note5').val(data[0].note5)

            if (rata_rata <= 1.9) {
                $('#kesimpulan1').prop('checked', true)
            } else if (rata_rata <= 2.9) {
                $('#kesimpulan2').prop('checked', true)
            } else if (rata_rata <= 3.9) {
                $('#kesimpulan3').prop('checked', true)
            } else {
                $('#kesimpulan4').prop('checked', true)

            }

            $('#kompetensi1').val(data[0].kompetensi1)
            $('#keterangan1').val(data[0].keterangan1)
            $("#perubahan1 option[value='" + data[0].perubahan1 + "']").attr("selected",
                "selected");

        }
    })
})


function adding(i) {
    i++
    if (i <= 5) {
        $('#adding').append(`
<div id="${i}">
            <div class="styling">
                <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Kompetensi yang disasar oleh pelatihan<span style="color:red;">*</span></h6>
                    <input class="form-control" type="text" name="kompetensi${i}" id="kompetensi${i}" readonly>
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
                    <input class="form-control" type="text" name="keterangan${i}" id="keterangan${i}" readonly>
                </div>
                 <div class="d-flex justify-content-center d-flex flex-column">
                    <h6>Score Setelah Training<span style="color:red;">*</span></h6>
                    <select class="custom-select" id="nilai${i}" name="nilai${i}" required>
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
                        class="fa-solid fa-plus"></i>Tambah Sasaran Kompetensi</button>
                        <button type="button" class="btn btn-danger btn-sm mt-2" id="removed${i}" onclick="removed(${i})"><i
                        class="fa fa-close"></i></button>
            </div>
        </div>
`)
        const id_training = $('#id_tna').val()
        console.log(id_training)
        $.ajax({
            type: 'post',
            url: "<?= base_url(); ?>/data_evaluasiEfektivitas",
            async: true,
            dataType: "json",
            data: {
                id_training: id_training
            },
            success: function(data) {
                console.log(data)
                if (i == 2) {
                    $('#kompetensi2').val(data[0].kompetensi2)
                    $('#keterangan2').val(data[0].keterangan2)
                    $("#perubahan2 option[value='" + data[0].perubahan2 + "']").attr("selected",
                        "selected");
                    $("#nilai2 option[value='" + data[0].nilai2 + "']").attr("selected",
                        "selected");
                } else if (i == 3) {
                    $('#kompetensi3').val(data[0].kompetensi3)
                    $('#keterangan3').val(data[0].keterangan3)
                    $("#perubahan3 option[value='" + data[0].perubahan3 + "']").attr("selected",
                        "selected");
                    $("#nilai3 option[value='" + data[0].nilai3 + "']").attr("selected",
                        "selected");
                } else if (i == 4) {
                    $('#kompetensi4').val(data[0].kompetensi4)
                    $('#keterangan4').val(data[0].keterangan4)
                    $("#perubahan4 option[value='" + data[0].perubahan4 + "']").attr("selected",
                        "selected");
                    $("#nilai4 option[value='" + data[0].nilai4 + "']").attr("selected",
                        "selected");
                } else {
                    $('#kompetensi5').val(data[0].kompetensi5)
                    $('#keterangan5').val(data[0].keterangan5)
                    $("#perubahan5 option[value='" + data[0].perubahan5 + "']").attr("selected",
                        "selected");
                    $("#nilai5 option[value='" + data[0].nilai5 + "']").attr("selected",
                        "selected");
                }
            }


        })
    }
}

function removed(i) {
    $('#removed' + i).closest('#' + i).remove();
}
</script>
<?= $this->endSection() ?>