<?php
  class Session {
    public function __construct() {
      session_start();
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['userID']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getuserId() : ?int {
      return isset($_SESSION['userID']) ? $_SESSION['userID'] : null;    
    }

    public function getUsername() : ?string {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function setuserID(int $userID) {
      $_SESSION['userID'] = $userID;
    }

    public function setUsername(string $username) {
      $_SESSION['username'] = $username;
    }
  }
?>