<?php require_once("function.php"); ?>

<form>
<label class="col-lg-5 control-label text-right" for="sl_no">STATE:</label>
<input type="text" name="state" id="state" class="form-control">

<table id="people" border="1">
  <thead>
    <th>Name</th>
    <th>Gender</th>
  </thead>
  <tbody>

  </tbody>
</table>
<button type="submit">submit</button>
<div id="output"></div>
  <form id="formID"></form>

</form>
<?php require_once("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {

$('#state').autocomplete({
          source:'get_state_ajax.php',
          minLength:0,
          scroll:true,
          change: function (event, ui){

                    if (ui.item == null)
                      { $('#state').val("");

                        return false; }
                   else
                      { $('#state').val(ui.item.value);


                        return false; } }
        });


$('#state').on("blur", function() {
  var id = $(this).val();
  $.ajax({
    url : "get_state_ajax_district.php",
    data : {"id" : id},
    type : "GET",
    dataType : "json",
       error: function(xhr, error) {
              alert('Error!  Status = ' + xhr.status + ' Message = ' + error);
            },
    success : function(data) {
    var districtHTML = "";

      // Loop through Object and create peopleHTML
      for (var key in data) {
        if (data.hasOwnProperty(key)) {
          districtHTML += "<tr>";
            districtHTML += "<td>" + "<input>" + data[key]["district_name"] + "<name1>" + "</td>";
            districtHTML += "<td>" + "<input>" + data[key]["state_id"] + "<name2>" + "</td>";
          districtHTML += "</tr>";
        }
      }

      // Replace table’s tbody html with peopleHTML
      $("#people tbody").html(districtHTML);
      $("#output div").html(data);

    }
  });
});

});
</script>
