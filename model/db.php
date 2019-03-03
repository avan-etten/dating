<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 3/2/2019
 * Time: 7:44 PM
 */
session_start();
/*
 * CREATE TABLE members (
    ID int AUTO_INCREMENT NOT NULL,
    PRIMARY KEY (ID),
    first VARCHAR(30),
    last VARCHAR(30),
    age int,
    phone VARCHAR(10),
    email VARCHAR(40),
    state VARCHAR(20),
    gender tinyint,
    seeking VARCHAR(30),
    premium tinyint NOT NULL DEFAULT 0,
    interests VARCHAR(50)
    )
 */

/*
 * INSERT INTO members
 * (first, last, age, phone, email, state, gender, seeking, interests)
 * VALUES ("Droogle", "Groogle", 23, "253-555-6543", "dGroogle@mail.com", "Washington", 1,
 *          "Male, Loneliness", "Collecting Pebbles, Dark Magicks")
 */
class db
{
    private $_pdo;
    private $_insertId;

    function __construct(){

    }

    function _connect(){
        require_once '/home/avanette/config.php';
        try {
            //Instantiate a database object
            $this->_pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            //echo "Connected!";

        }
        catch(PDOException$e) {
            echo$e->getMessage();
        }
    }

    function _insertMember(){
        $sql = "INSERT INTO members (first, last, age, phone, email, state, gender, seeking, interests)
         VALUES (:first, :last, :age, :phone, :email, :state, :gender, :seeking, :interests)";

        $statement = $this->_pdo->prepare($sql);
        $member = $_SESSION['member'];
        $first = $member->getFname();
        $last = $member->getLname();
        $age = $member->getAge();
        $gender = $member->getGender();
        if ($gender == 'male'){
            $gender = 1;
        } else {
            $gender = 0;
        }
        $email = $member->getEmail();
        $phone = $member->getPhone();
        $state = $member->getState();
        $seeking = implode(", ", $member->getSeeking());
        $interests = implode(", ", $member->getBasicInterests());


        $statement->bindParam(':first', $first, PDO::PARAM_STR);
        $statement->bindParam(':last', $last, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        $statement->execute();
        $this->_insertId = $this->_pdo->lastInsertId();
        echo $this->_insertId;
        $_SESSION = array();


    }

    function _getMembers(){
       $sql = "SELECT * FROM members";
       $statement = $this->_pdo->prepare($sql);
       $statement->execute();

       return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    function _getMember($id){

    }


}