<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h3>
                    Anggota Arisan
                </h3>
                <p><?=$art->title?></p>
                <p><b>Pendiri:</b> <?=$art->name?></p>
                <p><b>Nomor Telepon:</b> <?=ns($art->tel, "Tidak disebutkan")?></p>
                <?php if($usr['id'] == $art->user_id):?>
                    <?php if($numpa):?>
                        <a href="<?php echo base_url('shake/'.$art->id)?>" class="btn btn-primary">Kocok Arisan</a>
                        <?php else:?> <p class="text-danger">Sudah Dikocok</p>
                    <?php endif?>
                <?php endif?>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12">
                <table id="tbl" class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Anggota</th>
                            <th scope="col">Urutan</th>
                            <th scope="col">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($participant as $ar):?>
                            <tr>
                                <td>
                                    <?=$no?>
                                </td>
                                <td>
                                    <p><b>Nama</b>: <?=$ar->name?></p>
                                    <p><b>Telepon</b>: <?=ns($ar->tel, "Tidak disebutkan")?></p>
                                    <?=btnWA($ar->tel, $art->title, "<b>WA:</b> ".explode(' ',$ar->name)[0])?>
                                </td>
                                <td>
                                    <p><?=ns($ar->number, 'Belum diurutkan', true)?></p>
                                </td>
                                <td>
                                    <?php if($ar->status == 'belum_terkonfirmasi'):?>
                                        <p><b>Status: </b> Menunggu Konfirmasi </p>
                                        <?php if($usr['id'] == $art->user_id):?>
                                            <a href="<?php echo base_url('confirm/'.$ar->id)?>" class="btn btn-sm btn-outline-success p-2">Konfirmasi</a>
                                            <a onclick="return confirm('Yakin menolak anggota satu ini?');" href="<?php echo base_url('tolak/'.$ar->id)?>" class="btn btn-sm btn-danger p-2">Tolak</a>
                                        <?php endif?>
                                    <?php endif?>
                                    <?php if($ar->status == 'belum_menang'):?>
                                        <p><b>Status: </b> Terkonfirmasi/Belum Menang </p>
                                        <?php if($usr['id'] == $art->user_id):?>
                                            <a href="<?php echo base_url('menang/'.$ar->id)?>" class="btn btn-sm btn-success p-2">Set: Pemenang Sesi Ini</a>
                                        <?php endif?>
                                    <?php endif?>

                                    <?php if($ar->status == 'sudah_menang'):?>
                                        <p><b>Status: </b> Sudang Menang </p>
                                        <?php if($usr['id'] == $art->user_id):?>
                                            <a href="<?php echo base_url('batal/'.$ar->id)?>" class="btn btn-sm btn-danger p-2">Batal</a>
                                            <a href="<?php echo base_url('upload/'.$ar->id)?>" class="btn btn-sm btn-primary p-2">Upload Dokumentasi</a>
                                        <?php endif?>
                                    <?php endif?>
                                </td>
                            </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bagikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>Bagikan link join Arisan anda kepada orang-orang</p>
        <textarea class="text-center js-copytextarea form-control" id="myInput"></textarea>
        <button type="button" class="js-textareacopybtn mt-2 btn-block btn btn-sm btn-primary">Salin</button>
      </div>
    </div>
  </div>
</div>

<script>
        
    function dele(id){
        var r = confirm("Yakin menghapus data?");
        if(r == true){
            window.location.href = "<?php echo base_url()?>action/delete-arisan?id="+id;
        }
    }

    $(document).ready(function() {
        $('#tbl').DataTable();
    } );


</script>