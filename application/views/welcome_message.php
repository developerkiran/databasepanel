
<div class="container">
	<div class="card bg-light">
		<div class="row">
			<div class="col-sm">

				<article class="card-body mx-auto" style="max-width: 400px;">
					<h4 class="card-title mt-3 text-center">Create Database</h4>

					<form class="form-horizontal" name="frmDatabase" id="frmDatabase" method="post" action="javascript:void(0)" enctype="multipart/form-data">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> practical_ </span>
							</div>
							<input name="db_name" id="db_name" class="form-control" placeholder="Database name" type="text">
						</div> 

						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block" id="btn-submit-dev"> Create Database  </button>
						</div> <!-- form-group// -->      
					</form>
				</article>


			</div>
			<div class="col-sm">
				<article class="card-body mx-auto" style="max-width: 400px;">
					<h4 class="card-title mt-3 text-center">&nbsp;</h4>

					<div class="form-group">
						<a href="<?php echo base_url('ManageDatabase/FormTable') ?>" class="btn btn-primary btn-block" id="btn-submit-dev"> Create Tables  </a>
					</div> <!-- form-group// -->      
					
				</article>
			</div>
			<div class="col-sm">
				<article class="card-body mx-auto" style="max-width: 400px;">
					<h4 class="card-title mt-3 text-center">&nbsp;</h4>
					
						<div class="form-group">
							<a href="<?php echo base_url('ManageDatabase/ListAllDatabase') ?>" class="btn btn-primary btn-block"> Lits all database and tables  </a>
						</div> <!-- form-group// -->      
					
				</article>
			</div>
		</div>
	</div>
	


</div> 

<br><br>

<script type="text/javascript">
	$(document).ready(function () {

		$(document).on('submit', '#frmDatabase', function (e) {
			$("#frmDatabase").validate({
				rules: {
					db_name: {required: true},
				},
				messages: {
					db_name: {
						required: 'required database name',
						remote: '<?php echo $this->lang->line("database_name_already_exist"); ?>'
					},
				},
				errorClass: 'help-block',
				errorElement: 'span',
				highlight: function (element) {
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function (element) {
					$(element).closest('.form-group').removeClass('has-error');
				},
				errorPlacement: function (error, element) {
					if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {
						error.appendTo('.a');
						error.appendTo(element.parent().parent());
					} else {
						if (element.attr("data-error-container")) {
							error.appendTo(element.attr("data-error-container"));
						} else {
							error.insertAfter(element.parent());
						}
					}
				}
			});
			if ($("#frmDatabase").valid()) {
				
				var data = new FormData($('#frmDatabase')[0]);
				//$("#btn-submit-dev").attr('disabled', true);
				addOverlay();

				$.ajax({
					type: 'post',
					data: data,
					dataType: "json",
					url: "<?php echo base_url('ManageDatabase'); ?>",
					cache: false,
					contentType: false,
					processData: false,
					success: function (r) {

						if (r.status == 200) {
							sType = getStatusText(r.status);
							sText = r.message;
							Custom.myNotification(sType, sText);
							return false;
						} else {
							sType = getStatusText(r.status);
							sText = r.message;
							Custom.myNotification(sType, sText);
						}
						document.getElementById("frmDatabase").reset();
						$("#btn-submit-dev").attr('disabled', false);
					},
					complete: removeOverlay
				});
				return false;
			} else {
				return false;
			}

		});
	});
</script>