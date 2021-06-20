<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h3>
                    Manage Arisan
                </h3>
                <a href="<?php echo base_url('add-arisan')?>" class="btn btn-primary">Tambah Arisan</a>
                <a href="<?php echo base_url('followed-arisan')?>" class="btn btn-success">Arisan yang anda ikuti</a>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12">
                <table id="tbl" class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Aksi/ID Unik</th>
                            <th scope="col">Judul Arisan</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Periode/Lama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($arisan as $ar):?>
                            <tr>
                                <td>
                                    <?=$no?>
                                </td>
                                <td>  
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button onclick="bagikan('<?=$ar->unique_id?>')" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary p-2">
                                            <i class="ti ti-share"></i>
                                        </button>
                                        <a href="<?=base_url('edit-arisan?id='.$ar->id)?>" class="btn btn-success p-2">
                                            <i class="ti ti-slice"></i>
                                        </a>
                                        <button onClick="dele(<?=$ar->id?>)" class="btn btn-danger p-2">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <p><?=$ar->title?></p>
                                    <p>(<?=$this->apl->price($ar->nominal)?>)</p>
                                    <a href="<?=base_url('participant-list/').$ar->unique_id?>" class="btn btn-success btn-sm btn-block p-2">Lihat Anggota</a>
                                    <a href="<?=base_url('manage-transaction/').$ar->unique_id?>" class="btn btn-primary btn-sm btn-block p-2">Manage Transaksi</a>
                                </td>
                                <td><?=$ar->description?></td>
                                <td>
                                    <p><?=$ar->time_start?></p>
                                </td>
                                <td><?=$ar->period?> / <?=$ar->long_time?>x</td>
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
            window.location.href = "<?php echo base_url()?>action/delete-arisan?id="+id;
        }
    }

    function bagikan(id){
        $('#myInput').val("<?=base_url('join/')?>"+id);
    }


</script>