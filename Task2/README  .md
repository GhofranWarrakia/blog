Here’s how to set up and run the project:

1. Set Up the Local Environment
Install a Web Server:

Make sure you have a web server like XAMPP, WampServer, or MAMP installed on your machine.
Install PHP and MySQL:

Ensure that your development environment supports PHP and MySQL. Most web servers come with these components pre-installed.
2. Set Up the Database
Create a Database:

Open the MySQL management tool (such as phpMyAdmin) and create a new database. You might name it something like blog_db.

3. Run the Application
Copy Project Files:

Copy the project files to the htdocs directory in XAMPP, www directory in WampServer, or the appropriate folder in your web server.
Open the Application in Your Browser:

Open your web browser and go to http://localhost/blog_db (or the folder name where you placed the project).
Set Up the Database:

If there are any database setup procedures (like creating tables), make sure to execute any provided SQL scripts. There may be an SQL file you can import via phpMyAdmin.
4. Use the Application
Create a Post:

Go to the "Create Post" page and fill out the form to create a new blog post.
View Posts:

Navigate to the "Posts List" page to view all available posts with options to edit or delete them.
Edit a Post:

Click "Edit" next to an existing post to modify its content.
Delete a Post:

Click "Delete" next to a post to remove it.
View Post Details:

Click "View" to see the details of a specific post.
By following these steps, you can set up and test the blog management system on your local development environment.


PHP Functions and Methods Used:
1. Database Class
getConnection(): Establishes a connection to the database using PDO (PHP Data Objects). It specifies connection details such as host, db_name, username, and password. It also sets the character set to UTF-8 to properly handle Arabic text.
Features:
Using PDO makes the code more secure and robust. It allows for prepared statements, which helps protect against SQL Injection attacks.
2. Post Class
create(): Creates a new post in the database. It uses the prepare method to prevent SQL Injection attacks and sanitizes the data by stripping HTML tags.
read($id): Reads a single post based on its ID. It retrieves the data and stores it in the object's properties.
update($id): Updates an existing post in the database based on its ID. Values are bound to the SQL query for updating the post.
delete($id): Deletes a post from the database based on its ID.
listAll(): Displays all posts from the database.
Features:
Using htmlspecialchars and strip_tags for data sanitization protects against XSS (Cross-Site Scripting) attacks.
Employing prepare and bindParam methods improves the security of SQL queries.

3. Create Post Page
Database and Post Setup:
Includes: Loads Database and Post class definitions.
Database Connection: Creates a Database object and gets the connection.
Post Object: Creates a Post object with the database connection.

Form Handling:
Checks for POST Data: If the form is submitted, it assigns the form data (title, content, author) to the Post object.
Create Post: Calls the create() method to insert the post into the database and sets a success or error message based on the result.

User Interface:
HTML Form: Provides input fields for creating a post and a button to submit.
Message Display: Shows a success or error message if there is one.
Link: Includes a link to view the list of posts.
 
filter_input to sanitize user inputs.
try-catch blocks to handle errors more effectively.
Improve message handling by using htmlspecialchars for better security when displaying messages. 

Features:
Data Validation: Checks if data is present before attempting to insert it.
User Feedback: Displays success or error messages based on the outcome of the operation.
Responsive Design: Uses CSS to make the interface adapt to screen size and look appealing.
Use of HTML Entities: Employs htmlspecialchars() to prevent XSS by converting special characters to HTML entities. 

4. Delete Post Page
Function: Includes other PHP files. include_once ensures that the file is included only once, even if it's included multiple times.
new: Creates a new instance of a class.
getConnection(): A method in the Database class that returns the database connection.
isset(): Checks if a variable is set and is not null.
header():Sends an HTTP header to redirect the browser to another URL.
exit():Terminates the script execution immediately.
Features:
Redirection After Deletion:
Uses header("Location: list_posts.php") to redirect users to the posts list page after a successful deletion.

Displaying Success or Error Messages:
Shows messages based on the outcome of the deletion process, with specific styling for errors.

User Interface Design:
CSS Styling: Enhances the page's appearance with styled messages and backgrounds.
Clear Messaging: Provides clear, color-coded feedback to improve the user experience.

5. Update Post Page

include_once 'Database.php'; and include_once 'Post.php';
Purpose: These lines include the Database and Post classes from external files. include_once ensures that the file is included only once to prevent redeclaration errors.

$database = new Database();
Purpose: Creates a new instance of the Database class, which likely contains methods for connecting to the database.

$db = $database->getConnection();
Purpose: Calls the getConnection() method of the Database class to obtain a database connection.

$post = new Post($db);
Purpose: Creates a new instance of the Post class, passing the database connection to it. This class likely contains methods for interacting with post records.

$post->read($_GET['id']);
Purpose: Calls the read() method of the Post class to retrieve the post with the given ID (from the URL query parameter id).

if ($_SERVER['REQUEST_METHOD'] === 'POST')
Purpose: Checks if the request method is POST, indicating that the form has been submitted.

filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
Purpose: Sanitizes the input from the form to prevent security issues like XSS (Cross-Site Scripting). It retrieves and sanitizes the title field from the POST request.

$post->title = $title;, $post->content = $content;, $post->author = $author;
Purpose: Assigns the sanitized form values to the corresponding properties of the Post object.

$post->update($_GET['id']);
Purpose: Calls the update() method of the Post class to update the post with the new values.

htmlspecialchars($message);
Purpose: Converts special characters to HTML entities to prevent XSS attacks. This is used to safely display messages on the page.

filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
Purpose: Sanitizes input from the form to prevent security issues.

header('Location: list_posts.php');
Purpose: Redirects the user to another page (not included in the provided code but could )

Features:
Input Validation and Sanitization: Uses filter_input() to clean user inputs, preventing SQL injection and XSS attacks.
Error Handling and User Feedback: Provides feedback with $message and $status to inform users of success or failure.
Responsive and User-Friendly UI: Employs clean HTML and CSS for a responsive, user-friendly interface.
Form Handling: Utilizes POST method for secure data submission and updates, with placeholders and required attributes for better usability.
Error Page Handling: Displays an error page with a link to the post list if no ID is provided.
Use of HTML Entities: Employs htmlspecialchars() to prevent XSS by converting special characters to HTML entities.

6. List Posts Page

include_once:
Purpose: Includes the Database.php and Post.php files only once per page load.
Usage: It is used to include the required classes for handling database connections and article operations.

new:
Purpose: Creates new objects from the Database and Post classes.
Usage: Used to create a Database object to get the database connection and a Post object to manage article operations.

$post->listAll():
Purpose: Retrieves a list of articles from the database.
Usage: This method is called to fetch all articles from the database and display them on the page.

while ($row = $posts->fetch(PDO::FETCH_ASSOC):
Purpose: Fetches each record from the database query results and displays it.
Usage: Used in a while loop to iterate through each record in the result set and display article data.

.post-list: Styles the article list to remove bullet points and set spacing.
.post-list li: Styles list items to have a white background, shadow, and spacing.
.post-list li a: Styles links within list items.
.post-list .actions a: Styles the edit and delete buttons.
.add-post-button: Styles the button for adding a new article.

href: Specifies the URLs for pages like create_post.php, edit_post.php, delete_post.php, and view_post.php for navigating between article management pages.

fetch(PDO::FETCH_ASSOC): Uses PDO to fetch results from the database as an associative array.

Features:
CSS is used to format the list of posts, including buttons for edit and delete actions.

7. View Post Page

$database->getConnection():
Purpose: Retrieves a database connection.
Usage: Used to obtain a PDO connection to the database.

$post->read($_GET['id']:
Purpose: Reads a specific article based on the ID passed via the query string.
Usage: If an article ID is present in the URL, this method is called to fetch and display the article details.

CSS Styles:

body: Sets the default font, background color, margins, padding, and layout properties like centering content.
.error-container: Styles the error message container with background color, padding, border radius, and shadow.
.back-button: Styles the link for navigating back to the list of posts.
.post-container: Styles the container for the article with background color, padding, border radius, and shadow.
h1: Styles the article title, centers it, and sets its color and font size.
p: Styles paragraphs for article content and author information.
.author-info: Styles the section displaying author information.
@media (max-width: 768px): Defines responsive styles for devices with a maximum width of 768px.

PHP Functions in HTML:

htmlspecialchars(): Escapes special characters to prevent XSS attacks.
nl2br(): Converts newline characters to HTML line breaks for proper display of multi-line content.
date('Y-m-d H:i', strtotime($post->created_at)): Formats the article creation date

Features:
Error Handling: If no article ID is provided, the script outputs an error message with a link to return to the list of articles.
Article Display: If an article ID is provided, the script displays the article's title, content, author information, and creation date.
This code ensures that users see either an appropriate error message or the details of an article based on the provided URL parameters.


License
This project is licensed under the FocalX License.

Credits
Ghofran Warrakia

Contact
For any inquiries or support, please contact:

GitHub: https://github.com/GhofranWarrakia
LinkedIn: GhofranWarrakia
