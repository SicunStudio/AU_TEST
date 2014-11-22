<?php
    /*
    * The Demo Not Using The Class SaeMysql
    */
    $username=$_POST['UserName'];
    $Majority=$_POST['Major'];
    $PhoneNum=$_POST['PhoneNum'];
    
    $Type=$_POST['Type'];   //助考类型
    
    /*
    * Open MySQL
    */
    $host='';
    $user=$username;
    $pass="";
    $link=mysql_connect($host,$user,$pass);
    if(!$link){
        die(mysql_error());
    }
    mysql_select_db('app_aliezted');
    mysql_query("set names 'utf8'");
    $sql="insert into au_list(name,major,phonenum) values('$username','$Majority','$PhoneNum')";
    //mysql_query($sql);
    if(mysql_query($sql)){
        die(mysql_error());
    }
    //$uid=mysql_insert_id();
    //Basic Information
    
    try{
        if($Type=="sports"){
            $SportsType=$_POST['sports'];
            addSports($SportsType);
        }else if($Type=="Learn"){
            $ClassIn=$_POST['class'];
            $AdvProject=$_POST['advproject'];
            $disProject=$_POST['disproject'];
            $place=$_POST['place'];
            addLearn($Type,$Grade,$AdvProject,$disProject,$place);
        }else{
            $class=$_POST['class'];
            addClass($Type,$class);
        }
    }catch(Exception $e){
        
    }
    
    mysql_close($link);
    
    Function addSports($SportsType){
        $sql_addSport="insert into au_list(type,sports) values('$Type','$SportsType')";
        mysql_query($sql_addSport);
    }
    Function addLearn($Type,$Grade,$AdvProject,$disProject,$place){
        $sql_addLearn="insert into au_list(type,classin,advproject,disproject,place) values('$Type','$ClassIn','$AdvProject','$disProject','$place')";
        mysql_query($sql_addLearn);
    }
    Function addClass($Type,$class){
        $sql_addClass="insert into au_list(type,class) values('$Type','$class')";
        mysql_query($sql_addClass);
    }
?>