<?php

/*
 * This file contains all functions for this project
 */

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed: " . mysql_error());
    }
}
?>
