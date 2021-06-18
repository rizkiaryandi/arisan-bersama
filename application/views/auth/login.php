<div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
                <img src="<?=base_url('assets/')?>img/logo.png" alt="logo">
            </div>

            
            <?php if($this->session->flashdata('res')): ?>
                <div class="alert alert-<?php echo $this->session->flashdata('res')['met'] ?>" role="alert">
                    <?php echo $this->session->flashdata('res')['mess'] ?>
                </div>
                <?php else:?>
                    <h4>Selamat Datang di <?=$this->apl->name?></h4>
                    <h6 class="font-weight-light">Login untuk melanjutkan</h6>
            <?php endif; ?>
            
            <form class="pt-3" action="<?=base_url('action/login')?>" method="POST">
                <?=$this->apl->csrf()?>
                <div class="form-group">
                    <input required type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary font-weight-medium">
                        LOG IN
                    </button>
                </div>
                <div class="mt-2">
                    <p class="text-center text-secondary">Atau</p>
                </div>
                <div class="mt-2">
                    <a href="<?=base_url('register')?>" class="btn btn-block btn-success font-weight-medium">
                        Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>