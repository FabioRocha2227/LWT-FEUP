<?php function draw_faq($question) { ?>
    <!DOCTYPE html>
    <head>
        <title>FAQ Page</title>
        <link rel="stylesheet" href="../css/pages.css">
    </head>
<body>
  <div class="faqBody">
    <h1 class="faqTitle">Frequently Asked Questions</h1>
    <h1 class="faqTitle mobile">FAQ</h1>

    <?php foreach ($question as $row) { ?>
    <div class="question">Q: <?php echo $row->question;?></div>
    <div class="answer">A: <?php echo $row->answer;?>.</div>
    <?php } ?>


    <script>
      window.addEventListener('DOMContentLoaded', function() {
        const questions = document.querySelectorAll('.question');

        questions.forEach(function(question) {
          question.addEventListener('click', function() {
            const answer = this.nextElementSibling;

            if (answer.style.display === 'none') {
              answer.style.display = 'block';
            } else {
              answer.style.display = 'none';
            }
          });
        });
      });
    </script>
  </div>
  <form action="../actions/action_add_faq.php" method="post">

    <div class="addQuestion">
    
      <h1 class="faqTitle">Add new entry</h1>
      <label class="profileLabel2" for="question">Question:</label>
      <input id="question" type="text" name="question">
      <br>

      <label class="profileLabel2" for="answer">Answer:</label>
      <input id="answer" type="text" name="answer">
      <br>

      <button type="submit">Add</button>
    </div>
  </form>
</body>
</html>

<?php } ?>
