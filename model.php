<?php
function connect(){
    $dsn = 'mysql:host=localhost;dbname=cs_350';
    $usernameDB = 'student';
    $password = 'CS350';
    return (new PDO($dsn, $usernameDB, $password));
}

function add_new_user($user, $pass){
    $db = connect();
    $added = false;
    $select = "SELECT * FROM gillogly_final_users WHERE username = :username";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':username', $user);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
    } catch (PDOException $e){
        //exit script if this happens exit(error message);
    }
    if($result == NULL){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        echo $hash;
        $insert = "INSERT INTO gillogly_final_users
                    (username, password_hash)
                    VALUES
                    (:username, :password_hash)";
        try{
            $statement = $db->prepare($insert);
            $statement->bindValue(':username', $user);
            $statement->bindValue(':password_hash', $hash);
            if($statement->execute() == true){
                $added = true;
            }
            $statement->closeCursor();
        } catch (PDOException $e){
        }
    }
    return $added;
}

function verify_user($user, $pass){
    $db = connect();
    $verified = false;
    $select = "SELECT * FROM gillogly_final_users WHERE username = :username";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':username', $user);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
    } catch (PDOException $e){}
    if($result != NULL){
        if(password_verify($pass, $result['password_hash'])){
            $verified = true;
        }
    }
    return $verified;
}

function getID($user){
    $db = connect();
    $select = "SELECT * FROM gillogly_final_users WHERE username = :username";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':username', $user);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
    } catch (PDOException $e){}
    return $result['id'];
}

function newEntry($userID, $entry){
    $db = connect();
    $added = false;
    $insert = "INSERT INTO gillogly_final_journal
                    (userID, entry)
                    VALUES
                    (:userID, :entry)";
    try{
        $statement = $db->prepare($insert);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':entry', $entry);
        if($statement->execute() == true){
            $added = true;
        }
        $statement->closeCursor();
    } catch (PDOException $e){}
    return $added;
}

function userEntries($userID){
    $db = connect();
    $select = "SELECT * FROM gillogly_final_journal WHERE userID = :userID";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
    } catch (PDOException $e){}
    return $result;
}

function currentEntry($userID, $entryID){
    $db = connect();
    $select = "SELECT * FROM gillogly_final_journal WHERE userID = :userID AND id = :entryID";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':entryID', $entryID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
    } catch (PDOException $e){}
    return $result;
}

function updateEntry($entryID, $newEntry){
    $db = connect();
    $update = "UPDATE gillogly_final_journal 
            SET entry = :entry
             WHERE id = :id";
    try{
        $statement = $db->prepare($update);
        $statement->bindValue(':entry', $newEntry);
        $statement->bindValue(':id', $entryID);
        $statement->execute();
        $statement->closeCursor();
    }catch(PDOException $e){}
}

function deleteEntry($entryID){
    $db = connect();
    $delete = "DELETE FROM gillogly_final_journal
           WHERE id = :id";
    try{
        $statement = $db->prepare($delete);
        $statement->bindValue(':id', $entryID);
        $statement->execute();
        $statement->closeCursor();
    }catch(PDOException $e){}
}

function getEntryUser($entryID){
    $db = connect();
    $select = "SELECT * FROM gillogly_final_journal
           WHERE id = :id";
    try{
        $statement = $db->prepare($select);
        $statement->bindValue(':id', $entryID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
    }catch(PDOException $e){}

    return $result;
}
?>