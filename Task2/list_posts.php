<?php
include_once 'Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$posts = $post->listAll();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المقالات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .post-list {
            list-style-type: none;
            padding: 0;
            max-width: 800px;
            margin: 0 auto;
        }
        .post-list li {
            background-color: #fff;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .post-list li a {
            text-decoration: none;
            color: #3498db;
            font-size: 1.2em;
        }
        .post-list li a:hover {
            color: #2980b9;
        }
        .post-list .actions {
            display: flex;
            gap: 10px;
        }
        .post-list .actions a {
            background-color: #e74c3c;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9em;
        }
        .post-list .actions a:hover {
            background-color: #c0392b;
        }
        .post-list .actions a.edit {
            background-color: #f39c12;
        }
        .post-list .actions a.edit:hover {
            background-color: #e67e22;
        }
        .add-post-button {
            display: block;
            width: max-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #2ecc71;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1em;
        }
        .add-post-button:hover {
            background-color: #27ae60;
        }
        
        .post-list li {
            justify-content: flex-start; }
        .post-list li a {
            margin-left: auto;
        }
    </style>
</head>
<body>

<h1>قائمة المقالات</h1>

<a href="create_post.php" class="add-post-button">إضافة مقالة</a>  

<ul class="post-list">
    <?php while ($row = $posts->fetch(PDO::FETCH_ASSOC)) : ?>
        <li>
            <div class="actions">
                <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="edit">تعديل</a>
                <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="delete">حذف</a>
            </div>
            <a href="view_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
        </li>
    <?php endwhile; ?>
</ul>

</body>
</html>
