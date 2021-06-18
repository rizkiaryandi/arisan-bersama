<div class="row">
    <div class="col-md-6 card">
        <div class="card-body">
        <h4>Informasi Pribadi</h4>
            <form action="<?=base_url('action/edit-personal')?>" method="POST" class="forms-sample">
                <?=$this->apl->csrf()?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input required type="text" class="form-control" id="name" name="name" value="<?=$pr->name?>">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input required type="text" class="form-control" id="username" name="username" value="<?=$pr->username?>">
                </div>
                <div class="form-group">
                    <label for="password"><span class="text-primary"><b>Password</b></span> (Abaikan jika tidak akan merubah password)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>