<?php
   class App{
    public function myapp(){
   // include_once('service/database/connection.php');
 
       // if(@$_SESSION['CHECK_BUFFET'] != '1'){
            //include_once('login.php');
           // include_once('public/myapp/home/dashboard.php');
       // }else{
        
        if(isset($_REQUEST['home'])){
            include_once('public/myapp/home/dashboard.php');
        }
        elseif(isset($_REQUEST['type'])){
            include_once('public/myapp/settings/type-exp-income.php');
        }
        
        
        elseif (isset($_REQUEST['login'])) {
            include_once('login.php');
        } elseif (isset($_REQUEST['logout'])) {
            include_once('logout.php');
        }
       // else{
          //  include_once('public/myapp/home/dashboard.php');
        //}
    }
   // }
}
?>