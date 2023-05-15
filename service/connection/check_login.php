<?php 
session_start();
include_once('db_connect.php');
$db = new Database();
if(isset($_GET['check'])){
 $user_login="tb_users
 INNER JOIN tb_branch_offic ON tb_users.branch_id_fk = tb_branch_offic.branch_id";
$x="users_email='".$_POST['user_email']."' AND  users_password='".$_POST['user_password']."'";
$row_data = $db->fn_fetch_single_edit($user_login,$x);
$count_data=$db->fn_count_rows_where_all($user_login,$x);
if($count_data >0){
$_SESSION['users_fk']=$row_data['users_id'];
$_SESSION['branch_fk']=$row_data['branch_id_fk'];
$_SESSION['branch_name']=$row_data['branch_name'];
$_SESSION['depart_fk']=$row_data['depart_id_fk'];
$_SESSION['user_name']=$row_data['users_name'];
$_SESSION['user_email']=$row_data['users_email'];
$_SESSION['user_status']=$row_data['users_status'];
$_SESSION['porvince_fk']=$row_data['porvince_id_fk'];
$_SESSION['district_fk']=$row_data['district_id_fk'];
$_SESSION['Exchange']=1;
echo json_encode(array("statusCode" => 200));exit;
}else{
    echo json_encode(array("statusCode" => 204));exit;
}

}


if(isset($_GET['edit_pass'])){
    $where="users_password='".$_POST['old_username']."' AND users_id='".$_SESSION['users_fk']."'";
    $count=$db->fn_count_rows_where_all('tb_users',$where);
    if($count>0){
        $field="users_password='".$_POST['new_password']."'";
$success=$db->edit_data_one('tb_users',$field,$where);
if($success){
    echo json_encode(array("statusCode" => 200));exit;
}else{
    echo json_encode(array("statusCode" => 202));exit;
}
    }else{
        echo json_encode(array("statusCode" => 204));exit;
    }
}
?>