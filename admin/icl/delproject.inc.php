<?php

function delproject(){
	$projectid=SGET('projectid');
	global $db;
	$user=userinfo();
	
	checkgskey('delproject_'.$projectid);	
	$query="select * from projects where projectid=?";
	$rs=sql_prep($query,$db,array($projectid));
	if (!$myrow=sql_fetch_array($rs)) die('Invalid project record');
	
	$projectname=$myrow['projectname'];
	
	$query="delete from projects where projectid=?";
	sql_prep($query,$db,array($projectid));		
	logaction("deleted Project #$projectid $projectname",
		array('projectid'=>$projectid,'projectname'=>$projectname),
		array('rectype'=>'project','recid'=>$projectid));
}
