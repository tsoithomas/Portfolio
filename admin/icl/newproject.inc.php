<?php

function newproject(){

?>
<div class="section">
	<div class="sectiontitle"><?php tr('list_project_add_tab');?></div>
	
<div class="col">
	
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectname');?>:</div>
		<input class="inp" id="projectname_new">
	</div>
	<div class="inputrow">
		<div class="formlabel"><?php tr('project_label_projectstart');?>:</div>
		<input class="inp" id="projectstart_new" onfocus="pickdate(this);" onkeyup="_pickdate(this);">
	</div>
		

</div>
<div class="clear"></div>

	<div class="inputrow buttonbelt">
		<button onclick="addproject('<?php emitgskey('addproject');?>');"><?php tr('button_project_add');?></button>
	</div>

</div>
<?php

}
