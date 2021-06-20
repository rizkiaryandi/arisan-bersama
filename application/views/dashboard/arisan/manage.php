<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h3>
                    History Pembayaran
                </h3>
                <a href="<?php echo base_url('add-transaction')?>" class="btn btn-primary">Tambah Pembayaran</a>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12">
                <table id="tbl" class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Aksi</th>
                            <th scope="col">Arisan</th>
                            <th scope="col">Nama/Nominal Bayar/Label</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Waktu Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($transaction as $ar):?>
                            <tr>
                                <td>
                                    <?=$no?>
                                </td>
                                <td>  
                                    <?php if($ar->status == 'menunggu_konfirmasi'):?>
                                        <a onClick="return confirm('Konfirmasi?')" href="<?=base_url('konfirmasi_bayar/'.$ar->id)?>" class="btn btn-success p-2">
                                            Konfirmasi
                                        </a>
                                        <?php else: ?>
                                            Pembayaran terkonfirmasi
                                    <?php endif?>
                                </td>
                                <td>  
                                    <?=$ar->title?>
                                </td>
                                <td>  
                                    <p><b>Nama: </b><?=$ar->name?></p>
                                    <p><b>Pembayaran: </b><?=$ar->nominal?></p>
                                    <p><b>Label: </b><?=$ar->label?></p>
                                    <p><b>Status: </b><?=$ar->status?></p>
                                </td>
                                <td>
                                    <a href="<?=base_url('images/'.$ar->img)?>" class="btn border-dark">
                                        <img src="<?=base_url('images/'.$ar->img)?>" alt="img" class="w-100">
                                    </a>
                                </td>
                                <td>  
                                    <?=$ar->created_at?>
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

    var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    copyTextareaBtn.addEventListener('click', function(event) {
    var copyTextarea = document.querySelector('.js-copytextarea');
    copyTextarea.focus();
    copyTextarea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }
    });

    $(document).ready(function() {
        $('#tbl').DataTable();
    } );
        
    function dele(id){
        var r = confirm("Yakin menghapus data?");
        if(r == true){
            window.location.href = "<?php echo base_url()?>action/delete-transaction?id="+id;
        }
    }

    function bagikan(id){
        $('#myInput').val("<?=base_url('join/')?>"+id);
    }


</script>