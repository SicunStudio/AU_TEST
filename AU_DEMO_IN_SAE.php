<?php
$mysql=new SaeMysql();
$username=$mysql->escape($_POST['name']);
$Majority=$mysql->escape($_POST['Major']);
$PhoneNum=$mysql->escape($_POST['Major']);
$Type=$mysql->escape($_POST['Type']);

$sql="insert into au_list(name,major,phonenum) values('$username','$Majority','$PhoneNum')";
$mysql->runSql($sql);
if( $mysql->errno() != 0 )
{
     	die( "Error:" . $mysql->errmsg() );
}
if($Type=="sports"){
            $SportsType=$mysql->escape($_POST['sports']);     //运动项目
            addSports($SportsType);
            if( $mysql->errno() != 0 )
            {
     	          die( "Error:" . $mysql->errmsg() );
            }
        }else if($Type=="Learn"){
            $ClassIn=$mysql->escape($_POST['class']);      //年级班级
            $AdvProject=$mysql->escape($_POST['advproject']);   //优势学科
            $disProject=$mysql->escape($_POST['disproject']);   //劣势学科
            $Location=$mysql->escape($_POST['place']);           //自习地点
            addLearn($Type,$Grade,$AdvProject,$disProject,$Location);
            if( $mysql->errno() != 0 )
            {
     	          die( "Error:" . $mysql->errmsg() );
            }
        }else{
            $class=$mysql->escape($_POST['class']);          //选择串讲科目
            addClass($Type,$class);
            if( $mysql->errno() != 0 )
            {
     	          die( "Error:" . $mysql->errmsg() );
            }
}
    Function addSports($SportsType){
        $sql_addSport="insert into au_list(type,sports) values('$Type','$SportsType')";
        $mysql->runSql($sql_addSport);
    }
    Function addLearn($Type,$Grade,$AdvProject,$disProject,$place){
        $sql_addLearn="insert into au_list(type,classin,advproject,disproject,place) values('$Type','$ClassIn','$AdvProject','$disProject','$place')";
        $mysql->runSql($sql_addLearn);
    }
    Function addClass($Type,$class){
        $sql_addClass="insert into au_list(type,class) values('$Type','$class')";
        $mysql->runSql($sql_addClass);
    }
    $mysql->closeDb;
    
/*$username=$_POST['UserName'];
$Majority=$_POST['Major'];    //专业
$PhoneNum=$_POST['PhoneNum'];  //手机号
    
$Type=$_POST['Type'];   //助考类型

$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);


if($link)
{
    mysql_select_db(SAE_MYSQL_DB,$link);
    //your code goes here
    mysql_query("set names 'utf8'");
    $sql="insert into au_list(name,major,phonenum) values('$username','$Majority','$PhoneNum')";
    if(!mysql_query($sql)){
        die(mysql_error());
    }
    //Basic Information Input
    
    try{
        if($Type=="sports"){
            $SportsType=$_POST['sports'];     //运动项目
            addSports($SportsType);
        }else if($Type=="Learn"){
            $ClassIn=$_POST['class'];      //年级班级
            $AdvProject=$_POST['advproject'];   //优势学科
            $disProject=$_POST['disproject'];   //劣势学科
            $place=$_POST['place'];           //自习地点
            addLearn($Type,$Grade,$AdvProject,$disProject,$place);
        }else{
            $class=$_POST['class'];          //选择串讲科目
            addClass($Type,$class);
        }
    }catch(Exception $e){
        die(mysql_error());
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
}
*/


?>