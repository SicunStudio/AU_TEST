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
            $SportsType=$mysql->escape($_POST['sports']);     //�˶���Ŀ
            addSports($SportsType);
            if( $mysql->errno() != 0 )
            {
     	          die( "Error:" . $mysql->errmsg() );
            }
        }else if($Type=="Learn"){
            $ClassIn=$mysql->escape($_POST['class']);      //�꼶�༶
            $AdvProject=$mysql->escape($_POST['advproject']);   //����ѧ��
            $disProject=$mysql->escape($_POST['disproject']);   //����ѧ��
            $Location=$mysql->escape($_POST['place']);           //��ϰ�ص�
            addLearn($Type,$Grade,$AdvProject,$disProject,$Location);
            if( $mysql->errno() != 0 )
            {
     	          die( "Error:" . $mysql->errmsg() );
            }
        }else{
            $class=$mysql->escape($_POST['class']);          //ѡ�񴮽���Ŀ
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
$Majority=$_POST['Major'];    //רҵ
$PhoneNum=$_POST['PhoneNum'];  //�ֻ���
    
$Type=$_POST['Type'];   //��������

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
            $SportsType=$_POST['sports'];     //�˶���Ŀ
            addSports($SportsType);
        }else if($Type=="Learn"){
            $ClassIn=$_POST['class'];      //�꼶�༶
            $AdvProject=$_POST['advproject'];   //����ѧ��
            $disProject=$_POST['disproject'];   //����ѧ��
            $place=$_POST['place'];           //��ϰ�ص�
            addLearn($Type,$Grade,$AdvProject,$disProject,$place);
        }else{
            $class=$_POST['class'];          //ѡ�񴮽���Ŀ
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