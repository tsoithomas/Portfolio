<?php

function showproject($projectid=null){
	if (!isset($projectid)) $projectid=SGET('projectid');
	
	global $db;
	
	$user=userinfo();
	
	$query="select * from projects where projectid=?";
	$rs=sql_prep($query,$db,array($projectid));

	
	if (!$myrow=sql_fetch_assoc($rs)) die(_tr('record_removed'));
	
	$projectname=$myrow['projectname'];
	$projectstart=$myrow['projectstart']; $dstart=date('Y-n-j',$projectstart);
	$projectend=$myrow['projectend']; $dend=isset($projectend)?date('Y-n-j',$projectend):'';
	$projectsiteurl=$myrow['projectsiteurl'];
	$projectgithuburl=$myrow['projectgithuburl'];
	$projectimageurl=$myrow['projectimageurl'];
	$projectintro=$myrow['projectintro'];
	$projectpublished=$myrow['projectpublished'];
	

	header('newtitle:'.tabtitle(htmlspecialchars($projectname)));
	makechangebar('project_'.$projectid,"updateproject('$projectid','".makegskey('updateproject_'.$projectid)."');");
	makesavebar('project_'.$projectid);
?>
<div class="section">
	<div class="sectiontitle">
		<a id="vrectitle_projectname_<?php echo $projectid;?>" onclick="gid('vrectitle_projectname_<?php echo $projectid;?>').style.display='none';gid('mrectitle_projectname_<?php echo $projectid;?>').style.display='inline';">
			<?php echo htmlspecialchars($projectname);?> <span class="edithover"></span>
		</a>
		<span id="mrectitle_projectname_<?php echo $projectid;?>" style="display:none;">
			<input class="inpmed" id="dir_projectname_<?php echo $projectid;?>" 
				value="<?php echo htmlspecialchars($projectname);?>" 
			>
			<button onclick="updateproject_rectitle(<?php echo $projectid;?>);">Update</button>
			&nbsp;
			<button class="trivial" onclick="gid('vrectitle_projectname_<?php echo $projectid;?>').style.display='inline';gid('mrectitle_projectname_<?php echo $projectid;?>').style.display='none';">Cancel</button>
		</span>
	</div><!-- sectiontitle -->

	<div class="col">


	<div class="inputrow" style="display:none;">
		<div class="formlabel"><?php tr('project_label_projectname');?>:</div>
		<input class="inpmed" id="projectname_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($projectname);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectstart');?>:</div>
		<input class="inpmed" id="projectstart_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($dstart);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectend');?>:</div>
		<input class="inpmed" onfocus="pickdate(this);" onkeyup="_pickdate(this);" id="projectend_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($dend);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectsiteurl');?>:</div>
		<input class="inpmed" id="projectsiteurl_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($projectsiteurl);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectgithuburl');?>:</div>
		<input class="inpmed" id="projectgithuburl_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($projectgithuburl);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectimageurl');?>:</div>
		<input class="inpmed" id="projectimageurl_<?php echo $projectid;?>" value="<?php echo htmlspecialchars($projectimageurl);?>" oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
	</div>
	<div class="inputrow">
		<input type="checkbox" id="projectpublished_<?php echo $projectid;?>" <?php if ($projectpublished) echo 'checked';?> onclick="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');">
        <label for="projectpublished_<?php echo $projectid;?>"><?php tr('project_label_projectpublished');?></label>
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectintro');?>:</div>
		<textarea class="inplong" id="projectintro_<?php echo $projectid;?>"  oninput="this.onchange();" onchange="marktabchanged('project_<?php echo $projectid;?>');"><?php echo htmlspecialchars($projectintro);?></textarea>
	</div>

	
	<div class="inputrow buttonbelt">
		<button onclick="updateproject('<?php echo $projectid;?>','<?php emitgskey('updateproject_'.$projectid);?>');"><?php tr('button_update');?></button>

		&nbsp; &nbsp;
		<button class="warn" onclick="delproject('<?php echo $projectid;?>','<?php emitgskey('delproject_'.$projectid);?>');"><?php tr('button_delete');?></button>


	</div>


	</div>
	<div class="col">

	</div>
	<div class="clear"></div>
</div>
<?php
}
