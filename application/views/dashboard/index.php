<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Halo, <?=$usr['name']?></h3>
            <h6 class="font-weight-normal mb-0">Hari ini tanggal <b><?=date('d M Y')?></b>, semoga hari ini menyenangkan!</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
          <div class="card-people mt-auto">
            <img src="<?=base_url('assets/temp/')?>images/dashboard/people.svg" alt="people">
            <div class="weather-info">
              <div class="d-flex">
                <div>
                  <h2 class="mb-0 font-weight-normal"><i class="icon-clock mr-2"></i>
                      <?=date("H:i")?>
                  </h2>
                </div>
                <div class="ml-2">
                  <h4 class="location font-weight-normal"><?=$this->usr['level']?></h4>
                  <h6 class="font-weight-normal"><?=$this->usr['name']?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Arisan</p>
                <p class="fs-30 mb-2"><?=$tFArs?></p>
                <p>Arisan yang anda ikuti</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Total Arisan</p>
                <p class="fs-30 mb-2"><?=$tArs?></p>
                <p>Arisan yang anda buat</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card bg-info text-light">
              <div class="card-body">
                <p class="mb-4">Pendapatan</p>
                <p class="fs-30 mb-2">Rp <?=$tPrt?></p>
                <p>Pendapatan anda</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Pembayaran</p>
                <p class="fs-30 mb-2">Rp <?=$tTr?></p>
                <p>Pembayaran Anda</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

    </div>
  </div>
</div>