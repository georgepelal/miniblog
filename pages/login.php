<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: home.php");
    exit;
}

$basePath = dirname(dirname(__FILE__));
include $basePath . '/config.php';
include $basePath . '/includes/header.php';

?>
<?php
    
?>

<?php
    $email = "";
    $password = "";
    $message = $message_type = '';

    if (isset($_POST['login'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])){
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                $message = 'Login successful. Welcome, ' . htmlspecialchars($user['username']) . '!';
                $message_type = 'success';
            }else{
                $message = 'Incorrect password.';
                $message_type = 'error';
            }
        }else{
            $message = 'No user found with that email address.';
            $message_type = 'error';
        }
    }
?>
<div class="container" style="max-width: 400px; margin: 60px auto; padding: 20px;">
    <h1 style="text-align: center; margin-bottom: 30px; color: #333;">Login</h1>

    <?php if (!empty($message)): 
        $bg = $message_type === 'success' ? '#e9f7ef' : '#fff0f0';
        $border = $message_type === 'success' ? '#2ecc71' : '#e74c3c';
    ?>
    <div style="margin-bottom:16px; padding:12px 16px;
    border:1px solid <?php echo $border;?>; background:<?php echo $bg;?>; border-radius:8px; position:relative; box-shadow:0 1px 2px rgba(0,0,0,0.03);">
            <strong style="display:block; margin-bottom:6px; color:#333;"><?php echo $message_type === 'success' ? 'Success' : 'Error'; ?></strong>
            <div style="color:#333;"><?php echo htmlspecialchars($message); ?></div>
            <button type="button" onclick="this.parentElement.style.display='none'" aria-label="Close" style="position:absolute; right:8px; top:8px; border:none; background:transparent; font-size:18px; line-height:1; cursor:pointer; color:#333;">&times;</button>
    </div>
    <?php endif; ?>
    <form method="POST" style="background: #f9f9f9; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold; color: #555;">Password:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; box-sizing: border-box;">
        </div>

        <button type="submit" name="login" style="width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s;">Login</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #333;">
        Don't have an account? <a href="register.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Sign up here</a>
    </p>
</div>

<?php
include $basePath . '/includes/footer.php';
?>