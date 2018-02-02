<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>       
       
<?php
include 'user.php';
$user = new User();
$conditions['where'] = array('id' => $sessData['userID'],);
$conditions['return_type'] = 'single';
$userData = $user->getRows($conditions);
?>


<?php
$dir=$userData['first_name'];
echo shell_exec("./calculate.sh $dir");
header("Location:https://navyxp.com/navpay/$dir/");
?>

