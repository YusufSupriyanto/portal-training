<?= $this->extend('/template/templateuser') ?>

<?= $this->section('content') ?>
<style>
.card-style {
    border-color: #717984;
    border-width: 1px;
}
</style>
<div class="card d-flex justify-content-center" style="height:500px;">
    <div class="d-flex justify-content-around ">
        <div class="card d-flex justify-content-center align-items-center card-style "
            style="width:300px;height:150px;"><i class="fa-solid fa-headset" style="font-size:46px;color:grey;"></i>
            <p>Contac Us</p>
            <a href="">+6280000000</a>
        </div>
        <div class="card d-flex justify-content-center align-items-center card-style "
            style="width:300px;height:150px;"><i class="fa-solid fa-envelope" style="font-size:46px;color:grey;"></i>
            <p>Contac Us</p>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=someone@example.com">admin@gmail.com</a>
        </div>
        <div class="card" style="width:300px;height:150px;"></div>
    </div>

</div>
<?= $this->endSection() ?>