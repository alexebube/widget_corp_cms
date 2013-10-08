<?php require_once ("includes/connections.php"); ?>
<?php require_once ("includes/functions.php"); ?>

<?php 
    if (intval($_GET['subj']) == 0): redirect_to("content.php"); endif;
    if(isset($_POST['submit'])):
    //form validation
    $errors = array();
    $required_fields = array('menu_name','position','visible');
    foreach ($required_fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
            $errors[] = $fieldname;
        }
    }
    
    $fields_with_lengths = array('menu_name' => 30);
	foreach($fields_with_lengths as $fieldname => $maxlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
	}
    
    if (empty($errors)){
        $id = mysql_prep($_GET['subj']);
        $menu_name = mysql_prep($_POST['menu_name']);
        $position =  mysql_prep($_POST['position']);
        $visible =  mysql_prep($_POST['visible']);
        
        $query = "UPDATE subjects SET
                    menu_name = '{$menu_name}',
                    position = '{$position}',
                    visible = '{$visible}'
                 WHERE id = {$id}";
        $result = mysql_query($query, $connection);
        confirm_query($result);
        if (mysql_affected_rows() == 1) :
            $message = "<span style=\"color:green\">The Subject update was successful";
            $message .= "<br />".  mysql_error();
        else:
            $message = "<span style=\"color:red\">The Subject update failed";
        endif;
    } else {
        
    }
    
    
endif; ?>
<?php find_selected_page(); ?>
<?php include ("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
                                            <?php echo navigation($sel_subject, $sel_page); ?>
					</td>
					<td id="page">
                                            <h2>Edit Subject: <?php echo $sel_subject['menu_name']; ?></h2>
                                            <?php if(!empty($message)): echo "<p>".$message."</p>"; endif; ?>
                                            <form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" method="post">
                                                <p>Subject name:
                                                    <input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name'] ?>" id="menu_name" />
                                                </p>
                                                <p>Position:
                                                    <select name="position">
                                                        <?php 
                                                            $subject_set = get_all_subjects();
                                                            $subject_count = mysql_num_rows($subject_set);
                                                            for($count=1; $count<=$subject_count+1; $count++){
                                                                echo "<option value=\"{$count}\"";
                                                                    if($sel_subject['position']== $count)
                                                                        echo " selected";
                                                                echo ">{$count}</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </p>
                                                <p>Visible:
                                                    <input type="radio" name="visible" value="0" 
                                                           <?php if($sel_subject['visible'] == 0): echo " checked"; endif; ?>/>No
                                                    &nbsp;
                                                    <input type="radio" name="visible" value="1" 
                                                           <?php if($sel_subject['visible'] == 1): echo " checked"; endif; ?>/>Yes
                                                </p>
                                                <input type="submit" name="submit" value="Edit Subject" />
                                                &nbsp;
                                                <a href="delete_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" onclick="return confirm('Are you Sure?');">Delete Subject</a>
                                            </form>
                                            
                                            <br/>
                                            <a href="content.php">Cancel</a>
					</td>
				</tr>
			</table>
<?php include ("includes/footer.php"); ?>