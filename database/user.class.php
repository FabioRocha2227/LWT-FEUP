<?php
  declare(strict_types = 1);

  class User {
    public ?int $userID;
    public ?string $username;
    public ?string $email;
    public ?string $name;
    public ?string $surname;
    public ?int $age;
    public ?string $gender;
    public ?int $isAgent;
    public ?int $isAdmin;
    static function convertAge($date_of_birth) {
      $now = new DateTime();
      $birthDate = new DateTime($date_of_birth);
      $ageInterval = $now->diff($birthDate);
      return $ageInterval->y;
    }
    public function __construct(int $userID, string $username, string $email, ?string $name, ?string $surname, ?int $age, ?int $isAgent, ?int $isAdmin, ?string $gender)
    {
      $this->userID = $userID;
      $this->username = $username;
      $this->email = $email;
      $this->name = $name;
      $this->surname = $surname;
      $this->age = $age;
      $this->isAgent = $isAgent;
      $this->isAdmin = $isAdmin;
      $this->gender = $gender;
      
    }

    static function save($db) : void{
            
      $stmt = $db->prepare('
        UPDATE User SET username = :username, name = :name, surname = :surname, email = :email, age = :age, gender = :gender
        WHERE userID = :userID
      ');
      $stmt->bindParam(':username', $_POST['username']);
      $stmt->bindParam(':name', $_POST['name']);
      $stmt->bindParam(':surname', $_POST['surname']);
      $stmt->bindParam(':email', $_POST['email']);
      $stmt->bindParam(':age', self::convertAge($_POST['date_of_birth']));
      $stmt->bindParam(':gender', $_POST['gender']);
      $stmt->bindParam(':userID', $_SESSION['userID']);

      $stmt->execute();
      
    }
    
    static function getUserWithPassword(PDO $db,$pass) : ?User {
      $stmt = $db->prepare('
        SELECT userID, username, password, email, name, surname, age, isAgent, isAdmin, gender
        FROM User 
        WHERE username = :username
      ');
      
      $stmt->bindParam(':username', $_POST['username']);

      $stmt->execute();
    
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($pass, $row['password'])) {
          return new User(
          $row['userID'],
          $row['username'],
          $row['email'],
          $row['name'],
          $row['surname'],
          $row['age'],
          $row['isAgent'],
          $row['isAdmin'],
          $row['gender']
        );
    } else  return null;
     
}
    public static function getUsername(int $userID, PDO $db) : string {
      $stmt = $db->prepare('
        SELECT username
        FROM user 
        WHERE userID = :userID
      ');

      $stmt->bindParam(':userID', $userID);

      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_COLUMN);
      
      return $result !== false ? (string) $result : '';
    }

    public static function getAllUsernames(PDO $db) : array{
      $stmt = $db->prepare('
        SELECT username
        FROM user
      ');

      $stmt->execute();

      $usernames = [];
      while ($row = $stmt->fetch(SQLITE3_ASSOC)) {
        $usernames[] = $row['username'];
      }

      return $usernames;
    }

    static function getUser(PDO $db) : User {
      $stmt = $db->prepare('
        SELECT userID, username, email, name, surname, age, isAgent, isAdmin, gender
        FROM user 
        WHERE userID = :userID
      ');

      $stmt->bindParam(':userID', $_SESSION['userID']);
      

      $stmt->execute();
      $user = $stmt->fetch();

      return new User(
        $user['userID'],
        $user['username'],
        $user['email'],
        $user['name'],
        $user['surname'],
        $user['age'],
        $user['isAgent'],
        $user['isAdmin'],
        $user['gender']
      );
    }

    static function displayAgent(PDO $db) {
      $stmt = $db->prepare('SELECT * FROM User WHERE isAgent = 1');
      $stmt->execute();

      $agent = array();

      while ($user = $stmt->fetch()) {
          $agent[] = new User(
            $user['userID'],
            $user['username'],
            $user['email'],
            $user['name'],
            $user['surname'],
            $user['age'],
            $user['isAgent'],
            $user['isAdmin'],
            $user['gender']
          );
      }

      return $agent;
  }
static function getAgentID2(PDO $db,$username) {
  $stmt = $db->prepare('
    SELECT userID
    FROM user 
    WHERE username = :username
  ');

  $stmt->bindParam(':username', $username);
  
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_COLUMN);

  return  $result;
}
public static function getAgentUsername(PDO $db) : string {
  $stmt = $db->prepare('
    SELECT username
    FROM user 
    WHERE isAgent = 1
    OR isAdmin = 1
  ');

  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_COLUMN);
      
  return $result;
}

    static function getUserforAdmin(PDO $db, string $username) : User {
      $stmt = $db->prepare('
        SELECT userID, username, email, name, surname, age, isAgent, isAdmin, gender
        FROM user 
        WHERE username = :username
      ');

      $stmt->bindParam(':username', $username);
      
      $stmt->execute();
      $user = $stmt->fetch();

      return new User(
        $user['userID'],
        $user['username'],
        $user['email'],
        $user['name'],
        $user['surname'],
        $user['age'],
        $user['isAgent'],
        $user['isAdmin'],
        $user['gender']
      );
    }

    static function saveUser(PDO $db) :void{
        $stmt = $db->prepare('
        INSERT INTO User (username, password, email, isAgent, isAdmin) 
        VALUES(:username,:password,:email,:isAgent,:isAdmin);
        ');

        $bool = 0;

        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':isAgent', $bool);
        $stmt->bindParam(':isAdmin', $bool);

        if($stmt->execute()){
        }
        else exit();
    }
    
    static function checkUsername(PDO $db) {
      $stmt = $db->prepare('
      Select * from User where username = :username
      ');
      
      $stmt->bindParam(':username', $_POST['username']);
      
      $stmt->execute();
      
      return ($stmt->fetch() !== false);
    }

    static function checkEmail(PDO $db) {
      $stmt = $db->prepare('
      Select * from User where email = :email
      ');

      $stmt->bindParam(':email', $_POST['email']);
      
      $stmt->execute();
      
      return ($stmt->fetch() !== false);
    }

    public static function isAgent(int $userID, PDO $db) : int {
      $stmt = $db->prepare('
      SELECT isAgent 
      FROM User 
      WHERE userID = :userID
      ');

      $stmt->bindParam(':userID', $userID);
      
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_COLUMN);

      return $result;
    }

    public static function isAdmin(int $userID, PDO $db) : int {
      $stmt = $db->prepare('
      SELECT isAdmin 
      FROM User 
      WHERE userID = :userID
      ');

      $stmt->bindParam(':userID', $userID);
      
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_COLUMN);

      return $result;
    }
    public static function changeRole(PDO $db, string $role, string $department, int $userID) {
      $query1 = "UPDATE User SET isAgent = 1, isAdmin = 0 WHERE userID = :userID"; //User to agent
      $query2 = "UPDATE User SET isAgent = 1, isAdmin = 1 WHERE userID = :userID"; //User to Admin
      $query3 = "UPDATE User SET isAgent = 0, isAdmin = 0 WHERE userID = :userID"; //User to Client
      $query4 = "INSERT INTO DepAgent (department, userID) VALUES (:department, :userID)"; //if User Client changed to Agent, insert into Dep
      $query5 = "UPDATE DepAgent SET department = :department WHERE userID = :userID"; //if User Agent, update Dep
      $query6 = "DELETE FROM DepAgent WHERE userID = :userID"; //if User Agent, remove from Dep
      $query7 = "UPDATE Ticket SET agentID = 2 WHERE agentID = :userID"; //if Agent demoted, update all his ticket's ownership to admin
      

      if ($role === "Client") {
        $stmt1 = $db->prepare($query3);
        if (User::isAgent($userID, $db)) {
          $stmt2 = $db->prepare($query6);
          $stmt3 = $db->prepare($query7);
          $stmt2->bindParam(':userID', $userID);
          $stmt3->bindParam(':userID', $userID);
          $stmt2->execute(); 
          $stmt3->execute(); 
        }
        
        $stmt1->bindParam(':userID', $userID);
        $stmt1->execute(); 
      }
      if ($role === "Agent") {
        if(User::isAgent($userID, $db) || User::isAdmin($userID, $db)) {
          $stmt3 = $db->prepare($query5);
          $stmt3->bindParam(':userID', $userID);
          $stmt3->bindParam(':department', $department);
          $stmt3->execute();
        } else {
          $stmt2 = $db->prepare($query4);
          $stmt2->bindParam(':userID', $userID);
          $stmt2->bindParam(':department', $department);
          $stmt2->execute(); 
        }
        $stmt1 = $db->prepare($query1);
        $stmt1->bindParam(':userID', $userID);
        $stmt1->execute(); 
      }
      if ($role === "Admin") {
        if(User::isAgent($userID, $db) || User::isAdmin($userID, $db)) {
          $stmt3 = $db->prepare($query5);
          $stmt3->bindParam(':userID', $userID);
          $stmt3->bindParam(':department', $department);
          $stmt3->execute();
        } else {
          $stmt2 = $db->prepare($query4);
          $stmt2->bindParam(':userID', $userID);
          $stmt2->bindParam(':department', $department);
          $stmt2->execute(); 
        }
        $stmt = $db->prepare($query2);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
      } 
    }
    public static function getUserDepartment(int $userID, PDO $db) {
      $stmt = $db->prepare('
      SELECT department 
      FROM DepAgent 
      WHERE userID = :userID
      ');

      $stmt->bindParam(':userID', $userID);
      
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_COLUMN);

      echo $result;
    }
  }

  
  
?>