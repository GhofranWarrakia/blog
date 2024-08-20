<?php
include_once 'Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $post->read($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // استخدام filter_input للتحقق من إدخال POST
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);

        if ($title && $content && $author) {
            $post->title = $title;
            $post->content = $content;
            $post->author = $author;

            if ($post->update($_GET['id'])) {
                $message = "تم تحديث المقالة بنجاح";
                $status = "success";
            } else {
                $message = "حدث خطأ أثناء تحديث المقالة.";
                $status = "error";
            }
        } else {
            $message = "يرجى ملء جميع الحقول.";
            $status = "error";
        }
    }
} else {
    echo '
    <!DOCTYPE html>
    <html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>خطأ</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8d7da;
                color: #721c24;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .error-container {
                background-color: #f5c6cb;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 400px;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }
            p {
                font-size: 18px;
                margin: 0 0 20px;
            }
         .back-button {
            background-color: #6c757d; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #5a6268; 
    </style>
    </head>
    <body>

    <div class="error-container">
        <h1>لم يتم العثور على المقالة</h1>
        <p>يرجى اختيار مقالة لتعديلها</p>
        <a href="list_posts.php" class="back-button">الذهاب لقائمة المقالات </a>
    </div>

    </body>
    </html>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث المقالة</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
        }
        .success {
            color: #27ae60;
        }
        .error {
            color: #e74c3c;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
            margin-top: 15px;
            display: block; /* لعرض الزر في سطر منفصل */
        }
        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>تحديث المقالة</h1>

    <?php if (isset($message)) : ?>
        <div class="message <?php echo $status; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post->title); ?>" required placeholder="العنوان">
        <textarea name="content" required placeholder="المحتوى"><?php echo htmlspecialchars($post->content); ?></textarea>
        <input type="text" name="author" value="<?php echo htmlspecialchars($post->author); ?>" required placeholder="المؤلف">
        <button type="submit">تحديث</button>
        <a href="list_posts.php" class="button">العودة إلى القائمة</a>
    </form>
</div>

</body>
</html>
