        <form id="formActions" role="form" action="<?= base_url('api/APIAdministrator/edit')?>">
            <div class="row">         
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input name="username" type="text" class="form-control" value="<?= $admin->username ?>" maxlength="50" required readonly>
                    </div>
                </div>
				
				<div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
						<input name="old_password" type="hidden" value="<?= $admin->password ?>">
                        <input name="new_password" type="password" class="form-control" value="<?= $admin->password ?>" maxlength="50" required>
                    </div>
                </div>
				
                 
            </div>
            
            <div class="row">
				<div class="col-md-12">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<button type="submit" class="btn btn-success">Update</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>