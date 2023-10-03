        <form id="formActions" role="form" action="<?= base_url('api/APIAdministrator/add')?>">
            <div class="row">         
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input name="username" type="text" class="form-control" placeholder="Admin Name" maxlength="50" required>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password"  maxlength="50" required>
                    </div>
                </div>
                 
            </div>
            
            <div class="row">
				<div class="col-md-12">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<button type="submit" class="btn btn-primary">Submit</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>