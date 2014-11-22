<?php
/*
* Without Input-checking
*/
class AuList{
    private $username=null;
    private $Majority=null;
    private $PhoneNum=null;
    private $Type=null;        //two dimensional array
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
        return $this->add();
    }
    
    //»ù±¾ÐÅÏ¢Â¼Èë
    private function add(){
        $mysql=new SaeMysql();
        
        $this->username=$mysql->escape($this->username);
        $this->Majority=$mysql->escape($this->Majority);
        $this->PhoneNum=$mysql->escape($this->PhoneNum);
        $this->Type=$mysql->escape($this->Type);
        
        $sql="insert into au_list(name,major,phonenum,type) values('$this->username','$this->Majority','$this->PhoneNum','$this->Type')";
        $mysql->runSql($sql);
        if( $mysql->errno() != 0 )
        {
     	      die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        return true;
    }
    
    
    //Ìí¼Ó´®½²¿ÎÄ¿
    public function addClass(){
        $mysql=new SaeMysql();
        $this->class=$mysql->escape($this->class);
        $sql_addClass="insert into au_list(class) values('$this->class')";
        $mysql->runSql($sql_addClass);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    //Ìí¼Ó×ÔÏ°ÐÅÏ¢
   public function addLearn(){
        $mysql=new SaeMysql();

        $this->ClassIn=$mysql->escape($this->ClassIn);
        $this->AdvProject=$mysql->escape($this->AdvProject);
        $this->DisProject=$mysql->escape($this->DisProject);
        $this->Location=$mysql->escape($this->Location);
        
        $sql_addLearn="insert into au_list(classin,advproject,disproject,loaction) values('$this->ClassIn','$this->AdvProject','$this->DisProject','$this->Location')";
        $mysql->runSql($sql_addLearn);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    //Ìí¼ÓÌåÓýÖú¿¼
    public function addSports(){
        $mysql=new SaeMysql();
        $this->SportsType=$mysql->escape($this->SportsType);
        $sql_addSport="insert into au_list(sports) values('$this->SportsType')";
        $mysql->runSql($sql_addSport);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    
}   
	$username=$_POST['username'];
	$majority=$_POST['majority'];
	$phonenum=$_POST['phonenum'];
	$type=$_POST['type'];


  	foreach($_POST['type'] as $type){
  	if($aulist=new AuList($_POST['username'],$_POST['majority'],$_POST['phonenum'],$_POST['type'])){  
  		echo("Basic Information Successfully added!");
  	}
    if($_POST['type']=="sports"){
        $aulist->setSports($_POST['sports']);
        if($aulist->addSports()){
        	echo("Sports Successfully added!");
    	}
    }else if($_POST['type']=="Learn"){
        $aulist->setLearn($_POST['classin'],$_POST['advproject'],$_POST['disproject'],$_POST['location']);
        if($aulist->addLearn()){ 
        	echo("Learning  Information Successfully added!");
        }
    }else{
        $aulist->setClass($_POST['class']);
        if($aulist->addClass()){  
        	echo("Class Information Successfully added!");
        }
    }
}  


  /*
   * 将各种助考对应的类分开
   */



/*class AuSports{ 
	private $SportsType=null;
	function __construct($SportsType){ 
		$this->SportsType=$SportsType;
		return $this->addSports;
	}
	private function addSports(){ 
		$mysql=new SaeMysql();
		$this->SportsType=$mysql->escape($this->SportsType);
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
class AuLearn{ 
	private $ClassIn=null;
    private $AdvProject=null;
    private $DisProject=null;
    private $Location=null;

    function __construct($ClassIn,$AdvProject,$DisProject,$Location){ 
    	$this->ClassIn=$ClassIn;
    	$this->AdvProject=$AdvProject;
    	$this->DisProject=$DisProject;
    	$this->Location=$Location;
    	return $this->addLearn();
    }
    private function addLearn(){ 
    	$mysql=new SaeMysql();
    	$this->ClassIn=$mysql->escape($this->ClassIn);
        $this->AdvProject=$mysql->escape($this->AdvProject);
        $this->DisProject=$mysql->escape($this->DisProject);
        $this->Location=$mysql->escape($this->Location);
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
}

class AuClass{  
	private $Class;

	function __construct($Class){ 
		$this->Class=$Class;
		return $this->addClass();
	}
	private function addClass(){ 
		$mysql=new SaeMysql();
		$this->class=$mysql->escape($this->class);
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

}
	foreach($_POST['type'] as $type){
		$aulist=new AuList($_POST['username'],$_POST['majority'],$_POST['phonenum'],$_POST['type']);
	

		if($_POST['type']=="sports"){
        	$ausports=new AuSports($_POST['sports']);
        	if($aulist&&$ausports)  
				return true;
    	}else if($_POST['type']=="Learn"){
        	$aulearn=new AuLearn($_POST['classin'],$_POST['advproject'],$_POST['disproject'],$_POST['location']);
        	if($aulist&&$aulearn)   
				return true;
       	}
    	else{
        	$auclass=new AuClass($_POST['class']);
        	if($aulist&&$auclass)  
				return true;
        	
    	}
	}
*/



?>