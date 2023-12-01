<?php
include 'icl/listprojects.inc.php';

function dashprojects(){
	global $uiconfig;
	header('tabctx: dash');
	header("newloadfunc: ajxjs(self.showproject,'projects.js');");
	if ($uiconfig['toolbar_position']=='top') header('newtitle: '._tr('icon_projects'));
	

?>
<div class="section">
	<div class="sectiontitle"><?php tr('icon_projects');?></div>
	
	
		<?php listprojects(); ?>
	
		<div class="clear"></div>
</div>

<?php		
}
