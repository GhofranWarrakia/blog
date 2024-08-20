<?php
include_once 'Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$message = '';
$status = '';

if (isset($_GET['id'])) {
    if ($post->delete($_GET['id'])) {
        $message = "تم حذف المقالة بنجاح";
        $status = "success";
        header("Location: list_posts.php"); // إعادة التوجيه إلى صفحة عرض المقالات بعد الحذف
        exit();
    } else {
        $message = "حدث خطأ أثناء حذف المقالة";
        $status = "error";
    }
} else {
    $message = "لم يتم تحديد المقالة";
    $status = "error";
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $status === 'success' ? 'حذف المقالة' : 'خطأ'; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .success {
            color: #27ae60;
        }
        .error {
            color: #e74c3c;
            background-color: #f8d7da;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            width: 100%;
        }
        .error-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f8d7da;
            color: #721c24;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
        }
        .error-content {
            background-color: #f5c6cb;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
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
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($status === 'success') : ?>
        <div class="message success">
            <?php echo $message; ?>
        </div>
        
    <?php elseif ($status === 'error') : ?>
        <div class="error-container">
            <div class="error-content">
                <h1>لم يتم العثور على المقالة</h1>
                <p>يرجى التحقق من الرابط والمحاولة مرة أخرى</p>
                <a href="list_posts.php" class="back-button">الذهاب إلى قائمة المقالات</a>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
