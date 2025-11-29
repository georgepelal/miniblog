
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Mini Blog</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
            padding: 20px;
            flex: 1;
        }

        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px 20px;
            text-align: center;
            color: white;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        main {
            flex: 1;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .post-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .post-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: white;
        }

        .post-title {
            font-size: 1.5em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .post-meta {
            font-size: 0.9em;
            opacity: 0.9;
        }

        .post-content {
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .post-excerpt {
            font-size: 1em;
            margin-bottom: 15px;
            color: #333;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .post-author {
            font-size: 0.9em;
            color: #999;
        }

        .read-more {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: opacity 0.3s ease;
            font-weight: 600;
        }

        .read-more:hover {
            opacity: 0.9;
        }

        .empty-state {
            background: white;
            border-radius: 10px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .empty-state h2 {
            color: #999;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #bbb;
        }

        footer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            text-align: center;
            color: white;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        nav {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1em;
            transition: opacity 0.3s ease;
        }

        nav a:hover {
            opacity: 0.8;
        }

        nav a.active {
            border-bottom: 2px solid white;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href= home.php>Home</a>
            <a href= post.php>Post</a>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<a href="logout.php">Logout</a>';
            }else{
                echo '<a href= login.php>Login/Register</a>';
            }
            ?>
        </nav>

        <header>
            <h1>📝 My Mini Blog</h1>
            <p>Share your thoughts and ideas with the world</p>
        </header>

        <main>
