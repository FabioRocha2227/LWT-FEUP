<?php
  declare(strict_types = 1);


  class Ticket {
    public ?int $ticket_id;
    public ?string $title;
    public ?string $date;
    public ?string $status;
    public ?string $description;
    public ?int $userID;
    public ?int $agentID;
    public ?string $department;
    
    public function __construct(int $ticket_id, string $title,int $userID,  int $agentID, string $date ,string $status, string $description, string $department)
    {
      $this->ticket_id = $ticket_id;
      $this->title = $title;
      $this->userID = $userID;
      $this->agentID = $agentID;
      $this->date = $date;
      $this->status = $status;
      $this->description = $description;
      $this->department = $department;
    }

    static function getTicket(PDO $db,int $id) : Ticket {
      $stmt = $db->prepare('
        SELECT * FROM ticket 
        WHERE ticket_id = :ticket_id
      ');
      
      $stmt->bindParam(':ticket_id', $id);

      $stmt->execute();
      $ticket =  $stmt->fetch();

      return new Ticket(
        $ticket['ticket_id'],
        $ticket['title'],
        $ticket['userID'],
        $ticket['agentID'],
        $ticket['date'],
        $ticket['status'],
        $ticket['description'],
        $ticket['department']
      );
    }


    public static function editTicket(PDO $db, $ticket_id, $status, $department, $agentID) : void{
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d H:i:s');

    $stmt =$db->prepare( '
      UPDATE Ticket SET status = :status, department = :department, agentID = :agentID, date = :date
      WHERE ticket_id = :ticket_id');
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':agentID', $agentID);
    $stmt->bindParam(':ticket_id', $ticket_id);
    $stmt->bindParam(':date', $formattedDate);

    $stmt->execute();
   
}

    static function create_ticket($db) : void{
        $date = new DateTime();
        $formattedDate = $date->format('Y-m-d H:i:s');
        $stmt = $db->prepare('
            INSERT INTO Ticket (title, description, userID, agentID, status, department, date) 
            VALUES(:title, :description, :userID, 2, "NEW", :department, :date);
        ');
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':userID', $_SESSION['userID']);
        $stmt->bindParam(':department',  $_POST['department']);
        $stmt->bindParam(':date', $formattedDate);

        $stmt->execute();
    }

  static function display_ticket_list($db) : void {
    $stmt = $db->prepare('
      SELECT * FROM Ticket
      WHERE userID = :userID 
     
    ');
    $stmt->bindParam(':userID', $_SESSION['userID']);
    $stmt->execute();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

        $ticketID = $row["ticket_id"]; 
        $department = $row["department"];
        $title = $row["title"]; 
        $status = $row["status"];
        $date = $row["date"];
        $agentID = $row['agentID'];
        
        $agentName = User::getUsername($agentID,$db);
 
        echo 
        "<tr>
          <td>$ticketID</td>
          <td>$department</td>
          <td>$title</td>
          <td>$status</td>
          <td>$date</td>
          <td>$agentName</td>
          <td><a href='../pages/ticket.php?id=$ticketID'> View </a> </td>
        </tr>";
      }
    }

  static function display_agent_ticket_list($db) : void {
    $id = intval($_SESSION['userID']);
    if(User::isAdmin($id, $db) === 1) {
      $stmt = $db->prepare('
      SELECT * FROM Ticket;
      ');
      $stmt->execute();
    } 
    else {
      $stmt = $db->prepare('
        SELECT * FROM Ticket
        WHERE agentID = :userID;
      ');
      $stmt->bindParam(':userID', $_SESSION['userID']);
      $stmt->execute();
    }


      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

        $ticketID = $row["ticket_id"]; 
        $department = $row["department"];
        $title = $row["title"]; 
        $status = $row["status"];
        $date = $row["date"];           
 
        echo 
        "<tr>
          <td>$ticketID</td>
          <td>$department</td>
          <td>$title</td>
          <td>$status</td>
          <td>$date</td>
          <td><a href='../pages/ticket.php?id=$ticketID'> View </a> </td>
        </tr>";
      }
    }
  }
?>