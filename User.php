<?php

    class User {
        private $id;
        private $username;
        private $password;

        public function __construct(String $Uname, String $Pword) {
            $this->username = $Uname;
            $this->password = $Pword;
        }

        public function saveToDb() {
            global $db;

            $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)")
                ->execute(['username' => $this->username, 'password' => $this->password]);
        }

        public static function getUsernames() : array {
            global $db;
            $retArr = [];

            $q = $db->query("SELECT username FROM users")->fetchAll();

            foreach($q as $elem) {
                $name = $elem['username'];
                $retArr[] = $name;
            }

            return $retArr;
        }
    }

?>