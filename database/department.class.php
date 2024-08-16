<?php
declare(strict_types=1);

class Department{

    public string $department;

    public function __construct(string $department){    
        $this->department = $department;

    }

    static function getDepartments(PDO $db) {
        $stmt = $db->prepare('SELECT * FROM Department ');
        $stmt->execute();

        $departments = array();

        while ($row = $stmt->fetch()) {
            $departments[] = new Department(
                $row['department']
            );
        }

        return $departments;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Department SET name = ?
            ');

        $stmt->execute();
    }

    static function create_department($db) : void{
        
        $stmt = $db->prepare('
            INSERT INTO Department (department) 
            VALUES(:department);
        ');
        
        $stmt->bindParam(':department',  $_POST['department']);
        

        $stmt->execute();
    }

    public function remove_department($db) : void{

        $stmt = $db->prepare('
        DELETE FROM Department 
        WHERE department = :department
        ');
        $stmt->bindParam(':department', $this->department);
        $stmt->execute();
    }

    static function checkDepName(PDO $db) {
        $stmt = $db->prepare('
        Select * from Department where department = :department
        ');
        $stmt->bindParam(':department', $_POST['department']);
        $stmt->execute();
        
        return ($stmt->fetch() !== false);
      }


}

?>