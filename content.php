<?php require_once ("includes/connections.php"); ?>
<?php require_once ("includes/functions.php"); ?>
<?php 
    if (isset($_GET['subj'])){
        $sel_subj = $_GET['subj'];
        $sel_page = "";
    }elseif (isset ($_GET['page'])) {
        $sel_subj = "";
        $sel_page = $_GET['page'];
    }  else {
         $sel_subj = "";
         $sel_page = "";
    }
?>
<?php include ("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
                                            <ul class="subjects">
						<?php                                                   
                                                    // Use returned data
                                                    $subject_set = get_all_subjects();
                                                    while ($subject = mysql_fetch_array($subject_set)) {
                                                        echo "<li><a href=\"content.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>";
                                                                                                                
                                                        echo "<ul class=\"pages\">";
                                                        $page_set = get_pages_for_subject($subject["id"]);
                                                        while ($page = mysql_fetch_array($page_set)) {
                                                            echo "<li><a href=\"content.php?page=".  urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
                                                        }
                                                        echo "</ul>";
                                                    }
                                              ?>
                                            </ul>     
					</td>
					<td id="page">
						<h2>Content Area</h2>
                                                <?php echo "{$sel_subj}"; ?>
                                                 <?php echo "{$sel_page}"; ?>
					</td>
				</tr>
			</table>
<?php include ("includes/footer.php"); ?>