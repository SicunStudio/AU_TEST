<?php
class AuList{
    private $username=null;
    private $Majority=null;
    private $PhoneNum=null;
    private $Type=null;
    private $SportsType=null;
    private $ClassIn=null;
    private $AdvProject=null;
    private $DisProject=null;
    private $Location=null;
    private $Class=null;
    
    
    public function setSports($Sports){
        $this->SportsType=$SportsType;
    }
    public function setLearn($ClassIn,$AdvProject,$DisProject,$Location){
        $this->ClassIn=$ClassIn;
        $this->AdvProject=$AdvProject;
        $this->DisProject=$DisProject;
        $this->Location=$Location;
    }
    public function setClass($Class){
        $this->Class=$Class;
    }
    
    
    function __construct($username,$Majority,$PhoneNum,$Type){
        $this->username=$username;
        $this->Majority=$Majority;
        $this->PhoneNum=$PhoneNum;
        $this->Type=$Type;
        $this->add();
    }
    
    //基本信息录入
    private function add(){
        $mysql=new SaeMysql();
        $sql="insert into au_list(name,major,phonenum,type) values('$this->username','$this->Majority','$this->PhoneNum','$this->Type')";
        $mysql->runSql($sql);
        if( $mysql->errno() != 0 )
        {
     	      die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        printf("Basic Information Successfully added!");
        return true;
    }
    
    
    //添加串讲课目
    public function addClass(){
        $mysql=new SaeMysql();
        $sql_addClass="insert into au_list(class) values('$this->class')";
        $mysql->runSql($sql_addClass);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Class Information Successfully added!");
        return true;
    }
    //添加自习信息
   public function addLearn(){
        $mysql=new SaeMysql();
        $sql_addLearn="insert into au_list(classin,advproject,disproject,loaction) values('$this->ClassIn','$this->AdvProject','$this->DisProject','$this->Location')";
        $mysql->runSql($sql_addLearn);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Learning  Information Successfully added!");
        return true;
    }
    //添加体育助考
    public function addSports(){
        $mysql=new SaeMysql();
        $sql_addSport="insert into au_list(sports) values('$this->SportsType')";
        $mysql->runSql($sql_addSport);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Sports Successfully added!");
        return true;
    }
    
}
    $aulist=new AuList($_POST['username'],$_POST['majority'],$_POST['phonenum'],$_POST['type']);
    if($_POST['type']=="sports"){
        $aulist->setSports($_POST['sports']);
        $aulist->addSports();
    }else if($_POST['type']=="Learn"){
        $aulist->setLearn($_POST['classin'],$_POST['advproject'],$_POST['disproject'],$_POST['location']);
        $aulist->addLearn();
    }else{
        $aulist->setClass($_POST['class']);
        $aulist->addClass();
    }


?>