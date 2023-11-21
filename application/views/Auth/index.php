<div class="container-fluid mt-2">
    <img class="img-fluid imgbanner rounded" style="width: 100%" alt="Responsive image"
        src="<?= base_url('assets/assets/img/LOGIN.png');?>">
    <marquee>
        SELAMAT DATANG DI HALAMAN LOGIN SEMERUSMART ....
    </marquee>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">SILAHKAN LOGIN</h3>
                    <?= $this->session->flashdata('message'); ?>
                    <form  method="post" action="<?= base_url('Auth'); ?>">
                    <table class="table table-sm justify-content-center">
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" id="username"><?= form_error('username', '<small class="text-danger">', '</small>'); ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="password" id="password"><?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-sign-in-alt mr-3"></i>Login</button>
                    <a href="<?= base_url('Auth/registration');?>" type="button" class="btn btn-light float-right mr-1"><i class="fas fa-user-plus mr-3"></i>Daftar</a>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a style="font:italic" class="text-dark"> <img class="img-fluid imgbanner rounded" style="width: 5%"
                            alt="Responsive image" src="<?= base_url('assets/img/logo.png');?>"> copyright :
                        itrsudwaled2021@semerusmart
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>