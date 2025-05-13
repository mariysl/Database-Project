<?php

// Commands to delete a user

    //first have to find user ID
    $useid = "SELECT id FROM users WHERE username = 'jelani' -- can change the name or could set to variable ':name'";

    //OR YOU can read through all users
    $allusers = "SELECT * FROM users";

    $deleteuser = "DELETE FROM users WHERE id = ':user' "; // then pass in useid as variable to delete user f

    // $stmt = $conn->prepare($useid);
    // $stmt->bind_param(":name", $allusers); //<-- replace with true variable to use in this execute if you are using T_VARIABLE
    // $stmt->execute();
    // $user = $stmt->fetch();
    // $realuser = $user["id"];

    // $stmt = $conn->prepare($deleteuser);
    // $stmt->bind_param(":user", $realuser);
    // $stmt->execute();
    

// Commands to delete table

    //grabbing room id first
    $roomid = "SELECT id FROM rooms WHERE roomname = 'Calc'";

    //Delteting room along with all other data ossciated with it like the messages and room_memberships
    $roomdelete = "DELETE FROM rooms WHERE id = '2'";

    //Must delete topic manually since topic ID and room id or a correlation then you just use the same id
    $topicdelete = "DELETE FROM topic WHERE id = '2'"; // make sure if using variables use the same as the id's are the same.
    //^ separte command to delete topic count it 

//Deleting a room member via request made by owner
    $memberid = "SELECT id FROM room_membership WHERE user_id = '3'"; //userid will be found by finding the userid in the users table then searching from there

    $memberdelete = "DELETE FROM room_membership WHERE id ='3'"; // can use variable to retrieve user id from preivous command to make work easier and linear


//Deleting message from messages table

    //first find all messages sent by user
    $messagesfromusers = "SELECT messages.content,
                            messages.created_at,
                            users.username
                        FROM messages
                        JOIN users ON messages.user_id = users.id
                        WHERE messages.room_id = :messageroomid
                        ORDER BY messages.created_at ASC";

    //Then find the Id and delete the message
    $deletemessage = "DELETE FROM messages WHERE id = '476'";
