<?php
include_once 'Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استخدم filter_input للتحقق من المدخلات
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);

    if ($title && $content && $author) {
        $post->title = $title;
        $post->content = $content;
        $post->author = $author;

        try {
            if ($post->create()) {
                $message = "تم إنشاء المقالة بنجاح";
            } else {
                $message = "حدث خطأ أثناء إنشاء المقالة";
            }
        } catch (Exception $e) {
            $message = "حدث خطأ: " . $e->getMessage();
        }
    } else {
        $message = "يرجى ملء جميع الحقول.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء مقالة</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.1em;
            color: #155724;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 4px;
            display: <?php echo empty($message) ? 'none' : 'block'; ?>;
        }
        .view-posts-button {
            background-color: #28a745;
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            display: block;
            margin-top: 20px;
        }
        .view-posts-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>إنشاء مقالة جديدة</h1>
    <form method="post">
        <input type="text" name="title" placeholder="العنوان" required>
        <textarea name="content" placeholder="المحتوى" required></textarea>
        <input type="text" name="author" placeholder="المؤلف" required>
        <button type="submit">إنشاء</button>
    </form>

    <?php if (!empty($message)): ?>
        <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <a href="list_posts.php" class="view-posts-button">عرض المقالات</a>
</div>

</body>
</html>
