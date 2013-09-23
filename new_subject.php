<?php require_once ("includes/connections.php"); ?>
<?php require_once ("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include ("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
                                            <?php echo navigation($sel_subject, $sel_page); ?>
					</td>
					<td id="page">
						
					</td>
				</tr>
			</table>
<?php include ("includes/footer.php"); ?>