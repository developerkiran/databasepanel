<div class="container">
	<div class="card bg-light">
     <h4 class="card-title mt-3 text-center">Create table</h4>
     <table class="table table-striped">
        <tbody>
           <tr>
              <td colspan="1">
                 <form class="well form-horizontal"  name="frmcreatetable" id="frmcreatetable" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                    <fieldset>
                       <div class="form-group">
                          <label class="col-md-4 control-label">Select Database</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group">
                                <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                <select class="selectpicker form-control" name="db_name" id="db_name">
                                    <?php foreach ($alldatabase as $db) {?>
                                   <option value="<?php echo $db; ?>"><?php echo $db; ?></option>
                                <?php } ?>
                                </select>
                             </div>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-md-4 control-label">table name</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                              <input id="table_name" name="table_name" class="form-control" type="text"></div>
                          </div>
                       </div>

                       <input type="button" value="Add Row" onclick="addRow('dataTable')" />

                       <input type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

                       <table id="dataTable" width="350px" border="1">
                        <thead>
                                <tr>
                                    <th></th>
                                    <th>Coumn Name</th>
                                    <th>Type</th>
                                </tr>
                        <tr>
                           <TD><INPUT type="checkbox" name="chk"/></TD>
                           <td> 
                              <div class="form-group">
                                 <input type="text" name="coumn_name[]" class="form-control"/> 
                              </div>
                           </td>
                           <td> <select name="data_type[]" class="form-control" style="width:auto;">
                              <option value="INT">INT</option>
                              <option value="CHAR">CHAR</option>
                              <option value="VARCHAR">VARCHAR</option>
                              <option value="TEXT">TEXT</option>
                              <option value="DATE">DATE</option>   
                           </select> 
                        </td>
                        </tr>
                     </TABLE>
                     <hr>
                     <div class="form-group">
                     <button type="submit" class="btn btn-primary pull-right" id="btn-submit-dev"> Save  </button>
                  </div> <!-- form-group// --> 

                  </fieldset>
               </form>
            </td>

         </tr>
      </tbody>
   </table>
</div>
</div>
<br><br>

<hr>
<a href="<?php echo base_url('ManageDatabase/ListAllDatabase') ?>" class="btn btn-primary">back to all Database</a>
<a href="<?php echo base_url('welcome') ?>" class="btn btn-primary">back to main page</a>

<SCRIPT language="javascript">
      function addRow(tableID) {

         var table = document.getElementById(tableID);

         var rowCount = table.rows.length;
         var row = table.insertRow(rowCount);

         var cell1 = row.insertCell(0);
         var element1 = document.createElement("input");
         element1.type = "checkbox";
         element1.name="chkbox[]";
         cell1.appendChild(element1);

         var formdiv=document.createElement("div");
         formdiv.className="form-control";

         var cell2 = row.insertCell(1);
         var element2 = document.createElement("input");
         element2.type = "text";
         element2.name="coumn_name[]";
         element2.className="form-control";
         cell2.appendChild(element2);

         var cell3 = row.insertCell(2);
         var element3 = document.createElement("select");
          element3.type = "text";
         element3.name="data_type[]";
         element3.className="form-control";
         element3.value="INT";
         cell3.appendChild(element3);

         var data_typearray = ["INT","CHAR","VARCHAR","TEXT","DATE"];


         for (var i = 0; i < data_typearray.length; i++) {
           var option = document.createElement("option");
           option.value = data_typearray[i];
           option.text = data_typearray[i];
           element3.appendChild(option);
        }
      }

      function deleteRow(tableID) {
         try {
         var table = document.getElementById(tableID);
         var rowCount = table.rows.length;

         for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
               table.deleteRow(i);
               rowCount--;
               i--;
            }


         }
         }catch(e) {
            alert(e);
         }
      }

   </SCRIPT>
<script type="text/javascript">

	$(document).ready(function () {

		$(document).on('submit', '#frmcreatetable', function (e) {
			$("#frmcreatetable").validate({
            ignore: [],
				rules: {
					table_name: {required: true},
               'coumn_name[]':{required: true},
				},
				messages: {
					table_name: {
						required: 'table name field is required',
                  remote: '<?php echo $this->lang->line("table_name_already_exist"); ?>'
					},
               'coumn_name[]':{
                  required: 'required'
               },
				},
				errorClass: 'help-block',
				errorElement: 'span',
				
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
			if ($("#frmcreatetable").valid()) {
				
				var data = new FormData($('#frmcreatetable')[0]);
				//$("#btn-submit-dev").attr('disabled', true);
				addOverlay();
           
				$.ajax({
					type: 'post',
					data: data,
					dataType: "json",
					url: "<?php echo base_url('ManageDatabase/InsertTable'); ?>",
					cache: false,
					contentType: false,
					processData: false,
					success: function (r) {

						if (r.status == 200) {
							sType = getStatusText(r.status);
							sText = r.message;
							Custom.myNotification(sType, sText);
                     window.location.href = "<?php echo base_url('ManageDatabase/listtables'); ?>"+'/'+r.databasename;
							
						} else {
							sType = getStatusText(r.status);
							sText = r.message;
							Custom.myNotification(sType, sText);
						}
						
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