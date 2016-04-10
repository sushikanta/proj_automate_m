<?php require_once("config.php"); session_start();

if(isset($_POST['cur_pass'])) {
$cur_pass = md5(mysqli_real_escape_string($con, $_POST['cur_pass']));
$user_id = $_SESSION['user_id'];

$sql_check = mysqli_query($con, "SELECT user_id FROM user_table WHERE user_password='".$cur_pass."' AND user_id = '$user_id'") or die(mysqli_error($con));

if(mysqli_num_rows($sql_check) =='0') {
    echo '<font color="red"><strong>'. 'Invalid'.'</strong>'.' Password'.'</font>';
} else {
    echo 'OK';
}
}
?>