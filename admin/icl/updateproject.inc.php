<?php

include 'icl/showproject.inc.php';

function updateproject(){
	$projectid=GETVAL('projectid');

	$projectname=SQET('projectname');
	$projectstart=date2stamp(SQET('projectstart'));
	$projectend=SQET('projectend')==''?null:date2stamp(SQET('projectend'));
	$projectsiteurl=SQET('projectsiteurl');
	$projectgithuburl=SQET('projectgithuburl');
	$projectimageurl=SQET('projectimageurl');
	$projectintro=SQET('projectintro');
	$projectpublished=QETVAL('projectpublished');


	global $db;
	$user=userinfo();
	$gsid=$user['gsid'];
	
	checkgskey('updateproject_'.$projectid);

	$query="select * from projects where projectid=?"; 
	$rs=sql_prep($query,$db,array($projectid));
	$before=sql_fetch_assoc($rs);

	$query="update projects set projectname=?,projectstart=?,projectend=?,projectsiteurl=?,projectgithuburl=?,projectimageurl=?,projectintro=?,projectpublished=? where projectid=?";
	sql_prep($query,$db,array($projectname,$projectstart,$projectend,$projectsiteurl,$projectgithuburl,$projectimageurl,$projectintro,$projectpublished,$projectid));

	$query="select * from projects where projectid=?"; 
	$rs=sql_prep($query,$db,array($projectid));
	$after=sql_fetch_assoc($rs);
	
	$dbchanges=array('projectid'=>$projectid,'projectname'=>"$projectname");
	$diffs=diffdbchanges($before,$after);
	$dbchanges=array_merge($dbchanges,$diffs); //arg3-masks, arg4-omits
	
	$dbchanges=array_merge($dbchanges,$diffs);
	$trace=array(
		'table'=>'projects',
		'recid'=>$projectid,
		'after'=>$after,
		'diffs'=>$diffs
	);
			
	logaction("updated Project #$projectid $projectname",
		$dbchanges,
		array('rectype'=>'project','recid'=>$projectid),0,$trace);

	showproject($projectid);
}
