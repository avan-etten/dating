<?php
/**
 * Created by PhpStorm.
 * User: Vanteet
 * Date: 3/2/2019
 * Time: 7:44 PM
 */

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

/**
 * Class db
 *
 * database class for insertions and select statements for dating website
 */
class db
{
    private $_pdo;
    private $_insertId;

    function __construct(){

    }

    /**
     * Connects to the database and creates a PDO
     */
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

    /**
     * Inserts a member into the members table.
     * takes in a first name, last name, age, phone number, email, state, gender, what the member is seeking,
     * the members interests, and if the member is a premium member.
     */
    function _insertMember(){
        $sql = "INSERT INTO members (first, last, age, phone, email, state, gender, seeking,premium, interests)
         VALUES (:first, :last, :age, :phone, :email, :state, :gender, :seeking,:premium, :interests)";

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
        $premium = $member->getPremium();
        $interests = implode(", ", $member->getBasicInterests());


        $statement->bindParam(':first', $first, PDO::PARAM_STR);
        $statement->bindParam(':last', $last, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        $statement->execute();
        $this->_insertId = $this->_pdo->lastInsertId();
        //echo $this->_insertId;
        $_SESSION = array();


    }

    /**
     * gets all of the members in the members database
     */
    function _getMembers(){
       $sql = "SELECT * FROM members";
       $statement = $this->_pdo->prepare($sql);
       $statement->execute();

       $result = $statement->fetchAll(PDO::FETCH_ASSOC);
       $table = "";
       echo "<table>";

       echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Phone</th>
        <th>Email</th><th>State</th><th>Gender</th><th>Seeking</th>
        <th>Premium</th><th>Interests</th>
        </tr>";

       foreach ($result as $row){
            echo "<tr>";
            echo "<td> <a href=".$row['ID'].">".$row['ID']."</a></td>";
            echo "<td>".$row['first']." " .$row['last']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['state']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['seeking']."</td>";
            echo "<td>".$row['premium']."</td>";
            echo "<td>".$row['interests']."</td>";
            echo "</tr>";
        }
        echo "</table>";



    }

    /**
     * Gets a single member from the members table
     * @param $id of the member to find
     * @return array the query result
     */
    function _getMember($id){
        $sql = "SELECT * FROM members WHERE id = :id";
        $statement = $this->_pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Gets the ID of the last insert for use in the _getMember method
     * @return int insertId
     */
    function _getInsertId(){
        return $this->_insertId;
    }


}