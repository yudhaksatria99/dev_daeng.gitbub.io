<form id="formActions" role="form" action="<?= base_url('api/APIUser/reset') ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>NIK</label>
                <input name="nik" type="text" class="form-control" value="<?= $user->nik ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="<?= $user->email ?>" readonly>
                <input type="hidden" name="old_email" value="<?= $user->email ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input name="password" type="hidden" value="<?= generateRandomString(8) ?>">
                <input type="hidden" name="id" value="<?= $user->user_id ?>">
                <button type="submit" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </div>
</form>