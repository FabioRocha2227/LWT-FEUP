<?php
  declare(strict_types = 1);

  class Faq {
    public ?int $faq_id;
    public ?string $question;
    public ?string $answer;

    public function __construct(int $faq_id, string $question, string $answer)
    {
      $this->faq_id = $faq_id;
      $this->question = $question;
      $this->answer = $answer;
    }

    static function addFAQ(PDO $db) :void{
        $stmt = $db->prepare('
        INSERT INTO FAQ (question, answer) 
        VALUES(:question,:answer);
        ');

        $stmt->bindParam(':question', $_POST['question']);
        $stmt->bindParam(':answer', $_POST['answer']);

        if($stmt->execute());
        
    }


    static function getQuestion(PDO $db) {
      $stmt = $db->prepare('SELECT * FROM FAQ ');
      $stmt->execute();

      $question = array();

      while ($row = $stmt->fetch()) {
          $newquestion[] = new Faq(
              $row['faq_id'],
              $row['question'],
              $row['answer']
          );
      }
      return $newquestion;
  }

}
?>