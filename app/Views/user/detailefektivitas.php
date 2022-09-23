<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <div class="d-flex justify-content-center">
        <h4>Form Evaluasi Efektivitas Training</h4>
    </div>
    <div class="card m-2 p-2 " id="efektivitas">
        <?php foreach ($evaluasi as $evaluation) : ?>
        <input type="hidden" value="<?= $evaluation['id_tna'] ?>" name="id_tna" id="id_tna">
        <label>Nama Peserta Training <span style="margin-left:20px;">: <?= $evaluation['nama'] ?> </span></label>
        <label>Npk/Dept/Seksi <span style="margin-left:68px;"></span>:
            <?= $evaluation['npk'] ?>/<?= $evaluation['departemen'] ?>/<?= $evaluation['seksi'] ?></span></label>
        <label>Jabatan <span style="margin-left:118px;">: <?= $evaluation['bagian'] ?> </span></label>
        <label>Nama Training <span style="margin-left:78px;">: <?= $evaluation['training'] ?></span></label>
        <label>Tanggal Pelaksanaan <span style="margin-left:35px;">:
                <?= $evaluation['rencana_training'] ?></span></label>
        <label>Lembaga Penyelenggara <span style="margin-left:10px;">: <?= $evaluation['vendor'] ?></span></label>
        <?php endforeach; ?>
        <table class="table table-head-fixed display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Penilaian</th>
                    <th>4(BS)</th>
                    <th>3(B)</th>
                    <th>2(C)</th>
                    <th>1(K)</th>
                    <th>Score</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Apakah pengetahuan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti pelatihan?
                        (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)</td>
                    <td><input type="radio" class="form-check-input d-block" id="radio1" name="pengetahuan" value="4">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="3">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="2">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan" value="1">
                    </td>
                    <td>
                        <h6 id="score1"></h6>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" rows="3" id="note1"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Apakah keterampilan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti
                        pelatihan?
                        (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)</td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="4">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="3">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="2">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan" value="1">
                    </td>
                    <td>
                        <h6 id="score2"></h6>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="note2" rows="3" name="note2"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Apakah performance karyawan meningkat setelah mengikuti pelatihan? (Beri ketarangan, mis :
                        peningkatan seperti apa dan sejauh mana)</td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="performance" value="4">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="performance" value="3">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="performance" value="2">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="performance" value="1">
                    </td>
                    <td>
                        <h6 id="score3"></h6>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="note3" rows="3" name="note3"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Apakah ada perubahan sikap (positif) setelah karyawan mengikuti training ini ? (Beri
                        keterangan,
                        mis : perubahan sikap karyawan apa yang dirasakan oleh Atasan)</td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="perubahan" value="4">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="perubahan" value="3">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="perubahan" value="2">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="perubahan" value="1">
                    </td>
                    <td>
                        <h6 id="score4"></h6>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="note4" rows="3" name="note4"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Apakah pelatihan yang diikuti karyawan sudah diterapkan di pekerjaannya sehari - hari ?
                        (beri
                        keterangan, mis : diterapkan dalam bentuk apa)</td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="4">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="3">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pelatihans" value="2">
                    </td>
                    <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan" value="1">
                    </td>
                    <td>
                        <h6 id="score5"></h6>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" id="note25" rows="3" name="note5"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <label>Rata-Rata</label>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 id="rata-rata"></h6>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <h5>Kesimpulan</h5>
        <h6>A. pelatihan ini</h6>
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
        <h6 class="mt-3">B. Apakah Ada Peningkatan Kopetensi Karyawan Setelah Pelatihan Ini</h6>
        <div class="ml-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kompetensi yang disasar oleh pelatihan</th>
                        <th scope="col">Ada Peningkatan/Tidak </th>
                        <th scope="col">Jika Ya </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><input type="text" style="width:300px;" name="kompetensi1" id="kompetensi1"></th>
                        <td>
                            <select class="custom-select" name="perubahan1" id="perubahan1" style="width:200px;">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </td>
                        <td><input type="text" style="width:300px;" name="keterangan1" id="keterangan1"></td>
                    </tr>
                    <tr>
                        <th><input type=" text" style="width:300px;" name="kompetensi2" id="kompetensi2"></th>
                        <td>
                            <select class="custom-select" name="perubahan2" id="perubahan2" style="width:200px;">
                                <option value="Ya" selected>Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </td>
                        <td><input type="text" style="width:300px;" name="keterangan2" id="keterangan2"></td>
                    </tr>
                    <tr>
                        <th><input type="text" style="width:300px;" name="kompetensi3" id="kompetensi3"></th>
                        <td>
                            <select class="custom-select" name="perubahan3" id="perubahan3" style="width:200px;">
                                <option value="Ya" selected>Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </td>
                        <td><input type="text" style="width:300px;" name="keterangan3" id="keterangan3"></td>
                    </tr>
                    <tr>
                        <th><input type=" text" style="width:300px;" name="kompetensi4" id="kompetensi4"></th>
                        <td>
                            <select class="custom-select" name="perubahan4" id="perubahan4" style="width:200px;">
                                <option value="Ya" selected>Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </td>
                        <td><input type="text" style="width:300px;" name="keterangan4" id="keterangan4"></td>
                    </tr>
                    <tr>
                        <th><input type=" text" style="width:300px;" name="kompetensi5" id="kompetensi5"></th>
                        <td>
                            <select class="custom-select" name="perubahan5" id="perubahan5" style="width:200px;">
                                <option value="Ya" selected>Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </td>
                        <td><input type="text" style="width:300px;" name="keterangan5" id="keterangan5"></td>
                    </tr>
                </tbody>
            </table>

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
            $('#kompetensi2').val(data[0].kompetensi2)
            $('#kompetensi3').val(data[0].kompetensi3)
            $('#kompetensi4').val(data[0].kompetensi4)
            $('#kompetensi5').val(data[0].kompetensi5)

            $('#keterangan1').val(data[0].keterangan1)
            $('#keterangan2').val(data[0].keterangan2)
            $('#keterangan3').val(data[0].keterangan3)
            $('#keterangan4').val(data[0].keterangan4)
            $('#keterangan5').val(data[0].keterangan5)

            $("#perubahan1 option[value='" + data[0].perubahan1 + "']").attr("selected",
                "selected");
            $("#perubahan2 option[value='" + data[0].perubahan2 + "']").attr("selected",
                "selected");
            $("#perubahan3 option[value='" + data[0].perubahan3 + "']").attr("selected",
                "selected");
            $("#perubahan4 option[value='" + data[0].perubahan4 + "']").attr("selected",
                "selected");
            $("#perubahan5 option[value='" + data[0].perubahan5 + "']").attr("selected",
                "selected");



        }
    })


})
</script>
<?= $this->endSection() ?>