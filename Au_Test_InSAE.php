<?php
/*
* AUTEST 
* @author HUST AU sicun studio
* version v0.1
* Without Input-checking
*/
header("Content-Type: text/html; charset=UTF-8");
class AuList{
    private $name=null;
    private $department=null;
    private $contact=null;
    
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
        return $this->add();
    }
    
    public function setSports($peCourse){
        $this->peCourse=$peCourse;
    }
    public function setStudy($className,$advan,$disadvan,$location,$others){
        $this->className=trim($className);
        $this->advan=trim($advan);
        $this->disadvan=trim($disadvan);
        $this->location=trim($location);
        $this->others=trim($others);
        if(!get_magic_quotes_gpc()){
			$this->className=addslashes($this->className);
            $this->advan=addslashes($this->advan);
        	$this->disadvan=addslashes($this->disadvan);
            $this->location=addslashes($this->location);
            $this->others=addslashes($this->others);
    	}
    }
    public function setCourse($course){
        $this->course=trim($course);
        if(!get_magic_quotes_gpc()){
			$this->course=addslashes($this->course);
    	}
    }
    
    public function getName(){
    	return $this->name;
    }
     public function getDepartment(){
    	return $this->department;
    }
     public function getContact(){
    	return $this->contact;
    }
     public function getPeCourse(){
    	return $this->peCourse;
    }
     public function getClassName(){
    	return $this->className;
    }
     public function getAdvan(){
    	return $this->advan;
    }
     public function getDisadvan(){
    	return $this->disadvan;
    }
     public function getLocation(){
    	return $this->location;
    }
     public function getOthers(){
    	return $this->others;
    }
     public function getCourse(){
    	return $this->course;
    }
    
    
    public function __toString(){
       
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
        $sql="insert into au_list(name,department,contact) values('$this->name','$this->department','$this->contact')";
        $mysql->runSql($sql);
        if( $mysql->errno() != 0 )
        {
            if($mysql->errno()==1062)
            	die( "该手机号已被注册，请检查后重试!"  );
            else
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
    static  function findInformation($phone){
     	$mysql=new SaeMysql();
     	$phonenum=$mysql->escape($phone);
        $sql_find="select name,department,contact,pecourse,classname,advan,disadvan,location,others,course  from au_list where contact='$phonenum'";
        $data=$mysql->getLine($sql_find);
        foreach($data as $key=>$value){
        	echo $value."<br/>";
        }
    }
}   
	//除去特殊符号
	$flag=1;
	$name=trim($_POST['name']);
	$department=trim($_POST['department']);
	$contact=trim($_POST['contact']);
	if(!get_magic_quotes_gpc()){
		$name=addslashes($name);
    	$department=addslashes($department);
        $contact=addslashes($contact);
    }
	
	//Code here...
	if($_POST['phone']!=NULL){
        AuList::findInformation(trim($_POST['phone']));   
	}else if($aulist=new AuList($name,$department,$contact)){  
        if($flag){
            echo("你的信息已成功录入！".'<br />');
        	$flag=0;
        }else{
        	echo("信息修改成功");
        }
        	echo("姓名：".$aulist->getName().'<br />');
        	echo("院系：".$aulist->getDepartment().'<br />');
            echo("手机号：".$aulist->getContact().'<br />');
        //update
        	if($_POST['pe']==1){
                $aulist->addType('pe');
                $aulist->setSports($_POST['peCourse']);
        		if($aulist->addPes()){
                    echo("体育助考项目:".$aulist->getPeCourse());
    			}
    		}
        	if($_POST['study']==1){
                $aulist->addType('study');
                $aulist->setStudy($_POST['className'],$_POST['advan'],$_POST['disadvan'],$_POST['location'],$_POST['others']);
        		if($aulist->addStudy()){ 
                    echo("一对一自习：".'<br />');
                    echo("院系班级：".$aulist->getClassName().'<br />');
                    echo("优势学科：".$aulist->getAdvan().'<br />');
                    echo("劣势学科：".$aulist->getDisadvan().'<br />');
                    echo("自习地点：".$aulist->getLocation().'<br />');
                    echo("其他要求：".$aulist->getOthers().'<br />');
        		}
    		}
        	if($_POST['teach']==1){
                $aulist->addType('learn');
                $aulist->setCourse($_POST['course']);
        		if($aulist->addCourse()){  
                    
                    echo("串讲课目：".$aulist->getCourse());
        		}
            }
                
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