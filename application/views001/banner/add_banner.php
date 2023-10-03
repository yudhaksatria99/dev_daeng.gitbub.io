        <form id="formActions" role="form" action="<?= base_url('api/APIBanner/add')?>">
           
            <div class="row"> 
				<div class="col-md-12">   
					 <div class="form-group">
						<label>Header Image</label>
						<input id="headerUpload" name="header" type="file" accept="image/*" required>
						<p class="help-block">Size width 512px, height 256px</p>
					</div>
					<div class="form-group"> 
                        <div id="header-holder"></div>
                    </div>
				</div>
                
            </div>
			<div class="row"> 
				<div class="col-md-12">   
					 <div class="form-group">
						<label>Footer Image</label>
						<input id="footerUpload" name="footer" type="file" accept="image/*" required>
						<p class="help-block">Size width 512px, height 256px</p>
					</div>
					<div class="form-group"> 
                        <div id="footer-holder"></div>
                    </div>
				</div>
                
            </div>
            <div class="row">
				<div class="col-md-8">
                    <div class="form-group">
                        <label>Banner Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Banner Name" maxlength="20" required>
                    </div>
                </div> 
				<div class="col-md-4">   
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
<script>
    $("#headerUpload").on('change', function () {

    //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#header-holder");
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
	
	$("#footerUpload").on('change', function () {

    //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#footer-holder");
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