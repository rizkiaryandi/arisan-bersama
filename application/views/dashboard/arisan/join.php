<div class="card">
    <div class="card-body">
        <h3>
            Join Grup Arisan
        </h3>
        <div class="row">
            <div class="col-md-4">
                <form action="<?=base_url('action')?>" method="post">
                    <?=$this->apl->csrf()?>
                    <div class="form-group">
                        <label for="unique_id">ID Arisan</label>
                        <input required value="<?=$arsid?>" id="unique_id" class="form-control" type="text" name="unique_id" placeholder="Masukkan ID Arisan">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Join</button>
                </form>
            </div>
        </div>
    </div>
</div>