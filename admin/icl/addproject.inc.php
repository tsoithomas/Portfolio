<?php

include 'icl/showproject.inc.php';

function addproject(){
	
	$projectname=SQET('projectname');
	$projectstart=date2stamp(SQET('projectstart'),0,0,0);
	
	global $db;
	$user=userinfo();
	
	checkgskey('addproject');
	
	$query="insert into projects (projectname,projectstart) values (?,?) ";
	ob_start();
	$rs=sql_prep($query,$db,array($projectname,$projectstart));
	$err=ob_get_clean();

	$projectid=sql_insert_id($db,$rs);

	if (!$projectid) {
		apperror(_tr('error_creating_record').': '.$err);
	}
	
	logaction("added Project #$projectid $projectname",array('projectid'=>$projectid,'projectname'=>"$projectname"),null,0,array(
		'table'=>'projects',
		'recid'=>$projectid,
		'after'=>array(
			'projectname'=>$projectname
		),
		'diffs'=>array(
			'projectname'=>$projectname
		)
	));
	
	header('newrecid:'.$projectid);
	header('newkey:project_'.$projectid);
	header('newparams:showproject&projectid='.$projectid);
	
	showproject($projectid);
}

