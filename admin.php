<?php
$allusename = "SELECT * FROM users"; // list all users for admin purposes and the info

$alltopic = "SELECT * FROM topics"; // list all topics for admin purposes

$regallrooms = "SELECT * FROM rooms"; // Regular all rooms with user id instead of username

$checkuser = "SELECT username, passwrd FROM users WHERE EXISTS (SELECT username, passwrd FROM users WHERE username = ':username' AND passwrd = ':passwrd')"; // checking for user in that will go with sign in logic

//FIND ALL ROOMS
$allrooms = "SELECT rooms.id rooms.roomname, 
                    rooms.is_private, 
                    rooms.created_at, 
                    
                    users.id AS user_id,
                    users.username AS user_name,


                    topics.id AS topic_id,
                    topics.topicname as topic_name,
                    topics.description


            FROM rooms
            LEFT JOIN users ON rooms.created_by = users.id
            LEFT JOIN topics ON rooms.topic_id = topics.id;"; // List all rooms for admin AND GUI purposes when listing on main search page comes with Creators username instead of ID

//FIND ALL PUBLIC ROOMS
$allpubRooms = "SELECT rooms.id rooms.roomname, 
                    rooms.is_private, 
                    rooms.created_at, 
                    
                    users.id AS user_id,
                    users.username AS user_name,


                    topics.id AS topic_id,
                    topics.topicname as topic_name,


            FROM rooms
            LEFT JOIN users ON rooms.created_by = users.id
            LEFT JOIN topics ON rooms.topic_id = topics.id
            where is_private='FALSE' "; // List all public rooms that a user can join for admin and user in GUI

//FIND ALL PRIVATE ROOMS
$allprivRooms = "SELECT rooms.id rooms.roomname, 
                    rooms.is_private,
                    rooms.created_at, 
                    
                    users.id AS user_id,
                    users.username AS user_name,


                    topics.id AS topic_id,
                    topics.topicname as topic_name,


            FROM rooms
            LEFT JOIN users ON rooms.created_by = users.id
            LEFT JOIN topics ON rooms.topic_id = topics.id where is_private='TRUE"; // List all private rooms for a user. 


//FIND ALL PRIVATE ROOMS WITH ACCESS CODE FOR ADMINS ONLY
$allprivRoomsinfo = "SELECT rooms.id rooms.roomname, 
                    rooms.is_private,
                    rooms.created_at, 
                    
                    users.id AS user_id,
                    users.username AS user_name,


                    topics.id AS topic_id,
                    topics.name as topic_name,


            FROM rooms
            LEFT JOIN users ON rooms.created_by = users.id
            LEFT JOIN topics ON rooms.topic_id = topics.id
            where is_private='TRUE' AND  access_code IS NOT NULL"; // List all private room with their access code for ADMIN purposes

//see all messages in specfic room
$messageroomid = 2;
$allmessages = "SELECT messages.content, 
                       messages.created_at, 
                       users.username

                FROM messages 
                JOIN users ON m.user_id = u.id
                WHERE m.room_id = :messageroomid
                ORDER BY m.created_at ASC";
//USE THIS WHEN EXECUTING COMMAND
//$stmt = $conn->prepare($allmessages);

//     $stmt->bindParam(':messageroomid', $messageroomid);
//     $stmt->execute();


//All Messages from room with usernames
$messagesfromusers = "SELECT messages.content,
                            messages.created_at,
                            users.username
                    FROM messages
                    JOIN users ON messages.user_id = users.id
                    WHERE messages.room_id = :messageroomid
                    ORDER BY messages.created_at ASC";
//USE THIS WHEN EXECUTING COMMAND
//$stmt = $conn->prepare($messagesfromusers);

//     $stmt->bindParam(':messageroomid', $messageroomid);
//     $stmt->execute();


// see if certain user is in certain room
$roomid = 4;
$userid = 17;
$userinroom = "SELECT * FROM room_memberships 
                WHERE room_id = :roomid AND user_id = :userid";
// USE THIS WHEN EXECUTING COMMAND 
// $stmt = $conn->prepare($userinroom);

//     $stmt->bindParam(':roomid', $roomid);  bv 
//     $stmt->bindParam(':userid', $userid);
//     $stmt->execute();


//See all members of a room
$roommembers = "SELECT users.username, 
                       room.userrole, 
                       room.joined_at 
                       
                FROM room_memberships room
                JOIN users ON room.user_id = users.id
                WHERE room.room_id = :roomid";
// USE THIS WHEN EXECUTING COMMAND
// $stmt = $conn->prepare($roommembers);

//     $stmt->bind_param(':roomid', $roomid);
//     $stmt->execute();


//Getting a room by its topic for admin but mostly FOR USERS
$roombytopic = "SELECT rooms.id,
                       rooms.roomname,
                       topics.topicname AS topic_name,
                       rooms.is_private,
                       rooms.created_at
                FROM rooms
                JOIN topics ON rooms.topic_id = topics.id
                WHERE topics.topicname = 'Difeq'"; // <-- Can change the name or set it as a variable for execution

//Maintence for topics adding all description of topics by ADMIN you may be asking why is this done by ADMIN because we didn't add it into the frontend functionalities
$decription = "UPDATE topics SET topicdescription = 'THIS IS ABOUT DIFFERENTAL EQUATIONS THESE PEOPLE ARE SUFFERING' WHERE topicname = 'Difeq'";


// Thread to see all info from a room. EXECUTE IN ORDER using this to avoid denormalization of data
$fullroom = "SELECT rooms.id,
                    rooms.roomname,
                    rooms.is_private,
                    rooms.access_code,
                    rooms.created_at,
                    users.username AS creator,
                    topics.name AS topic_name,
                    topics.description AS topic_description
                FROM rooms
                LEFT JOIN users ON rooms.created_by = users.id
                LEFT JOIN topics ON rooms.topic_id = topics.id
                WHERE rooms.id = 1"; //<-- Replace 1 with your room ID

$fullmembers = "SELECT users.username,
                        room_memberships.role,
                        room_memberships.joined_at
                FROM room_memberships
                JOIN users ON room_memberships.user_id = users.id
                WHERE room_memberships.room_id = 1"; //<-- Replace 1 with your room ID

$fullmessages = "SELECT users.username,
                        messages.content,
                        messages.created_at
                FROM messages
                JOIN users ON messages.user_id = users.id
                WHERE messages.room_id = 1
                ORDER BY messages.created_at ASC";