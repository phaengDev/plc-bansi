<?php
  class Database {


  private $db="mysql:host=localhost;dbname=bansi_plc;charset=utf8";
  private $user="root";
  private $pass="";
  public $conn;
  public function __construct(){
    try{
        $this->conn=new PDO($this->db,$this->user,$this->pass);
      //   echo "Connection is Successfull";
    }catch(Exception $e){
        echo "Connection is failed".$e->getMessage();
    }
  }

   public function fn_max_no($table,$feild){
      $sql ="SELECT MAX($feild)+1 AS no_number FROM $table ";
      $result = $this->conn->query($sql);
      $row = $result->fetch();
      if ($row["no_number"] == '') {
          $max_id ="000001";
      } else {
         $max_id = sprintf("%06d", $row['no_number']);
      }
      return $max_id;
  }

   public function fn_max_id($table,$feild){
      $id_max=date("Y");
      $sql ="SELECT MAX($feild) AS id_auto FROM $table ";
      $result = $this->conn->query($sql);
      $row = $result->fetch();
      if ($row["id_auto"] == '') {
          $max_id =$id_max."00001";
      } else {
          $max_id = $row["id_auto"]+1;
      }
      return $max_id;
  }




  public function fn_fetch_data_all($table){
   $data=array();
   $sql="SELECT * FROM $table";
   $result=$this->conn->query($sql);
   foreach($result as $row){
       $data[]=$row;
   }
   return $data;
}

public function fn_fetch_data_field($table, $field){
   $data=array();
   $sql="SELECT $field FROM $table";
   $result=$this->conn->query($sql);
   $result->execute();
   foreach($result as $row){
       $data[]=$row;
   }
   return $data;
}

public function fn_fetch_data_where($table,$where_data){
   $data=array();
   $sql="SELECT * FROM $table WHERE $where_data ";
   $result=$this->conn->query($sql);
   foreach($result as $row){
       $data[]=$row;
   }
   return $data;
}

public function fn_fetch_data_field_where($table,$field_data,$where_data ){
   $data=array();
   $sql="SELECT $field_data FROM $table  WHERE $where_data";
   $result=$this->conn->query($sql);
   foreach($result as $row){
       $data[]=$row;
   }
   return $data;

}

public function fn_count_rows_all($table){
   $sql="SELECT * FROM $table ";
   $result=$this->conn->query($sql);
   $num=$result->rowCount();
   return $num;
}

public function fn_count_rows_where($table,$where_data){
   $sql="SELECT * FROM $table WHERE $where_data";
   $result=$this->conn->query($sql);
   $num=$result->rowCount();
   return $num;
}

public function fn_count_rows_field_where($table,$field,$where_data){
   $sql="SELECT $field FROM $table WHERE $where_data";
   $result=$this->conn->query($sql);
   $num=$result->rowCount();
   return $num;
}
public function fn_fetch_field($table,$field){
   $sql="SELECT $field FROM $table ";
   $result = $this->conn->query($sql);
   $row = $result->fetch();
   return $row;
}


public function fn_fetch_single_edit($table,$where_data){
    $sql="SELECT * FROM $table WHERE $where_data ";
    $result = $this->conn->query($sql);
    $row = $result->fetch();
    return $row;
}

public function fn_fetch_sum_data($table,$field_data,$where_data){
   $sql="SELECT $field_data FROM $table WHERE $where_data";
   $result = $this->conn->query($sql);
   $row = $result->fetch();
   return $row;
}



public function fn_fetch_data_group_by($table_all,$fied_all,$where_data,$group_by){
   $data=array();
   $sql="SELECT $fied_all FROM $table_all WHERE $where_data GROUP BY $group_by";
   $result=$this->conn->query($sql);
   foreach($result as $row){
       $data[]=$row;
   }
   return $data;
}

 public function edit_data_one($table,$field_get,$where_data){
   $sql="UPDATE $table SET $field_get WHERE $where_data ";
   $this->conn->query($sql);
   return true;
}
public function edit_data_all($table,$field_get){
   $sql="UPDATE $table SET $field_get ";
   $this->conn->query($sql);
   return true;
}

public function fn_delete($table,$where_data){
   $sql="DELETE FROM $table WHERE $where_data ";
   $this->conn->query($sql);
   return true;
}
public function fn_delete_one($table,$filed_id,$where_id){
   $sql="DELETE FROM $table WHERE $filed_id = '".$where_id."' ";
   $this->conn->query($sql);
   return true;
}


// ====================================

public function create_tb_setting_menu($setting_menu_id,$depart_id_fk,$sub_menu_id_fk){
   $sql="INSERT INTO tb_setting_menu  VALUES('".$setting_menu_id."','".$depart_id_fk."','".$sub_menu_id_fk."')";
   $this->conn->query($sql);
   return true;
}

public function insert_tb_department($depart_id,$depart_name){
   $sql="INSERT INTO tb_department(depart_id,depart_name)VALUES('".$depart_id."','".$depart_name."')";
   $this->conn->query($sql);
   return true;
}

public function edit_tb_department($depart_id,$depart_name){
   $sql="UPDATE tb_department SET depart_name='".$depart_name."' WHERE depart_id='".$depart_id."' ";
   $this->conn->query($sql);
   return true;
}
// ====================================

public function insert_tb_type_expenditure($type_expenses_id,$company_id_fk,$type_expenses_name,$status_data,$type_remark){
   $sql="INSERT INTO tb_type_expenditure(type_expenses_id,company_id_fk,type_expenses_name,status_data,type_remark)VALUES('".$type_expenses_id."','".$company_id_fk."','".$type_expenses_name."','".$status_data."','".$type_remark."')";
   $this->conn->query($sql);
   return true;
}

public function edit_tb_type_expenditure($type_expenses_id,$type_expenses_name,$status_data,$type_remark){
   $sql="UPDATE tb_type_expenditure SET type_expenses_name='".$type_expenses_name."' WHERE type_expenses_id='".$type_expenses_id."',status_data='".$status_data."',type_remark='".$type_remark."' ";
   $this->conn->query($sql);
   return true;
}
// =================================


public function insert_tb_expenses($expenses_id,$expenses_branch_fk,$currency_id_fk,$type_expenses_fk,$expenses_text_lits,$expenses_qty,$expenses_prices,$pay_expenses,$number_onepay,$expenses_doc_file,$expenses_date,$expenses_status_off,$expenses_date_off){
    $sql="INSERT INTO tb_expenses(expenses_id,expenses_branch_fk,currency_id_fk,type_expenses_fk,expenses_text_lits,expenses_qty,expenses_prices,pay_expenses,number_onepay,expenses_doc_file,expenses_date,expenses_status_off,expenses_date_off)
    VALUES('".$expenses_id."','".$expenses_branch_fk."','".$currency_id_fk."','".$type_expenses_fk."','".$expenses_text_lits."','".$expenses_qty."','".$expenses_prices."','".$pay_expenses."','".$number_onepay."','".$expenses_doc_file."','".$expenses_date."','".$expenses_status_off."','".$expenses_date_off."')";
    $this->conn->query($sql);
    return true;
 }
 
 public function edit_tb_expenses($expenses_id,$currency_id_fk,$type_expenses_fk,$expenses_text_lits,$expenses_qty,$expenses_prices,$pay_expenses,$number_onepay,$expenses_doc_file,$expenses_date){
    $sql="UPDATE tb_expenses SET currency_id_fk='".$currency_id_fk."',type_expenses_fk='".$type_expenses_fk."',expenses_text_lits='".$expenses_text_lits."',expenses_qty='".$expenses_qty."',expenses_prices='".$expenses_prices."',pay_expenses='".$pay_expenses."',number_onepay='".$number_onepay."',expenses_doc_file='".$expenses_doc_file."',expenses_date='".$expenses_date."' WHERE expenses_id='".$expenses_id."' ";
    $this->conn->query($sql);
    return true;
 }

// =================================

public function insert_tb_income($income_id,$income_branch_fk,$currency_id_fk,$type_income_fk,$income_title,$income_money,$type_money,$income_file_doc,$income_date,$income_off_on,$date_off_on){
   $sql="INSERT INTO tb_income(income_id,income_branch_fk,currency_id_fk,type_income_fk,income_title,income_money,type_money,income_file_doc,income_date,income_off_on,date_off_on)
   VALUES('".$income_id."','".$income_branch_fk."','".$currency_id_fk."','".$type_income_fk."','".$income_title."','".$income_money."','".$type_money."','".$income_file_doc."','".$income_date."','".$income_off_on."','".$date_off_on."')";
   $this->conn->query($sql);
   return true;
}

public function edit_tb_income($income_id,$income_branch_fk,$currency_id_fk,$type_income_fk,$income_title,$income_money,$type_money,$income_file_doc,$income_date){
   $sql="UPDATE tb_income SET income_branch_fk='".$income_branch_fk."', currency_id_fk='".$currency_id_fk."',type_income_fk='".$type_income_fk."',income_title='".$income_title."',income_money='".$income_money."',type_money='".$type_money."',income_file_doc='".$income_file_doc."',income_date='".$income_date."' WHERE income_id='".$income_id."' ";
   $this->conn->query($sql);
   return true;
}

 
 // =================================

 public function insert_tb_users($users_id,$branch_id_fk,$depart_id_fk,$users_name,$users_email,$users_password,$users_status,$create_date,$status_edit,$status_delete){
   $sql="INSERT INTO tb_users VALUES('".$users_id."','".$branch_id_fk."','".$depart_id_fk."','".$users_name."','".$users_email."','".$users_password."','".$users_status."','".$create_date."','".$status_edit."','".$status_delete."')";
   $this->conn->query($sql);
   return true;
}

public function edit_tb_users($users_id,$branch_id_fk,$depart_id_fk,$users_name,$users_email,$users_status,$status_edit,$status_delete){
   $sql="UPDATE tb_users SET branch_id_fk='".$branch_id_fk."',depart_id_fk='".$depart_id_fk."',users_name='".$users_name."',users_email='".$users_email."',users_status='".$users_status."',status_edit='".$status_edit."',status_delete='".$status_delete."' WHERE users_id='".$users_id."' ";
   $this->conn->query($sql);
   return true;
}


      public function edit_tb_disbursement_budget($budget_id,$branch_id_fk,$type_budget_fk,$number_bill_invoice,$budget_money_lak,$currency_id_fk,$budget_money_total,$money_lift_balance,$file_invoice,$butget_remark,$budget_date){
         $sql="UPDATE  tb_disbursement_budget SET branch_id_fk='".$branch_id_fk."',type_budget_fk='".$type_budget_fk."',number_bill_invoice='".$number_bill_invoice."',budget_money_lak='".$budget_money_lak."',currency_id_fk='".$currency_id_fk."',budget_money_total='".$budget_money_total."',money_lift_balance='".$money_lift_balance."',file_invoice='".$file_invoice."',butget_remark='".$butget_remark."',budget_date='".$budget_date."' 
         WHERE budget_id='".$budget_id."' ";
         $this->conn->query($sql);
         return true;
      }


      public function insert_tb_cash_treasury($treasury_group_id,$company_id_fk,$account_name,$account_number,$currency_id_fk,$money_treasury_total,$status_off_on){
         $sql="INSERT INTO tb_cash_treasury(treasury_group_id,company_id_fk,account_name,account_number,currency_id_fk,money_treasury_total,status_off_on) 
         VALUES('".$treasury_group_id."','".$company_id_fk."','".$account_name."','".$account_number."','".$currency_id_fk."','".$money_treasury_total."','".$status_off_on."')";
         $this->conn->query($sql);
         return true;
      }

      public function edit_tb_cash_treasury($treasury_group_id,$account_name,$account_number,$currency_id_fk,$money_treasury_total,$status_off_on){
         $sql="UPDATE  tb_cash_treasury SET account_name='".$account_name."',account_number='".$account_number."',currency_id_fk='".$currency_id_fk."',money_treasury_total='".$money_treasury_total."',status_off_on='".$status_off_on."' WHERE treasury_group_id='".$treasury_group_id."' ";
         $this->conn->query($sql);
         return true;
      }


  }
?>