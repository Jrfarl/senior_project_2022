<?php
class comment{
	private $Comment_ID;
	private $Parent_Ticket_ID;
	private $Parent_Comment_ID;
	private $Comment_Text;
	private $Date_Created;
	private $Created_By_ID;
	
	function InsertComment($ticketid, $parent_id, $text, $commenter_id){
		global $database;
		$return = $database->query("INSERT INTO `Comments` (Parent_Ticket_ID, Parent_Comment_ID, Comment_Text, Date_Created, Created_By_ID) VALUES (?,?,?,?,?)", [$ticketid, $parent_id, $text, date('Y-m-d H:i:s'), $commenter_id], false);
		return $return;
	}
	
	function UpdateComment($comment_id, $text){
		global $database;
		$return = $database->query("Update `Comments` SET Comment_Text = ? WHERE `Comment_ID` = ?", [$text, $comment_id], false);
		return $return;
	}
	
	function DeleteComment($comment_id){
		global $database;
		$return = $database->query("DELETE FROM `Comments` WHERE `Comment_ID` = ?", [$text, $comment_id], false);
		return $return;
	}
	
	function SelectAllByTicket($ticket_id){
		global $database;
		$return = $database->query("SELECT * FROM `Comments` WHERE Parent_Ticket_ID = ?", [$ticket_id]);
		return $return;
	}
}