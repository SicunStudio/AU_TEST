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
    //private $Type=null;        //two dimensional array
    
    private $peCourse=null;
    
    private $className=null;
    private $advan=null;
    private $disadvan=null;
    private $location=null;
    private $others=null;

    private $course=null;
    
    function __construct($name,$department,$contact){
        $this->name=$name;
        $this->department=$department;
        $this->contact=$contact;
        //$this->Type=$Type;
        return $this->add();
    }
    
    public function setSports($peCourse){
        $this->peCourse=$peCourse;
    }
    public function setStudy($className,$advan,$disadvan,$location,$others){
        $this->className=$className;
        $this->advan=$advan;
        $this->disadvan=$disadvan;
        $this->location=$location;
        $this->others=$others;
    }
    public function setCourse($course){
        $this->course=$course;
    }
    

    /*
    * Boolean add- method
    */
    
    public function addType($key){ 
    	$mysql=new SaeMysql();
    	$sql_type="update au_list set type=concat(type,' $key') where name='$this->name' ";
    	$mysql->runSql($sql_type);
        if( $mysql->errno() != 0 )
        {
     	      die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        return true;
    }
    //Add Basic Information
    private function add(){
        $mysql=new SaeMysql();
        
        $this->name=$mysql->escape($this->name);
        $this->department=$mysql->escape($this->department);
        $this->contact=$mysql->escape($this->contact);
        //$this->Type=$mysql->escape($this->Type);
        $sql="insert into au_list(name,department,contact) values('$this->name','$this->department','$this->contact')";
        $mysql->runSql($sql);
        if( $mysql->errno() != 0 )
        {
     	      die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        return true;
    }
        
    public function addCourse(){
        $mysql=new SaeMysql();
        $this->course=$mysql->escape($this->course);
        $sql_addCourse="update au_list set course='$this->course' where name='$this->name'";
        $mysql->runSql($sql_addCourse);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
   
   public function addStudy(){
        $mysql=new SaeMysql();

        $this->className=$mysql->escape($this->className);
        $this->advan=$mysql->escape($this->advan);
        $this->disadvan=$mysql->escape($this->disadvan);
        $this->location=$mysql->escape($this->location);
        $this->others=$mysql->escape($this->others);

        $sql_addStudy="update au_list set classname='$this->className',advan='$this->advan',disadvan='$this->disadvan',location='$this->location',others='$this->others' where name='$this->name'";
        $mysql->runSql($sql_addStudy);
        if( $mysql->errno() != 0 )
        {
     	          die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        
        return true;
    }
    
    public function addPes(){
        $mysql=new SaeMysql();
        $this->peCourse=$mysql->escape($this->peCourse);
        $sql_addPes="update au_list set pecourse='$this->peCourse' where name='$this->name'";
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
	//除去特殊符号
	$name=trim($_POST['name']);
	$department=trim($_POST['department']);
	$contact=trim($_POST['contact']);
	//$type=$_POST['type'];
	//Code here...
	
	if($aulist=new AuList($name,$department,$contact)){  
  		echo("Basic Information Successfully added!");

        //update
        //foreach($type as $key){
            //$aulist->addType($type[$i]);
            //echo($key);
        
            if($_POST['pe']==1){
                $aulist->addType('pe');
                $aulist->setSports($_POST['peCourse']);
        		if($aulist->addPes()){
        			echo("Sports Successfully added!");
    			}
    		}
        	if($_POST['study']==1){
                $aulist->addType('study');
                $aulist->setStudy($_POST['className'],$_POST['advan'],$_POST['disadvan'],$_POST['location'],$_POST['others']);
        		if($aulist->addStudy()){ 
        			echo("Studying  Information Successfully added!");
        		}
    		}
        	if($_POST['teach']==1){
                $aulist->addType('learn');
                $aulist->setCourse($_POST['course']);
        		if($aulist->addCourse()){  
        			echo("Course Information Successfully added!");
        		}
    		}
        //}
        
        /*if($_POST{'pe'}!=null){
        		$aulist->setSports($_POST['peCourse']);
        		if($aulist->addPes()){
        			echo("Sports Successfully added!");
    			}
        }else if($_POST['study']!=null){
        		$aulist->setStudy($_POST['className'],$_POST['advan'],$_POST['disAdvan'],$_POST['location'],$_POST['others']);
        		if($aulist->addStudy()){ 
        			echo("Studying  Information Successfully added!");
        		}
        }else if($_POST['course']!=null){
        		$aulist->setCourse($_POST['course']);
        		if($aulist->addCourse()){  
        			echo("Course Information Successfully added!");
        		}
        }*/
  	}

	


  /*
   * 将各种助考对应的类分开 Version 2
   */



/*
//PeClass
class AuPes{ 
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
     	          //die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Sports Successfully added!");
        return true;
	}

}
//StudyClass
class AuStudy{ 
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
     	          //die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Learning  Information Successfully added!");
        return true;
	}
}

//CourseClass
class AuCourse{  
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
     	          //die( "Error:" . $mysql->errmsg() );
                  return false;
        }
        $mysql->closeDb();
        printf("Class Information Successfully added!");
        return true;
	}

}
//BasicClass
class AuList{
    private $name=null;
    private $department=null;
    private $contact=null;
    private $Type=null;        //two dimensional array
    
    function __construct($name,$department,$contact){
        $this->name=$name;
        $this->department=$department;
        $this->contact=$contact;
        //$this->Type=$Type;
        return $this->add();
    }
    public function addType($key){ 
    	$mysql=new SaeMysql();
    	$sql_type="insert into au_list(type) values('$key')";
    	$mysql->runSql($sql_type);
        if( $mysql->errno() != 0 )
        {
     	      //die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        return true;
    }
    //Add Basic Information
    private function add(){
        $mysql=new SaeMysql();
        
        $this->name=$mysql->escape($this->name);
        $this->department=$mysql->escape($this->department);
        $this->contact=$mysql->escape($this->contact);
        //$this->Type=$mysql->escape($this->Type);
        $sql="insert into au_list(name,department,contact) values('$this->name','$this->department','$this->contact')";
        $mysql->runSql($sql);
        if( $mysql->errno() != 0 )
        {
     	      //die( "Error:" . $mysql->errmsg() );
              return false;
        }
        $mysql->closeDb();
        return true;
    }
        
    
}   
	//update
	if($aulist=new AuList($_POST['name'],$_POST['department'],$_POST['contact'])){ 
		foreach($_POST['type'] as $key){
			$aulist->addType($key);
			if($key=="pe"){
        		$ausports=new AuPes($_POST['peCourse']);
        		if($ausports)  
					return true;
    		}else if($key=="study"){
        		$aulearn=new AuStudy($_POST['className'],$_POST['advan'],$_POST['disAdvan'],$_POST['location']);
        		if($austudy)   
					return true;
       		}
    		else{
        		$aucourse=new AuCourse($_POST['course']);
        		if($aucourse)  
					return true;
        	}
		}
	}
	
*/
?>