<?php

// Creating room with its topic all at the same time will be ordered in execution order have to add PDO and other execution stuff this is just a rough draft to use.
$topicName = 'Physics';
$roomName = 'Physics Study Night';
$isPrivate = false;
$accessCode = null;
$user = 'jelani';

$createtopic = "INSERT INTO topics (topicname) VALUE (':tpname') ON DUPLICATE KEY UPDATE topicname = topicname";

$topicid = "SELECT id FROM where topicname = ':tpname'";

$createroom = "INSERT INTO rooms (roomname, is_private, access_code, created_by, topic_id) VALUES (':rmname', ':priv', ':access', ':user', ':tpid')";

$addroom_host = "INSERT INTO room_memberships (room_id, user_id, userrole) VALUES (:rmid, :userid, 'host')"; // userrole in this case would = 'host' 

// $stmt = $conn->prepare($createtopic);

//     $stmt->bindParam(':tpname', $topicName);
//     $stmt->execute();


// $stmt = $conn->prepare($topicid);

//     $stmt->bindParam('tpname', $topicName);
//     $stmt->execute();
//     $topic = $stmt->fetch();
//     $topicId = $topic['id'];

// $stmt = $conn->prepare($createroom);

//     $stmt->bindParam('rmname', $roomName);
//     $stmt->bindParam(':priv', $isPrivate);
//     $stmt->bindParam(':access', $accessCode);
//     $stmt->bindParam(':user', $user);
//     $stmt->bindParam(':tpid', $topicId);


// Creating PRIVATE room with its topic all at the same time will be ordered in execution order have to add PDO and other execution stuff this is just a rough draft to use.
$topicName = 'Physics';
$roomName = 'Physics Study Night';
$Private = true; //just change the variable but probably wouldn't need to as they'd be in differend files
$accessCode = 856958; // isn't null as a code is needed if if is private
$user = 'jelani';

$createtopic = "INSERT INTO topics (topicname) VALUE (':tpname') ON DUPLICATE KEY UPDATE topicname = topicname";

$topicid = "SELECT id FROM where topicname = ':tpname'";

$createroom = "INSERT INTO rooms (roomname, is_private, access_code, created_by, topic_id) VALUES (':rmname', ':priv', ':access', ':user', ':tpid')";

$addroom_host = "INSERT INTO room_memberships (room_id, user_id, userrole) VALUES (:rmid, :userid, 'host')"; // userrole in this case would = 'host' 

// $stmt = $conn->prepare($createtopic);

//     $stmt->bindParam(':tpname', $topicName);
//     $stmt->execute();


// $stmt = $conn->prepare($topicid);

//     $stmt->bindParam('tpname', $topicName);
//     $stmt->execute();
//     $topic = $stmt->fetch();
//     $topicId = $topic['id'];

// $stmt = $conn->prepare($createroom);

//     $stmt->bindParam('rmname', $roomName);
//     $stmt->bindParam(':priv', $Private);
//     $stmt->bindParam(':access', $accessCode);
//     $stmt->bindParam(':user', $user);
//     $stmt->bindParam(':tpid', $topicId);





// INSERT Messages to be displayed
$content = 'HELLO EVERYONE';
$getuserid = "SELECT id FROM users WHERE username = ':user'";

$getroomid = "SELECT id FROM rooms WHERE roomname = ':roomname'";

$usersend = "INSERT INTO messages (room_id, user_id, content) VALUES (:rmid, :userid, :content)";

// $stmt = $conn->prepare($getuserid);
//     $stmt->bind_param(":user", $user);
//     $stmt->execute();
//     $USER = $stmt->fetch();
//     $userid = $USER['id'];

// $stmt = $conn->prepare($getroomid);
//     $stmt->bind_param(':roomname', $roomName);
//     $stmt->execute();
//     $room = $stmt->fetch();
//     $roomid = $room['id'];

// $stmt = $conn->prepare($usersend);
//     $stmt->bind_param(':rmid', $roomid);
//     $stmt->bindParam(':userid', $userid);
//     $stmt->bindParam(':content', $content);
//     $stmt->execute();

//ADDING REGULAR member to room don't really need to have the add userrole but for reducancy purpose I am doing it. 
$addroom_member = "INSERT INTO room_memberships (room_id, user_id, userrole) VALUES (:rmid, :userid, 'member')";


//IF TOPIC ISN"T ASSIGNED
$createtopic = "INSERT INTO topics (name, description) VALUES ('Math', 'Mathematics and problem solving'";

//EMAIL authication for signup
$email = 'janedoe@gmail.com';
$usernamecheck = "SELECT email FROM users WHERE EXISTS (SELECT email FROM users WHERE email = ':useremail')";
