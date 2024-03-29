<?php
class comment{
	private $db;
	private $Comment_ID;
	private $Parent_Ticket_ID;
	private $Parent_Comment_ID;
	private $Comment_Text;
	private $Date_Created;
	private $Created_By_ID;
	
	function __construct($database){
		$this->db = $database;
	}
	
	function InsertComment($ticketid, $parent_id, $text, $commenter_id){
		$return = $this->db->query("INSERT INTO `Comments` (Parent_Ticket_ID, Parent_Comment_ID, Comment_Text, Date_Created, Created_By_ID) VALUES (?,?,?,?,?)", [$ticketid, $parent_id, $text, date('Y-m-d H:i:s'), $commenter_id], false);
		return $return;
	}
	
	function UpdateComment($comment_id, $text){
		$return = $database->query("Update `Comments` SET Comment_Text = ? WHERE `Comment_ID` = ?", [$text, $comment_id], false);
		return $return;
	}
	
	function DeleteComment($comment_id){
		$return = $this->db->query("DELETE FROM `Comments` WHERE `Comment_ID` = ?", [$comment_id], false);
		return $return;
	}
	
	function SelectAllByTicket($ticket_id){
		$return = $this->db->query("SELECT * FROM `Comments` WHERE Parent_Ticket_ID = ?", [$ticket_id]);
		return $return;
	}

	function ArchiveComment($comment_id){

		$return = $this->db->query("INSERT INTO Archived_Comments 
		(Comment_ID, Parent_Ticket_ID, Parent_Comment_ID, Comment_Text, Date_Created, Created_By_ID )
		 (SELECT Comment_ID, Parent_Ticket_ID, Parent_Comment_ID, Comment_Text, Date_Created, Created_By_ID
		  FROM Comments WHERE Comment_ID = ?)", [$comment_id], false);

		return ($return == 1);
	}
}