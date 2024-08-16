<?php
  declare(strict_types = 1);

  class Comment {
    public ?int $comment_id;
    public ?string $comment_date;
    public ?string $content;
    public ?int $ticket_id;
    public ?int $user_id;
    
    public function __construct(int $comment_id, string $comment_date, string $content, int $ticket_id, int $user_id)
    {
      $this->comment_id = $comment_id;
      $this->comment_date = $comment_date;
      $this->content = $content;
      $this->ticket_id = $ticket_id;
      $this->user_id = $user_id;
    }


    static function create_comment($db, int $ticket_id) : void {
        $date = new DateTime();
        $formattedDate = $date->format('Y-m-d H:i:s');
        $stmt = $db-> prepare('
            INSERT INTO Comments (comment_date, content, ticket_id, user_id)
            VALUES (:comment_date, :content, :ticket_id, :user_id)
        ');
        $stmt->bindParam(':comment_date',$formattedDate);
        $stmt->bindParam(':content', $_POST['message-input']);
        $stmt->bindParam(':ticket_id', $ticket_id);
        $stmt->bindParam(':user_id', $_SESSION['userID']);
        
        $stmt->execute();
    }

    static function display_comments($db, Ticket $ticket, User $user) : void {
      $stmt = $db->prepare('
        SELECT * FROM Comments 
        WHERE ticket_id = :ticket_id
      ');
      
      $stmt->bindParam(':ticket_id', $ticket->ticket_id);
      $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $commentContent = $row['content'];
        $commentDate = $row['comment_date'];
        $commentPoster = $row['user_id'];
        $username = User::getUsername($commentPoster, $db);
        
        if (User::isAgent($commentPoster, $db) === 1) {
          echo "
          <div class='message agent-message'>
              <p>$commentContent</p>
              <span class='timestamp'>$username - $commentDate</span>
            </div>
          ";
        }
        else {
          echo "
          <div class='message user-message'>
              <p>$commentContent</p>
              <span class='timestamp'>$username - $commentDate</span>
            </div>
          ";
        }
      }
    }
 }
?>