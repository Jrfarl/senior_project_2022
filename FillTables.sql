use SeniorProject;

insert into Group_Reference(Group_Name)
Values
	('Customer'),('IT Support'), ('Customer Support'), ('Management');

insert into Users (First_Name, Last_Name, Username, Password)
Values
	('Jim', 'Farlow', 'jrfarl', 'WillBeEncrypted'), 
    ('Gabe', 'Harman', 'Gabe127', 'WillBeEncrypted'), 
    ('John', 'Doe', 'JonDoeIT', 'WillBeEncrypted'),
    ('Jane', 'Doe', 'JaneDoeMgmt', 'WillBeEncrypted'),
	('Jim', 'Halpert', 'CustSupportHalpert', 'WillBeEncrypted');

insert into Group_Users (User_ID, Group_ID)
Values
	(1,1), 
    (2,1), 
    (3,2), (3,3), 
    (4,2), (4,3), (4,4), 
    (5,3), (5,4);
    
insert into Status (Status_Code, Status_Name)
Values
	(-1, 'Error'),
    (0, 'New'),
    (1, 'Assigned'),
    (2, 'Closed'),
    (3, 'Closed - Not Resolved');

insert into Tickets (Title, Description, Created_By_ID)
Values
	('Cannot Unsubscribe from Emails', 'I have clicked the unsubscribe link on the emails but I still recieve them', 2),
    ('Need Password Reset', 'I need to reset my email password', 5),
    ('Change request - Create Group for Contractors', 'We need a group category for contractors so they can be given distinct permision sets', 4),
    ('Laptop won''t power on', 'The laptop I purchased from your company won''t power on. It started after I spilled water on it.', 1);

Update Tickets
Set Status_Code = 1, Assigned_To_ID = 5
WHERE Ticket_ID = 4;

Insert Into Comments (Parent_Ticket, Comment_Text, Created_By_ID)
Value
	(4, 'This is not covered by waranty, closing this ticket', 5);
    
Update Tickets
Set Status_Code = 3
WHERE Ticket_ID = 4;

Update Tickets
Set Status_Code = 1, Assigned_To_ID = 3
WHERE Ticket_ID = 3;

Update Tickets
Set Status_Code = 1, Assigned_To_ID = 3
WHERE Ticket_ID = 2;

Insert Into Comments (Parent_Ticket, Comment_Text, Created_By_ID)
Values
	(2, 'Password reset has been started, you will receive an email with the reset link', 3);
    
Insert Into Comments (Parent_Ticket, Parent_Comment, Comment_Text, Created_By_ID)
Values
	(2, 2, 'Thank you, reset is done, the ticket can be closed', 5);
    
Update Tickets
Set Status_Code = 2
WHERE Ticket_ID = 2;
    
    
