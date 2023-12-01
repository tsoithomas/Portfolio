showproject=function(projectid,name,bookmark){
	addtab('project_'+projectid,name,'showproject&projectid='+projectid,null,null,{bookmark:bookmark});	
}

_inline_lookupproject=function(d){
	var soundex='';
	if (d.soundex) soundex='&soundex=1';

	if (d.lastkey!=null&&d.lastkey==d.value) return;
	d.lastkey=d.value;
			
	if (d.timer) clearTimeout(d.timer);
	d.timer=setTimeout(function(){
		ajxpgn('projectlist',document.appsettings.codepage+'?cmd=slv_codegen__projects&mode=embed&key='+encodeHTML(d.value)+soundex);
	},200
	);	
}


addproject=function(gskey){

	var suffix='new';
	var oprojectname=gid('projectname_'+suffix);
	var oprojectstart=gid('projectstart_'+suffix);

	
	var valid=1;
	var offender=null;
	
	//delete the excessive validate rules
	if (!valstr(oprojectname)) {valid=0; offender=offender||oprojectname;}
	if (!valdate(oprojectstart)) {valid=0; offender=offender||oprojectstart;}

	//add more validation rules
	
	if (!valid) {
		if (offender&&offender.focus) offender.focus();
		return;
	}

	var projectname=encodeHTML(oprojectname.value);
	var projectstart=encodeHTML(oprojectstart.value);
	
	var params=[];
	params.push('projectname='+projectname);
	params.push('projectstart='+projectstart);
	
	reloadtab('project_new','','addproject',function(req){
		var projectid=req.getResponseHeader('newrecid');		
		reloadview('codegen.projects','projectlist');
	},params.join('&'),null,gskey);
	
}

updateproject=function(projectid,gskey){
	var suffix=projectid;
	var oprojectname=gid('projectname_'+suffix);
	var oprojectstart=gid('projectstart_'+suffix);
	var oprojectend=gid('projectend_'+suffix);
	var oprojectsiteurl=gid('projectsiteurl_'+suffix);
	var oprojectgithuburl=gid('projectgithuburl_'+suffix);
	var oprojectimageurl=gid('projectimageurl_'+suffix);
	var oprojectintro=gid('projectintro_'+suffix);
	var oprojectpublished=gid('projectpublished_'+suffix);

	
	var valid=1;
	var offender=null;
	
	//delete the excessive validate rules
	if (!valstr(oprojectname)) {valid=0; offender=offender||oprojectname;}
	if (!valdate(oprojectstart)) {valid=0; offender=offender||oprojectstart;}
	if (oprojectend.value!=''&&!valdate(oprojectend)) {valid=0; offender=offender||oprojectend;}

	//add more validation rules
	
	if (!valid) {
		if (offender&&offender.focus) offender.focus();
		return;
	}
	
	var projectname=encodeHTML(oprojectname.value);
	var projectstart=encodeHTML(oprojectstart.value);
	var projectend=encodeHTML(oprojectend.value);
	var projectsiteurl=encodeHTML(oprojectsiteurl.value);
	var projectgithuburl=encodeHTML(oprojectgithuburl.value);
	var projectimageurl=encodeHTML(oprojectimageurl.value);
	var projectintro=encodeHTML(oprojectintro.value);
	var projectpublished=oprojectpublished.checked?1:0
	
	var params=[];
	params.push('projectname='+projectname);
	params.push('projectstart='+projectstart);
	params.push('projectend='+projectend);
	params.push('projectsiteurl='+projectsiteurl);
	params.push('projectgithuburl='+projectgithuburl);
	params.push('projectimageurl='+projectimageurl);
	params.push('projectintro='+projectintro);
	params.push('projectpublished='+projectpublished);

	
	reloadtab('project_'+projectid,'','updateproject&projectid='+projectid,function(){
		reloadview('codegen.projects','projectlist');
		flashstatus(document.dict['statusflash_updated']+oprojectname.value,5000);
	},params.join('&'),null,gskey);
	
}


delproject=function(projectid,gskey){
	if (!sconfirm(document.dict['confirm_project_delete'])) return;
	
	reloadtab('project_'+projectid,null,'delproject&projectid='+projectid,function(){
		closetab('project_'+projectid);
		reloadview('codegen.projects','projectlist');
	},null,null,gskey);
}

updateproject_rectitle=function(projectid){
	var otitle=gid('dir_projectname_'+projectid);
	if (!valstr(otitle)) return;
	
	if (gid('projectname_'+projectid)) gid('projectname_'+projectid).value=otitle.value;
	
	ajxpgn('statusc',document.appsettings.codepage+'?cmd=updateproject_rectitle&projectid='+projectid+'&projectname='+encodeHTML(otitle.value),0,0,null,function(rq){
		marktabsaved('project_'+projectid,rq.responseText);
		gid('vrectitle_projectname_'+projectid).style.display='inline';
		gid('mrectitle_projectname_'+projectid).style.display='none';
		var newtitle=rq.getResponseHeader('newtitle');
		if (newtitle==null||newtitle=='') newtitle=otitle.value; else newtitle=decodeHTML(newtitle);
		gid('vrectitle_projectname_'+projectid).innerHTML=newtitle+' <span class="edithover"></span>';
		settabtitle('project_'+projectid,newtitle);
        reloadview('codegen.projects','projectlist');
	});
}
