<?php
/*
* AUTEST 
* @author HUST AU sicun studio
* version v0.1
* Without Input-checking
*/
class AuList{
    private $name=null;
    private $department=null;
    private $contact=null;
    private $Type=null;        //two dimensional array
    
    private $peCourse=null;
    
    private $className=null;
    private $advan=null;
    private $disAdvan=null;
    private $location=null;
    private $others=null;

    private $course=null;
    
    
    public function setSports($peCourse){
        $this->peCourse=$peCourse;
    }
    public function setStudy($className,$advan,$disAdvan,$location,$others){
        $this->className=$className;
        $this->advan=$advan;
        $this->disAdvan=$disAdvan;
        $this->location=$location;
        $this->others=$others;
    }
    public function setCourse($course){
        $this->course=$course;
    }
    
    
    function __construct($name,$department,$contact,$Type){
        $this->name=$name;
        $this->department=$department;
        $this->contact=$contact;
        $this->Type=$Type;
        return $this->add();
    }
    
    //»ù±¾ÐÅÏ¢Â¼Èë
    private function add(){
        $mysql=new SaeMysql();
        
        $this->name=$mysql->escape($this->name);
        $this->department=$mysql->escape($this->department);
        $this->contact=$mysql->escape($this->contact);
        $this->Type=$mysql->escape($this->Type);
        
        $sql="insert into au_list(name,department,contact,type) values('$this->name','$this->department','$this->contact','$this->Type')";
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
    public function addCourse(){
        $mysql=new SaeMysql();
        $this->course=$mysql->escape($this->course);
        $sql_addCourse="insert into au_list(course) values('$this->course')";
        $mysql->runSql($sql_addCourse);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    //Ìí¼Ó×ÔÏ°ÐÅÏ¢
   public function addStudy(){
        $mysql=new SaeMysql();

        $this->className=$mysql->escape($this->className);
        $this->advan=$mysql->escape($this->advan);
        $this->disAdvan=$mysql->escape($this->disAdvan);
        $this->location=$mysql->escape($this->location);
        $this->others=$mysql->escape($this->others);

        $sql_addStudy="insert into au_list(classname,advan,disadvan,location,others) values('$this->className','$this->advan','$this->disAdvan','$this->location','$this->others')";
        $mysql->runSql($sql_addStudy);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    //Ìí¼ÓÌåÓýÖú¿¼
    public function addPes(){
        $mysql=new SaeMysql();
        $this->peCourse=$mysql->escape($this->peCourse);
        $sql_addPes="insert into au_list(pecourse) values('$this->peCourse')";
        $mysql->runSql($sql_addPes);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    
}   
	$name=$_POST['name'];
	$department=$_POST['department'];
	$contact=$_POST['contact'];
	$type=$_POST['type'];


  	foreach($_POST['type'] as $type){
  		if($aulist=new AuList($_POST['name'],$_POST['department'],$_POST['contact'],$_POST['type'])){  
  			echo("Basic Information Successfully added!");
  		}
    	if($_POST['type']=="pe"){
        	$aulist->setSports($_POST['pe']);
        	if($aulist->addPes()){
        		echo("Sports Successfully added!");
    		}
    	}else if($_POST['type']=="study"){
        	$aulist->setStudy($_POST['className'],$_POST['advan'],$_POST['disAdvan'],$_POST['location'],$_POST['others']);
        	if($aulist->addStudy()){ 
        		echo("Studying  Information Successfully added!");
        	}
    	}else{
        	$aulist->setCourse($_POST['course']);
        	if($aulist->addCourse()){  
        		echo("Course Information Successfully added!");
        	}
    }
}  


  /*
   * 将各种助考对应的类分开
   */



/*class AuSports{ 
	private $peCourse=null;
	function __construct($peCourse){ 
		$this->peCourse=$peCourse;
		return $this->addPes;
	}
	private function addPes(){ 
		$mysql=new SaeMysql();
		$this->peCourse=$mysql->escape($this->peCourse);
        $sql_addPes="insert into au_list(pecourse) values('$this->peCourse')";
        $mysql->runSql($sql_addPes);
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
	private $className=null;
    private $advan=null;
    private $disAdvan=null;
    private $location=null;
    private $others=null;

    function __construct($className,$advan,$disAdvan,$location,$others){ 
    	$this->className=$className;
    	$this->advan=$advan;
    	$this->disAdvan=$disAdvan;
    	$this->location=$location;
    	$this->others=$others;
    	return $this->addStudy();
    }
    private function addStudy(){ 
    	$mysql=new SaeMysql();
    	
    	$this->className=$mysql->escape($this->className);
        $this->advan=$mysql->escape($this->advan);
        $this->disAdvan=$mysql->escape($this->disAdvan);
        $this->location=$mysql->escape($this->location);
        $this->others=$mysql->escape($this->others);
        
        $sql_addStudy="insert into au_list(classname,advan,disadvan,loaction,others) values('$this->className','$this->advan','$this->disAdvan','$this->location','$this->others')";
        $mysql->runSql($sql_addStudy);
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
	private $course;

	function __construct($course){ 
		$this->course=$course;
		return $this->addCourse();
	}
	private function addCourse(){ 
		$mysql=new SaeMysql();
		$this->Course=$mysql->escape($this->course);
        $sql_addCourse="insert into au_list(course) values('$this->course')";
        $mysql->runSql($sql_addCourse);
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
		$aulist=new AuList($_POST['name'],$_POST['department'],$_POST['contact'],$_POST['type']);
	

		if($_POST['type']=="pe"){
        	$ausports=new AuSports($_POST['pe']);
        	if($aulist&&$ausports)  
				return true;
    	}else if($_POST['type']=="Learn"){
        	$aulearn=new AuLearn($_POST['className'],$_POST['advan'],$_POST['disAdvan'],$_POST['location']);
        	if($aulist&&$aulearn)   
				return true;
       	}
    	else{
        	$auclass=new AuClass($_POST['course']);
        	if($aulist&&$auclass)  
				return true;
        	
    	}
	}
*/



?>

