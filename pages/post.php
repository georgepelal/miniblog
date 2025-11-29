<?php
session_start();
$basePath = dirname(dirname(__FILE__));
include $basePath . '/config.php';
include $basePath . '/includes/header.php';

?>

<?php
    $title = $content = $user = "";
    $message = '';
    $message_type = '';

    if (isset($_POST['submit'])){
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){    
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user = $_SESSION['username'];
            // Insert post into database
            $sql = "INSERT INTO posts (title, content, user) VALUES ('$title', '$content', '$user')";
            if ($conn->query($sql) === TRUE) {
                $message = 'New post created successfully';
                $message_type = 'success';
            } else {
                $message = 'Error: ' . $conn->error;
                $message_type = 'error';
            }
        }else{
            $message = 'You must log in first to create a post.';
            $message_type = 'error';
        }
    }
?>

<div class="container" style="max-width: 600px; margin: 40px auto; padding: 20px;">
    <h1 style="text-align: center; margin-bottom: 30px; color: #333;">Create a Post</h1>
    <?php if (!empty($message)): 
        $bg = $message_type === 'success' ? '#e9f7ef' : '#fff0f0';
        $border = $message_type === 'success' ? '#2ecc71' : '#e74c3c';
    ?>
    <div style="margin-bottom:16px; padding:12px 16px; border:1px solid <?php echo $border;?>; background:<?php echo $bg;?>; border-radius:8px; position:relative; box-shadow:0 1px 2px rgba(0,0,0,0.03);">
        <strong style="display:block; margin-bottom:6px; color:#333;"><?php echo $message_type === 'success' ? 'Success' : 'Error'; ?></strong>
        <div style="color:#333;"><?php echo htmlspecialchars($message); ?></div>
        <button type="button" onclick="this.parentElement.style.display='none'" aria-label="Close" style="position:absolute; right:8px; top:8px; border:none; background:transparent; font-size:18px; line-height:1; cursor:pointer; color:#333;">&times;</button>
    </div>
    <?php endif; ?>

    <form method="POST" style="background: #f9f9f9; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Title:</label>
            <input type="text" id="title" name="title" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="content" style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Content:</label>
            <textarea id="content" name="content" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box; font-family: Arial, sans-serif;"></textarea>
        </div>

        <button type="submit" name="submit" style="width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s;">Submit</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #333;">
        Haven't logged in yet? <a href="login.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Login here</a>
    </p>
</div>

<?php
include $basePath . '/includes/footer.php';
?>
