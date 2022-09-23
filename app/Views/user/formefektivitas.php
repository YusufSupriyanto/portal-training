<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<div class="card m-3">
    <form action="<?= base_url() ?>/save_efektivitas" method="post">
        <div class="d-flex justify-content-center">
            <h4>Form Evaluasi Efektivitas Training</h4>
        </div>
        <div class="card m-2 p-2">
            <?php foreach ($evaluasi as $evaluation) : ?>
            <input type="hidden" value="<?= $evaluation['id_tna'] ?>" name="id_tna">
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
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Apakah pengetahuan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti pelatihan?
                            (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)</td>
                        <td><input type="radio" class="form-check-input d-block" id="radio1" name="pengetahuan[]"
                                value="4">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="3">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="2">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pengetahuan[]" value="1">
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                                    name="note1"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Apakah keterampilan karyawan meningkat untuk menunjang pekerjaan setelah mengikuti
                            pelatihan?
                            (Beri ketarangan, mis : peningkatan seperti apa dan sejauh mana)</td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="4">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="3">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="2">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="keterampilan[]" value="1">
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                                    name="note2"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Apakah performance karyawan meningkat setelah mengikuti pelatihan? (Beri ketarangan, mis :
                            peningkatan seperti apa dan sejauh mana)</td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="performance[]" value="4">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="performance[]" value="3">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="performance[]" value="2">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="performance[]" value="1">
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                                    name="note3"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Apakah ada perubahan sikap (positif) setelah karyawan mengikuti training ini ? (Beri
                            keterangan,
                            mis : perubahan sikap karyawan apa yang dirasakan oleh Atasan)</td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="4">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="3">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="2">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="perubahan[]" value="1">
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                                    name="note4"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Apakah pelatihan yang diikuti karyawan sudah diterapkan di pekerjaannya sehari - hari ?
                            (beri
                            keterangan, mis : diterapkan dalam bentuk apa)</td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="4">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="3">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="2">
                        </td>
                        <td><input type="radio" class="form-check-input" id="radio1" name="pelatihan[]" value="1">
                        </td>
                        <td>
                            <div class="form-group">
                                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"
                                    name="note5"></textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h5>Kesimpulan</h5>
            <h6>A. pelatihan ini</h6>
            <div class="ml-3">
                <input type="radio" class="form-check-input" id="radio1" name="kesimpulan[]" value="4">Signifikan
                untuk pekerjaan (Total Hasil : 4)<br>
                <input type="radio" class="form-check-input" id="radio1" name="kesimpulan[]" value="3">Bermanfaat
                untuk pekerjaan (Total Hasil : 3-3,9)<br>
                <input type="radio" class="form-check-input" id="radio1" name="kesimpulan[]" value="2">Cukup
                bermanfaat untuk pekerjaan (Total Hasil : 2-2,9)<br>
                <input type="radio" class="form-check-input" id="radio1" name="kesimpulan[]" value="1">Kurang
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
                            <th><input type="text" style="width:300px;" name="kompetensi1"></th>
                            <td>
                                <select class="custom-select" name="perubahan1" id="perubahan1" style="width:200px;">
                                    <option value="Ya" selected>Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                            <td><input type="text" style="width:300px;" name="keterangan1"></td>
                        </tr>
                        <tr>
                            <th><input type="text" style="width:300px;" name="kompetensi2"></th>
                            <td>
                                <select class="custom-select" name="perubahan2" id="perubahan2" style="width:200px;">
                                    <option value="Ya" selected>Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                            <td><input type="text" style="width:300px;" name="keterangan2"></td>
                        </tr>
                        <tr>
                            <th><input type="text" style="width:300px;" name="kompetensi3"></th>
                            <td>
                                <select class="custom-select" name="perubahan3" id="perubahan3" style="width:200px;">
                                    <option value="Ya" selected>Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                            <td><input type="text" style="width:300px;" name="keterangan3"></td>
                        </tr>
                        <tr>
                            <th><input type="text" style="width:300px;" name="kompetensi4"></th>
                            <td>
                                <select class="custom-select" name="perubahan4" id="perubahan4" style="width:200px;">
                                    <option value="Ya" selected>Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                            <td><input type="text" style="width:300px;" name="keterangan4"></td>
                        </tr>
                        <tr>
                            <th><input type="text" style="width:300px;" name="kompetensi5"></th>
                            <td>
                                <select class="custom-select" name="perubahan5" id="perubahan5" style="width:200px;">
                                    <option value="Ya" selected>Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                            <td><input type="text" style="width:300px;" name="keterangan5"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mr-6">
                    <button type="submit" class="btn  btn-info btn-sm">Kirim</button>
                </div>
            </div>

        </div>

    </form>
</div>
<?= $this->endSection() ?>