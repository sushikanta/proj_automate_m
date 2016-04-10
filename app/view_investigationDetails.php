<?php include("function.php");?>
<?php include("header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">
        
<div class="inv-main">
    <div class="panel panel-info">
          <div class="panel-heading">Add Investigation Details (Admin Section)</div>          
          
          <div class="table">
          <table class="table table-striped">
          <thead>
          <th>SL #</th>
          <th>Invest. Category</th>
          <th>Invest. Name</th>
          <th>Price</th>
          <th>Version</th>
          <th>Action</th>
          </thead>
          <tr>
          <?php 
		  $result=mysqli_query($con, "SELECT test_category_name, test_name, price, version_name FROM test_category, test_tbl, price_tbl, price_version WHERE test_tbl.test_category_id = test_category.test_category_id AND test_tbl.test_id=price_tbl.test_id AND price_tbl.price_version_id=price_version.version_id");
		$sl_no=1;
		while($row=mysqli_fetch_array($result))
	    {
	     
		echo '<td>' .$sl_no .'</td>';
        echo  '<td>'. $row['test_category_name'] . '</td>';
        echo   '<td>'. $row['test_name'] . '</td>';
        echo  '<td>' . $row['price'] .'</td>';
        echo '<td>' . $row['version_name'].'</td>';
		 echo '<td>' ."<button>Edit</button><button>Del</button>".'</td>';
        echo '</tr>';
		$sl_no++;
		}
            
          ?>
        
          </table>
        </div>
       </div>
  
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>   
   <script src="js/add_investigationDetails.js"></script>
  </body>
</html>