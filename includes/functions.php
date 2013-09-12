<?php

/*
 * This file contains all functions for this project
 */

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed: " . mysql_error());
    }
}

function get_all_subjects() {
    global $connection;
    $query = "SELECT * 
              FROM subjects 
              ORDER BY position ASC";
    $subject_set = mysql_query($query, $connection);
    confirm_query($subject_set);
    return $subject_set;
}

function get_pages_for_subject($subject_id) {
  global $connection;
    $query = "SELECT * 
            FROM pages 
            WHERE subject_id = {$subject_id} ORDER BY position ASC"; 
  $page_set = mysql_query($query, $connection);
  confirm_query($page_set);
  return $page_set;
}

function get_subject_by_id($subject_id) {
    global $connection;
    $query = "SELECT * FROM subjects WHERE id = ".$subject_id." LIMIT 1";
    $result_set = mysql_query($query, $connection);
    confirm_query($result_set);
    $subject = mysql_fetch_array($result_set);
    if($subject){
        return $subject;
    }  else {
        return NULL;
    }
}

function get_page_by_id($page_id){
    global $connection;
    $query = "SELECT * FROM pages WHERE id = ".$page_id." LIMIT 1";
    $result_set = mysql_query($query, $connection);
    confirm_query($result_set);
    $page = mysql_fetch_array($result_set);
    if($page){
        return $page;
    }  else {
        return NULL;
    }
}

?>