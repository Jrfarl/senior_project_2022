Use SeniorProject;

INSERT INTO Group_Reference
(Group_ID, Group_Name)
values
(0, "Administrator"),
(1, "Customers");

INSERT INTO Users
(User_ID, First_Name, Last_Name, Username, Password)
value
(0, "Administrator", "Administrator", "Administrator", "$2y$10$QWM7KtUEHtNY1Rv5PfciMOViN5/qe2813UreaD6TZSIzK8yqlcsc2");

INSERT INTO Group_Users
(Group_ID, User_ID)
value
(0,0);

INSERT INTO Group_Permissions
(Group_ID, Permission)
values
(0, "ADMIN_BYPASS"),
(1, "CREATE_TICKET");

INSERT INTO Status
(Status_Code, Status_Name)
VALUES
(-1, "Error"),
(0, "New"),
(1, "Assigned"),
(2, "Closed"),
(3, "Closed - Not Resolved");

INSERT INTO Priority
(Priority_Level, Priority_Name)
VALUES
(1, "Normal");

INSERT INTO Config
(`Key`, Value)
VALUES
("SITE_NAME", "Senior Project"),
("TICKET_USER_ALLOWED_TO_SET_PRIORITY", "0"),
("CORE_DEBUG_ACTIVE", "1"),
("CORE_REGISTRATION_ALLOWED", "1");
