<?php require_once ("includes/connections.php"); ?>
<?php require_once ("includes/functions.php"); ?>
<?php include ("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
                                            <ul class="subjects">
						<?php                                                   
                                                    // Use returned data
                                                    $subject_set = get_all_subjects();
                                                    while ($subject = mysql_fetch_array($subject_set)) {
                                                        echo "<li>{$subject["menu_name"]}</li>";
                                                                                                                
                                                        echo "<ul class=\"pages\">";
                                                        $page_set = get_pages_for_subject($subject["id"]);
                                                        while ($page = mysql_fetch_array($page_set)) {
                                                            echo "<li>{$page["menu_name"]}</li>";
                                                        }
                                                        echo "</ul>";
                                                    }
                                              ?>
                                            </ul>     
					</td>
					<td id="page">
						<h2>Content Area</h2>
					</td>
				</tr>
			</table>
<?php include ("includes/footer.php"); ?>