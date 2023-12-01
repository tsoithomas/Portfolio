<?php

function listprojects(){
	global $db;
	
	$user=userinfo();
	$gsid=$user['gsid'];
	
	$mode=SGET('mode');
	$key=SGET('key',0); //do not trim
	
	$page=isset($_GET['page'])?intval($_GET['page']):0;
	
	header('listviewtitle:'.tabtitle(_tr('icon_projects')));
	header('listviewflag:'._jsflag('showproject'));
	header('listviewjs:projects.js');
		
	if ($mode!='embed'){

?>
<div class="section">
<div class="listbar">
	<form class="listsearch" onsubmit="_inline_lookupproject(gid('projectkey'));return false;" style="position:relative;">
		<div class="listsearch_">
			<input id="projectkey" class="img-mg" onfocus="document.hotspot=this;" onkeyup="_inline_lookupproject(this);" autocomplete="off">
			<img src="imgs/inpback.gif" class="inpback" onclick="inpbackspace('projectkey');_inline_lookupproject(gid('projectkey'));">
		</div>
		<input type="image" src="imgs/mg.gif" class="searchsubmit" value=".">
		<?php makehelp('projectlistlookup','listviewlookup',1);?>
	</form>

	<div style="padding-top:10px;">
	<a class="recadder" onclick="addtab('project_new','<?php tr('list_project_add_tab');?>','newproject');"> <img src="imgs/t.gif" class="img-addrec"><?php tr('list_project_add');?></a>
	</div>
</div>

<div id="projectlist">
<?php		
	}

	$params=array();
	
	$basequery=" from projects where 1 ";	

	
	$soundex=is_numeric(SGET('soundex'))?SGET('soundex'):0;
	$sxsearch='';
	if ($soundex&&$key!='') {
		$sxsearch=" or concat(soundex(projectname),'') like concat(soundex(?),'%') ";
		
	}
	
	if ($key!='') {
		$basequery.=" and (projectname like ? $sxsearch) ";
		array_push($params,"%$key%");
		
		if ($soundex) array_push($params,$key);
	}
	
	$sel='*'; //be specific with the select
	$cquery="select count(*) as c $basequery ";
	$query="select $sel $basequery ";		
	$rs=sql_prep($cquery,$db,$params);
	
	$myrow=sql_fetch_assoc($rs);
	$count=$myrow['c']; //sql_affected_rows($db,$rs);
	
	$perpage=20;
	$maxpage=ceil($count/$perpage)-1;
	if ($maxpage<0) $maxpage=0;
	if ($page<0) $page=0;
	if ($page>$maxpage) $page=$maxpage;
	$start=$perpage*$page;

	$pager='';
	
	if ($maxpage>0){
	ob_start();
?>
<div class="listpager">
<a href=# class="hovlink" onclick="ajxpgn('projectlist',document.appsettings.codepage+'?cmd=slv_codegen__projects&key='+encodeHTML(gid('projectkey').value)+'&page=<?php echo $page-1;?>&mode=embed');return false;"><img src="imgs/t.gif" class="img-pageleft">Prev</a>
&nbsp;
<a class="pageskipper" onclick="var pagenum=sprompt('Go to page:',<?php echo $page+1;?>);if (pagenum==null||parseInt(pagenum,0)!=pagenum) return false;ajxpgn('projectlist',document.appsettings.codepage+'?cmd=slv_codegen__projects&key='+encodeHTML(gid('projectkey').value)+'&page='+(pagenum-1)+'&mode=embed');return false;"><?php echo $page+1;?></a>
 of <?php echo $maxpage+1;?>
&nbsp;
<a href=# class="hovlink" onclick="ajxpgn('projectlist',document.appsettings.codepage+'?cmd=slv_codegen__projects&key='+encodeHTML(gid('projectkey').value)+'&page=<?php echo $page+1;?>&mode=embed');return false;">Next<img src="imgs/t.gif" class="img-pageright"></a>
</div>
<?php		
	$pager=ob_get_clean();
	}
	
	echo $pager;
	
	$query.=" order by projectname limit $start,$perpage";	
	
	$rs=sql_prep($query,$db,$params);
	
	while ($myrow=sql_fetch_array($rs)){
		$projectid=$myrow['projectid'];
		$projectname=$myrow['projectname'];
		
		$projecttitle="$projectname"; //change this if needed
		
		$dbprojecttitle=noapos(htmlspecialchars(htmlspecialchars($projecttitle)));
?>
<div class="listitem"><a onclick="showproject(<?php echo $projectid;?>,'<?php echo $dbprojecttitle;?>');"><?php echo htmlspecialchars($projecttitle);?></a></div>
<?php		
	}//while
	
	echo $pager;
	
	if ($mode!='embed'){
?>
</div>
</div>
<?php
/*
<script>
gid('tooltitle').innerHTML='<a><?php tr('icon_projects');?></a>';
ajxjs(<?php jsflag('showproject');?>,'projects.js');
</script>
<?php	
*/

	}//embed mode

}

