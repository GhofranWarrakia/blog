<?php
class Post {
    private $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // إنشاء مقالة جديدة
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, content=:content, author=:author";
        $stmt = $this->conn->prepare($query);

        // تنظيف البيانات
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));

        // ربط البيانات
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":author", $this->author);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // قراءة مقالة واحدة
    public function read($id) {
        $query = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        // التحقق مما إذا كان هناك أي بيانات تم جلبها
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->author = $row['author'];
            $this->created_at = $row['created_at'];
        } else {
            echo "لم يتم العثور على المقالة.";
            return false;
        }
    }
    

    // تحديث مقالة
    public function update($id) {
        $query = "UPDATE " . $this->table_name . " SET title=:title, content=:content, author=:author WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // تنظيف البيانات
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));

        // ربط البيانات
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // حذف مقالة
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // عرض جميع المقالات
    public function listAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
