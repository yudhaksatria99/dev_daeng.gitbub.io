        <form id="formActions" role="form" action="<?= base_url('api/APIReason/edit')?>">
            <div class="row">         
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Reason Name</label>
                        <input name="name" type="text" class="form-control" value="<?= $reason->reason_name ?>" maxlength="50" required>
                    </div>
                </div>
				
				<div class="col-md-5">
                    <div class="form-group">
                        <label>Active?</label>
							<div class="radio">
							<label>
								<input type="radio" name="is_active" id="optionsRadios1" value="1" <?php if ($reason->is_active == 1) echo ' checked'?>>Yes &nbsp;
							</label>
							<label>
								<input type="radio" name="is_active" id="optionsRadios2" value="0" <?php if ($reason->is_active == 0) echo ' checked'?>>No
							</label>
						</div>						   
                    </div>
                </div>
				
                 
            </div>
            
            <div class="row">
				<div class="col-md-12">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<input type="hidden" name="id" value="<?= $reason->reason_id ?>">
								<button type="submit" class="btn btn-success">Update</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>