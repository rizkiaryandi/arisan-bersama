<div class="card">
    <div class="card-body">
        <h3>
            Pembayaran
        </h3>
        <div class="row">
            <div class="col-md-5">
                <?= form_open_multipart('action/add-transaction'); ?>
                    <?=$this->apl->csrf()?>
                    <div class="form-group">
                        <label for="arisan_id">Arisan</label>
                        <select required class="form-control" onchange="paym(value)">
                            <option value="">-- Pilih Arisan</option>
                            <?php foreach($arisanJoin as $ars):?>
                                <option value="<?=$ars->ih?> - <?=$ars->nominal?>"><?=$ars->title?> - <?=$this->apl->price($ars->nominal)?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <input type="hidden" required id="arisan_id" name="arisan_id" class="form-control">
                    <div class="form-group">
                        <label for="payment_amount">Nominal</label>
                        <input type="hidden" required id="payment_amount" class="form-control" name="payment_amount">
                        <input disabled type="text" required id="payment_amounta" class="form-control" name="vc">
                    </div>
                    <div class="form-group">
                        <label for="label">Catatan</label>
                        <input type="text" id="label" class="form-control" name="label">
                    </div>
                    <div class="form-group">
                        <label for="img">Gambar</label>
                        <input type="file" id="img" class="form-control" name="img">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function paym($i){
        var sp = $i.split(' - ');
        $('#payment_amount').val(sp[1])
        $('#payment_amounta').val(sp[1])
        $('#arisan_id').val(sp[0])
    }
</script>