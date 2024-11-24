<?php
include('connect.php');

$postID = $_GET['id'];

if (isset($_POST['btnEdit'])) {
    $updateContent = $_POST['updatedContent'];

    $editQuery = "UPDATE posts SET content='$updateContent' WHERE postID ='$postID'";
    executeQuery($editQuery);

    header('Location: ./');
}

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID WHERE postID = '$postID'";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="images/fbLogo.png">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #18191A;
        }

        .postCard {
            border-radius: 10px;
            background-color: #242526;
            color: #B7BABE;
            max-width: 500px;
            margin: 0 auto;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            background-color: transparent;
            color: #B7BABE;
            align-items: center;
            outline: 1px solid #B7BABE;
            height: 60px;
        }

        .header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .header h6 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .header small {
            color: #B0B3B8;
        }

        textarea {
            width: 100%;
            background-color: transparent;
            color: #B7BABE;
            border: none;
            border-radius: 10px;
            resize: none;
            font-size: 16px;
            height: 100%;
            max-height: 50px;
        }

        textarea:focus {
            outline: none;
            background-color: transparent;
        }

        .content-image img {
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
        }

        .editButtonItem {
            display: inline-flex;
            justify-content: center; 
            align-items: center;
            border-radius: 50%;
            width: 35px; 
            height: 35px;
        }

        .editButtonItem img {
            width: 30px;
            height: 30px;
        }

        .editButtonItem:hover {
            background-color: #3B3D3E;
        }

        .btn-primary {
            background-color: #2374E1;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            padding: 10px 15px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #1A5DB7;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($posts = mysqli_fetch_assoc($result)) {
                ?>
                <div class="postCard">
                    <div class="d-flex justify-content-between align-items-center" style="font-size: 20px;">
                        <div class="text-center flex-grow-1">Edit Post</div>
                        <a href="index.php"><button type="button" class="btn-close" aria-label="Close"></button></a>
                    </div>
                    
                    <hr>
                    <div class="header d-flex align-items-center mb-3">
                        <img src="images/<?php echo $posts['profile'] ?>" alt="User Profile">
                        <div class="ms-2">
                            <h6><?php echo $posts["firstName"] . " " . $posts["lastName"]; ?></h6>
                            <small><?php echo isset($posts['dateTime']) ? date("M j, Y", strtotime($posts['dateTime'])) : "Date not available"; ?></small>
                        </div>
                    </div>
                    <div class="content">
                        <form method="post">
                            <textarea name="updatedContent" rows="6"
                                placeholder="What's on your mind?"><?php echo htmlspecialchars(trim($posts['content'])); ?>
                            </textarea>
                            <?php if (!empty($posts['attachment'])): ?>
                                <div class="content-image">
                                    <img src="images/<?php echo $posts['attachment']; ?>" alt="Post Attachment">
                                </div>
                            <?php endif; ?>
                            <div class="card d-flex flex-row mx-auto">
                                <div class="col-5 text-start ps-3">
                                    <a href="index.php" style="text-decoration: none; color:#B0B3B8;">Add to your post</a>
                                </div>
                                <div class="col-7 ps-4">
                                    <div class="editButtons">
                                        <a class="editButtonItem" href=""><img src="images/photos.png"></a>
                                        <a class="editButtonItem" href=""><img src="images/tag.png"></a>
                                        <a class="editButtonItem" href=""><img src="images/feeling.png"></a>
                                        <a class="editButtonItem" href=""><img src="images/location.png"></a>
                                        <a class="editButtonItem" href=""><img src="images/gif.png"></a>
                                        <a class="editButtonItem" href=""><img src="images/live.png"></a>
                                    </div>
                                </div>
                            </div>  
                            <button class="btn btn-primary mt-3" type="submit" name="btnEdit">Save</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>