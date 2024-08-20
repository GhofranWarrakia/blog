<?php
include_once 'Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id'])) {
    $post->read($_GET['id']);
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
        }
    </style>
</head>
<body>

<div class="error-container">
    <h1>لم يتم العثور على المقالة</h1>
    <p>يرجى التحقق من الرابط والمحاولة مرة أخرى.</p>
    <a href="list_posts.php" class="back-button">الذهاب إلى قائمة المقالات</a>
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
    <title><?php echo htmlspecialchars($post->title); ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            direction: rtl; /* لضبط اتجاه النص إلى اليمين */
        }
        .post-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: right; /* لمحاذاة النص لليمين */
        }
        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center; /* لمركزة العنوان */
        }
        p {
            line-height: 1.8; /* تحسين المسافة بين الأسطر */
            color: #555;
            margin-bottom: 20px;
        }
        .author-info {
            font-size: 1.1em;
            color: #666;
            text-align: right;
            margin-top: 40px;
        }
        .author-info p {
            margin: 5px 0;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 30px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF; /* اللون الأساسي للزر */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }
        .back-button a:hover {
            background-color: #0056b3; /* اللون عند المرور */
        }
        @media (max-width: 768px) {
            .post-container {
                padding: 15px;
                box-shadow: none;
            }
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<div class="post-container">
    <h1><?php echo htmlspecialchars($post->title); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($post->content)); ?></p> 
    
    <div class="author-info">
        <p>بواسطة :<?php echo htmlspecialchars($post->author); ?></p>
        <p>تم الإنشاء في: <?php echo date('Y-m-d H:i', strtotime($post->created_at)); ?></p>
    </div>

    <div class="back-button">
        <a href="list_posts.php">العودة إلى القائمة</a>
    </div>
</div>

</body>
</html>
