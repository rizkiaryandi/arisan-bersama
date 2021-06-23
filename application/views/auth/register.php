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
                    <h4>Pendaftaran <?=$this->apl->name?></h4>
                    <h6 class="font-weight-light">Dapatkan kemudahan mendaftar kurang dari 2 menit</h6>
            <?php endif; ?>
            
            <form class="pt-3" action="<?=base_url('action/register')?>" method="POST">
                <?=$this->apl->csrf()?>
                <div class="form-group">
                    <input required min="3" max="30" type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input required min="8" max="30" type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input required min="1" max="100" type="text" name="name" class="form-control form-control-lg" id="username" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <input required min="6" max="30" type="tel" name="tel" class="form-control form-control-lg" id="username" placeholder="No Whatsapp" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">
                        Selesaikan Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>