<?php
class CommentsClass 
{
    private $pdo;
    private $page_id;
    private $id;
    private $limit;

    public function __construct(PDO $pdo, $page_id ='', $id ='', $limit='')
    {
        $this->pdo = $pdo;
        $this->page_id = $page_id;
        $this->id = $id;
        $this->limit = $limit;
    }

    public function getAllPostComments($page_id, $limit=''){
        global $pdo;
        
        /*Get a section of comments related to a particular post and display them on the page of the post  */
        $query = "SELECT * FROM `comments` WHERE `post_id` = :page_id ORDER BY created_at DESC ".$limit;
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':page_id',$page_id);
        
        $stmt->execute();
                
        return $stmt->fetchAll();
    }

    public function getCommentCountByPostId($id){
        /* //Get number of comments in a page */
        global $pdo;
        $query = "SELECT COUNT(*) AS total FROM comments WHERE post_id= :id";
        
        $sql = $pdo->prepare($query);
        
        $sql->execute([':id'=>$id]);
        
        $total = $sql->fetchColumn();
        return $total;
            
    }

    public function getUserById($id){
        /* //Get users by id */
        global $pdo;
        $query = "SELECT user_id, username, profile_photo FROM `users` WHERE user_id= :id";
        
        $sql=$pdo->prepare($query);
        $sql->bindValue(':id', $id);
        
        $sql->execute();
        
        return $sql->fetch();
    }

    public function getRepliesByCommentId($id){
        /* //Getting replies by comment_id */
        global $pdo;
        $sql = "SELECT * FROM `replies` WHERE comment_id = :id ORDER BY created_at DESC";
        
        $query=$pdo->prepare($sql);
        $query->bindValue(':id', $id);
        
        $query->execute();
        
        return $query->fetchAll();
        
    }

    public function getRepliesCountByCommentId($id){
        /* //Get number of replies in a comment */
        global $pdo;
        $query ="SELECT COUNT(*) AS number FROM `replies` WHERE comment_id=:id";
        
        $sql = $pdo->prepare($query);
        $sql->execute([':id'=>$id]);
        $number = $sql->fetchColumn();
        return $number;
    }

}