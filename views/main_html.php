<?php
/* ----------------------------------------------------------------------
 * app/widgets/links/views/main_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2010-2016 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
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
<?php
 	$po_request			= $this->getVar('request');
	 	require_once(__CA_LIB_DIR__."/ca/Search/ObjectSearch.php");
	 	$o_search = new ObjectSearch(); //instantiate a new search object
	 	$qr_hits = $o_search->search("ca_objects.type_id:43");
	 	$count=0;
		while($qr_hits->nextHit()) {
			print "<h3><button onclick='$(\"#content".$count."\").slideToggle();'>+</button> ".$qr_hits->get('ca_objects.preferred_labels.name')." (".$qr_hits->get('ca_objects.idno').")</h3>";  //confirm the id number
			print "<div id=\"content".$count."\" class=\"slideDownContent\">";
			$object_id_fabrique =  $qr_hits->get('ca_objects.object_id');
			$o_data = new Db();
			 $qr_result = $o_data->query("SELECT ca_object_labels.object_id, idno, name FROM ca_objects left join ca_object_labels ON ca_objects.object_id = ca_object_labels.object_id AND is_preferred=1 WHERE parent_id =".$object_id_fabrique." and deleted=0");
			 $i=0;
			 print "<table border=0>";
			 while($qr_result->nextRow()) {
			       ?>
			       <tr>
				<?php print "<td><button onclick='$(\"#content".$count."-".$i."\").slideToggle();'>+</button><a href=/gestion/index.php/editor/objects/ObjectEditor/Edit/object_id/".$qr_result->get('object_id').">".$qr_result->get('name')."</a></td><td>".$qr_result->get('idno')."</td>"; ?>
				<?php
				$o_data2 = new Db();
				 $qr_result2 = $o_data2->query("SELECT ca_object_labels.object_id, idno, name FROM ca_objects left join ca_object_labels ON ca_objects.object_id = ca_object_labels.object_id AND is_preferred=1 WHERE parent_id =".$qr_result->get('object_id')." and deleted=0");
				 $j=0;
				 print "</tr><tr><td colspan=2><table id=\"content".$count."-".$i."\" style=\"padding-left:30px;\" class=\"slideDownContent\" border=0>";
				 while($qr_result2->nextRow()) {
				       ?>
					<?php print "<tr><td><button onclick='$(\"#content".$count."-".$i."-".$j."\").slideToggle();'>+</button><a href=/gestion/index.php/editor/objects/ObjectEditor/Edit/object_id/".$qr_result2->get('object_id').">".$qr_result2->get('name')."</a></td><td>".$qr_result2->get('idno');
						$o_data3 = new Db();
						$qr_result3 = $o_data3->query("SELECT ca_object_labels.object_id, idno, name FROM ca_objects left join ca_object_labels ON ca_objects.object_id = ca_object_labels.object_id AND is_preferred=1 WHERE parent_id =".$qr_result2->get('object_id')." and deleted=0");
						$k=0;
						print "</td></tr>"; 
						print "<tr><td colspan=2>"; 
						print "<table id=\"content".$count."-".$i."-".$j."\" style=\"padding-left:30px;\" class=\"slideDownContent\" border=0>";
						while($qr_result3->nextRow()) {
							print "<tr><td><a href=/gestion/index.php/editor/objects/ObjectEditor/Edit/object_id/".$qr_result3->get('object_id').">".$qr_result3->get('name')."</a></td><td>".$qr_result3->get('idno')."</td></tr>";
							$k++;
						}
						print "</table>";
						print "</td></tr>"; 
						?>
					<?php
				   $j++;   
				 }
				print"</table></td></tr>";					
			   $i++;   
			 }
			print "</table></div>";
			$count++;
		}
 	
?>
</div>
