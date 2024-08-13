<?php
class Vote {
    private $conn;
    private $table_name = 'user_votes';

    public $user_id;
    public $vote_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function hasVoted() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function submitVote() {
        if ($this->hasVoted()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " SET user_id = :user_id, vote_id = :vote_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':vote_id', $this->vote_id);

        return $stmt->execute();
    }

    public function getPollResults() {
        $query = "SELECT v.option, COUNT(uv.vote_id) as votes FROM votes v LEFT JOIN user_votes uv ON v.id = uv.vote_id GROUP BY v.option";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalVotes() {
        $query = "SELECT COUNT(*) as total_votes FROM user_votes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_votes'];
    }
}
?>