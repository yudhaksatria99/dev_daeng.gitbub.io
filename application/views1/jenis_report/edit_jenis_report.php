        <form id="formActions" role="form" action="<?= base_url('api/APIJenisReport/edit')?>">
           
            <div class="row"> 
				<div class="col-md-6">   
					<div class="form-group">
						<label>Choose Icon</label>
						<input id="iconUpload" name="icon" type="file" accept="image/*" >
						<div id="icon-holder"><img class="img-responsive" src="<?= base_url('uploads/150/'). $report->report_image ?>"> </div>
                    </div>
				</div>            
            </div>
            <div class="row">
				<div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Report</label>
                        <input name="name" type="text" value="<?= $report->report_name ?>" class="form-control" readonly >
                    </div>
                </div> 
				<div class="col-md-3">
                    <div class="form-group">
                        <label>Active?</label>
							<div class="radio">
							<label>
								<input type="radio" name="is_active" id="optionsRadios1" value="1" <?php if ($report->is_active == 1) echo ' checked'?>>Yes &nbsp;
							</label>
							<label>
								<input type="radio" name="is_active" id="optionsRadios2" value="0" <?php if ($report->is_active == 0) echo ' checked'?>>No
							</label>
						</div>						   
                    </div>
                </div>
				<div class="col-md-3">   
                    <div class="form-group">
						<label>&nbsp;</label>
						<div>
							<label>
								<input type="hidden" name="id" value="<?= $report->report_id ?>" />
								<button type="submit" class="btn btn-success">Update</button>
							</label>
						</div>
					</div>
                </div>
			</div>
        </form>
<script>
	$("#iconUpload").on('change', function () {

    //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#icon-holder");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                                "class": "img-responsive"
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
</script>