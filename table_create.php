<?php

require 'db.php';

$tables = [ 
        // Create the 'users' table to store information about each registered user
        'CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            passwrd VARCHAR(255) NOT NULL,                                         -- non-hashed password for authentication could implement with simple builtin fuction but not enough time
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP                          -- Timestamp of when the user was created
        )',
        // Create the 'rooms' table to store study session information
        'CREATE TABLE IF NOT EXISTS rooms (
            id INT AUTO_INCREMENT PRIMARY KEY,
            roomname VARCHAR(100) NOT NULL,
            is_private BOOLEAN DEFAULT FALSE,                                        -- Flag if room is private 
            access_code VARCHAR(100),                                                -- Room code for private rooms 
            created_by INT,
            topic_id INT,                                                            -- ID of the topic associated with the room
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,         -- If creator is deleted then set to NULL
            FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE SET NULL          -- If topic is deleted, set to NULL
        )',
        // Create the 'messages' table to store chat messages within rooms
        'CREATE TABLE IF NOT EXISTS messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                room_id INT NOT NULL,
                user_id INT NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                        -- When the message was sent
                FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,          -- Delete messages if room is deleted
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE           -- Delete messages if user is deleted
        )',
        // Create the 'room_memberships' table to manage which users are in which rooms and their roles
        'CREATE TABLE IF NOT EXISTS room_memberships (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    room_id INT NOT NULL,
                    user_id INT NOT NULL,
                    userrole ENUM("host", "member") DEFAULT "member",                      -- Role of user
                    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                     -- When user Joined
                    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,      -- Remove membership if room is deleted
                    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,      -- Remove membership if user is deleted
                    UNIQUE KEY unique_membership (room_id, user_id)                    -- Prevent duplicate memberships
        )',
        // Create the 'topics' table to store different topics that rooms can be associated with
        'CREATE TABLE IF NOT EXISTS topics (
                id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each topic
                topicname VARCHAR(100) NOT NULL UNIQUE,   -- Unique topic name
                topicdescription TEXT                     -- Optional description of the topic
        )'
];




try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach( $tables as $table) {
                $conn->exec($table);
        }
    } catch(PDOException $e) {
        echo "Error Connection failed: " . $e->getMessage();
}



//     $use = 'CREATE TABLE IF NOT EXISTS users (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         username VARCHAR(50) NOT NULL UNIQUE,
//         email VARCHAR(100) NOT NULL UNIQUE,
//         password VARCHAR(255) NOT NULL,                                         -- Hashed password for authentication
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP                          -- Timestamp of when the user was created
//     )';


// $room = 'CREATE TABLE IF NOT EXISTS rooms (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         name VARCHAR(100) NOT NULL,
//         is_private BOOLEAN DEFAULT FALSE,                                        -- Flag if room is private 
//         access_code VARCHAR(100),                                                -- Room code for private rooms 
//         created_by INT,
//         topic_id INT,                                                            -- ID of the topic associated with the room
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL         -- If creator is deleted then set to NULL
//         FOREIGN KEY (topic_id) REFERENCES topics(id) ON DELETE SET NULL          -- If topic is deleted, set to NULL
//     )';


// $message = 'CREATE TABLE IF NOT EXISTS messages (
//             id INT AUTO_INCREMENT PRIMARY KEY,
//             room_id INT NOT NULL,
//             user_id INT NOT NULL,
//             content TEXT NOT NULL,
//             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                        -- When the message was sent
//             FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,          -- Delete messages if room is deleted
//             FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE           -- Delete messages if user is deleted
//         )';


// $room_member = 'CREATE TABLE IF NOT EXISTS room_memberships (
//                 id INT AUTO_INCREMENT PRIMARY KEY,
//                 room_id INT NOT NULL,
//                 user_id INT NOT NULL,
//                 role ENUM("host", "member") DEFAULT "member",                      -- Role of user
//                 joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                     -- When user Joined
//                 FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,      -- Remove membership if room is deleted
//                 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,      -- Remove membership if user is deleted
//                 UNIQUE KEY unique_membership (room_id, user_id)                    -- Prevent duplicate memberships
//         )';



// $topic = 'CREATE TABLE IF NOT EXISTS topics (
//             id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each topic
//             name VARCHAR(100) NOT NULL UNIQUE,   -- Unique topic name
//             description TEXT                     -- Optional description of the topic
//     )';