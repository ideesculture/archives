<?php
/*
 * ----------------------------------------------------------------------
 * CollectiveAccess Archives widget & plugin
 * Created by idéesculture 2018 (www.ideesculture.com)
 * ----------------------------------------------------------------------
 * CollectiveAccess is a TM by Whirl-i-Gig
 * CollectiveAccess and this Archives widget & plugin are under GNU GPL v2 license
 *
 */
$root_type_id = $this->getVar("root_type");
 ?>
 <style>
	.slideDownContent {
		display:none;
	}
	.slideDownContent TR {
		width:100%;
	}
</style>
<div class="dashboardWidgetContentContainer">
	<div style="display:block;text-align: right;
    margin-top: -10px;
    margin-right: 8px;">
		<a class="btn" href="/gestion/index.php/archives/archives/Index"><i class="fa fa-expand pullright" aria-hidden="true"></i> Agrandir</a>
    </div>

	<div id="injectArchiveTree">
		...
	</div>
</div>
<style>
	.archiveHierarchyOffset0 {width:75%;padding-left:0;}
	.archiveHierarchyOffset1 {width:72%;padding-left:3%;}
	.archiveHierarchyOffset2 {width:69%;padding-left:6%;}
	.archiveHierarchyOffset3 {width:66%;padding-left:9%;}
	.archiveHierarchyOffset4 {width:63%;padding-left:12%;}
    .dashboardWidgetContentContainer {
    }
    .hierarchyFor {
        margin-bottom:5px;
    }
    div[class^=archiveHierarchyOffset] {
        margin-bottom:5px;
        display:inline-block;
    }
    a[id^="expandButton"], a[id^="shrinkButton"], a[id^="exportButton"], a[id^="printButton"] {
        color:black;
        cursor:pointer;
        text-decoration: none;
    }
</style>
<script>
	jQuery("document").ready(function() {
		jQuery.get("/gestion/index.php/archives/archives/Fetch", function(data){
			jQuery('#injectArchiveTree').html(data);
		}, "html");

	});
	var expandHierarchy = function(object_id,level) {
		jQuery("#expandButton"+object_id).parent().prepend("<a onClick='shrinkHierarchy("+object_id+","+level+");' id='shrinkButton"+object_id+"'><i class='fa fa-minus-square-o'></i></a>");
		jQuery("#expandButton"+object_id).remove();
		//jQuery("#expandButton"+object_id+" i.fa").addClass("fa-square-o");
		//jQuery("#expandButton"+object_id+" i.fa").removeClass("fa-plus-square-o");
		jQuery.get("<?php print __CA_URL_ROOT__; ?>/index.php/archives/archives/Fetch/id/"+object_id+"/level/"+level, function(data){
			jQuery("#hierarchyFor"+object_id).html(data);
		}, "html");

	}
	var shrinkHierarchy = function(object_id,level) {
		jQuery("#shrinkButton"+object_id).parent().prepend("<a onClick='expandHierarchy("+object_id+","+level+");' id='expandButton"+object_id+"'><i class='fa fa-plus-square-o'></i></a>");
		jQuery("#shrinkButton"+object_id).remove();
		jQuery("#hierarchyFor"+object_id).html("");
	}
</script>
