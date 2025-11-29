<?php
session_start();
$basePath = dirname(dirname(__FILE__));
include $basePath . '/config.php';
include $basePath . '/includes/header.php';
?>

<div class="posts-grid">
    <?php
    $sql = "SELECT * FROM posts";
    $result = $conn->query($sql);

    foreach ($result as $post){
        ?>
        <div class="post-card">
            <div class="post-header">
                <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                <div class="post-meta">By <?php echo htmlspecialchars($post['user']); ?> on <?php echo date('F j, Y', strtotime($post['date'])); ?></div>
            </div>
            <div class="post-content">
                <p class="post-excerpt"><?php echo htmlspecialchars($post['content']); ?></p>

            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php
include $basePath . '/includes/footer.php';
?>
