<?php 
@session_start();
include_once('../connection/db_connect.php');
$db = new Database();
if(isset($_GET['fetch_data'])){
    $where="company_id_fk='23001'";
    $result=$db->fn_fetch_data_where('tb_type_expenditure',$where);
    if(count($result)>0){
        $i=1;
        foreach($result as $row){
            if($row['status_data']=='1'){
                $status_data="ລາຍຮັບ";
            }else{
                $status_data="ລາຍຈ່າຍ";
            }
            ?>
            <tr>
                <td class="text-center"><?php echo $i++;?></td>
                <td><?php echo $row['type_expenses_name']?></td>
                <td><?php echo $status_data?></td>
               <td><?php echo $row['type_remark']?></td>
               <td class="text-center">
                <span class="badge bg-success px-2 py-2" role="button"><i class="fas fa-edit"></i></span>
               <span class="badge bg-danger px-2 py-2" role="button"><i class="fas fa-edit"></i></span>
            </td>

            </tr>
            <?php
        }
    }else{
        echo 'adasd';
    }
}
?>