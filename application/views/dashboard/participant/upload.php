<div class="card">
    <div class="card-body">
        <?= form_open_multipart('action/upload')?>
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="form-group">
            <label for="img">Upload Dokumentasi</label>
            <input type="file" class="form-control-file" name="img" id="img" placeholder="Tambah" aria-describedby="Dokumentasi_pemenang">
            <small id="Dokumentasi_pemenang" class="form-text text-muted">Dokumentasi Pemenang</small>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>