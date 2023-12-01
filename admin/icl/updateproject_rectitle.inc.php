<?php

function updateproject_rectitle($projectid=null){
	if (!isset($projectid)) $projectid=GETVAL('projectid');
	global $db;

	$projectname=SGET('projectname');
	
	$query="select projectname from projects where projectid=?";
	$rs=sql_prep($query,$db,array($projectid));
	$before=sql_fetch_assoc($rs);
	
	if ($before['projectname']!=$projectname){
		$query="update projects set projectname=? where projectid=?";
		sql_prep($query,$db,array($projectname,$projectid));
	
		$dbchanges=array('projectid'=>$projectid);	
		$after=array('projectname'=>$projectname);
		$diffs=diffdbchanges($before,$after);
		
		$dbchanges=array_merge($dbchanges,$diffs);
		$trace=array(
			'table'=>'projects',
			'recid'=>$projectid,
			'after'=>$after,
			'diffs'=>$diffs
		);
		header('newtitle:'.tabtitle($projectname));
		logaction("changed projectname of project_$projectid",$dbchanges,array('rectype'=>'project','recid'=>$projectid),0,$trace);
	
	} else {
		echo "No changes made";
	}
	
}

