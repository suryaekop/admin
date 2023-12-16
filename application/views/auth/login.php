<!-- Outer Row -->
<div class="row justify-content-center mt-5 pt-lg-5">

    <div class="col-xl-10 col-lg-12 col-md-9">


                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center mb-4" >
                                <h1 class="h3 text-white" style="font-family: 'Noto Sans JP';">Teras Japan</h1>
                                <span class=" h4 text-white" style="font-family: 'Noto Sans JP';">Login</span>
                            </div>
                            <?= $this->session->flashdata('pesan'); ?>
                            <?= form_open('', ['class' => 'user']); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="form-control form-control-user" placeholder="Username">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" style="background-color: black; color: white; font-weight: bold;" class="btn btn-user btn-block">
                                Login
                            </button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>