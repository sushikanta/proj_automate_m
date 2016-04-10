<?php
    require_once('config.php');
    $state_id = $_REQUEST['id'];
    $result = mysqli_query($con, "SELECT `district_id`, `district_name`, `state_id` FROM `district_tbl` WHERE state_id = '$state_id'");
?>
<?php while ($row = mysqli_fetch_array($result))
{

    $data[] = array(
                   'district_id' => $row['district_id'],
                    'district_name' => $row['district_name'],
                    'state_id' => $row['state_id'],
                );

}
 echo json_encode($data);
  flush();
 ?>
