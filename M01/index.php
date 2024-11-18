<?php
include("connect.php");

if(isset($_POST['btnPost'])){
  $woym = $_POST['woym'];

  $postQuery = "INSERT INTO posts (userID, profile, dateTime, content) VALUES ('13', 'daniel.jpg', NOW(), '$woym')";
  executeQuery($postQuery); 

  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

$query = "SELECT * FROM posts LEFT JOIN userInfo ON posts.userID = userInfo.userID ORDER BY posts.dateTime";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facebook</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="icon" href="images/fbLogo.png">
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #18191A;
    }

    .searchBar {
      background-color: #3a3b3c;
      color: white;
      border: none;
      height: 40px;
      padding-left: 20px;
      padding-bottom: 10px;
      width: 240px;
    }

    .navbar {
      background-color: #242526;
      position: fixed;
      width: 100%;
    }

    .navButtonsCenter {
      display: flex;
      justify-content: center;
      width: 100%;
      gap: 5px;
    }

    .navButtonCenter {
      background-color: #242526;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: background-color 0.3s ease;
      max-width: 110px;
      flex-grow: 1;
      height: 40px;
      width: 40px;
      border-radius: 10px;
    }

    .navButtonCenter img {
      width: 30px;
      height: 30px;
      object-fit: contain;
    }

    .navButtonCenter:hover {
      background-color: #4e4f50;
    }

    .navButtonsRight {
      display: flex;
      gap: 5px;
      align-items: center;
    }

    .navButtonRight {
      background-color: #3a3b3c;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: background-color 0.3s ease;
    }

    .navButtonRight:hover {
      background-color: #4e4f50;
    }

    .navButtonRight img {
      width: 24px;
      height: 24px;
      object-fit: contain;
      border-radius: 50%;
    }

    .profileIcon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .leftSideBar {
      background-color: #18191A;
      padding-top: 15px;
      padding-left: 5px;
    }

    .leftSideBar button {
      background-color: #18191A;
      border: none;
      border-radius: 5px;
      width: 290px;
      height: 42px;
      margin-bottom: 5px;
    }

    .rightSideBar {
      background-color: #18191A;
      padding-top: 15px;
      padding-left: 20px;
    }

    .rightSideBar button {
      background-color: #18191A;
      border: none;
      border-radius: 5px;
      width: 100%;
      max-width: 290px;
      height: 42px;
      margin-left: 10px;
      margin-bottom: 5px;
    }

    .rightSideBar h6 {
      color: white;
      margin-left: 22px;
    }

    .postCard {
      border-radius: 10px;
      background-color: #242526;
      color: white;
    }

    .wymCard {
      border-radius: 10px;
      background-color: #242526;
      color: white;
    }

    .btn {
      color: white;
      background-color: #242526;
      outline: none;
      border-radius: 5px;
      border: none;
    }

    .btn:hover {
      background-color: #3a3b3c;
    }

    .form-control::placeholder {
      color: #B0B3B8;
    }
  </style>
</head>

<body>
  <nav class="navbar shadow">
    <div class="container-fluid">
      <div class="col-3 d-flex px-1 justify-content">
        <a class="logoBtn" href="index.php"><img src="images/fbLogo.png" alt="Logo" width="40" height="40"
            class="d-inline-block align-text-top"></a>
        <div class="d-none d-xl-block">
          <input class="searchBar form-control rounded-pill ms-2" type="search" placeholder="Search Facebook"
            aria-label="Search">
        </div>
      </div>

      <div class="col-6 col-sm-0 d-flex d-none d-md-block">
        <div class="navButtonsCenter">
          <div class="navButtonCenter">
            <a href="index.php"><img src="images/home.png" alt="Home"></a>
          </div>
          <div class="navButtonCenter">
            <a href="index.php"><img src="images/video.png" alt="Video"></a>
          </div>
          <div class="navButtonCenter">
            <a href="index.php"><img src="images/marketPlace.png" alt="MarketPlace"></a>
          </div>
          <div class="navButtonCenter">
            <a href="index.php"><img src="images/groups.png" alt="Groups"></a>
          </div>
          <div class="navButtonCenter">
            <a href="index.php"><img src="images/gaming.png" alt="Gaming"></a>
          </div>
        </div>
      </div>

      <div class="col-3 d-flex justify-content-end">
        <div class="navButtonsRight">
          <div class="navButtonRight">
            <a href="index.php"><img src="images/menu.png" alt="Menu"></a>
          </div>
          <div class="navButtonRight">
            <a href="index.php"><img src="images/messenger.png" alt="Messenger"></a>
          </div>
          <div class="navButtonRight">
            <a href="index.php"><img src="images/notification.png" alt="Notification"></a>
          </div>
          <div class="navButtonRight profileIcon">
            <a href="index.php"><img src="images/profile.jpg" alt="Profile"></a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-3 col-md-0 leftSideBar d-none d-xl-block mt-5">
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/profile.jpg" alt="Profile Icon" width="30" height="30" class="rounded-pill me-2">
          Daniel Melitante
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/friend.png" alt="Friends" width="30" height="30" class="me-2">
          Friends
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/saved.png" alt="Saved" width="30" height="30" class="me-2">
          Saved
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/memories.png" alt="Memories" width="30" height="30" class="me-2">
          Memories
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/group.png" alt="Groups" width="30" height="30" class="me-2">
          Groups
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/videos.png" alt="Video" width="30" height="30" class="me-2">
          Video
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/marketplace (2).png" alt="Marketplace" width="30" height="30" class="me-2">
          Marketplace
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/feed.png" alt="Feeds" width="30" height="30" class="me-2">
          Feeds
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/events.png" alt="Events" width="30" height="30" class="me-2">
          Events
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/birthdays.png" alt="Ads Manager" width="30" height="30" class="me-2">
          Birthdays
        </button>
        <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
          <img src="images/seeMore.png" alt="See more" width="30" height="30" class="me-2">
          See more
        </button>
      </div>

      <div class="col-12 col-xl-6 col-lg-8 col-md-12 pt-3 d-flex justify-content-center">
        <div>
          <div class="wymCard p-3 mt-5 mb-4" style="width: 100%; max-width: 500px; height: 140px;">
            <div class="d-flex align-items-center mb-3">
              <img src="images/profile.jpg" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 15px;">
              <form method="POST" class="w-100">
                <div class="d-flex align-items-center">
                  <input name="woym" type="text" class="form-control" placeholder="What's on your mind?" style="border: none; background-color: #3a3b3c; border-radius: 20px; height: 40px; color: white;">
                  <button class="btn btn-primary" type="submit" name="btnPost" style="border-radius: 5px;">Post</button>
                </div>
              </form>
            </div>
            <hr>
            <div class="d-flex justify-content-center">
              <button class="btn d-flex align-items-center" style="border-radius: 10px; max-width: 100%; width: 175px; height: 40px; max-height: 100%; color: #B0B3B8;">
                <img src="images/live.png" alt="Live video" width="25" height="25" class="me-1">
                Live video
              </button>
              <button class="btn d-flex align-items-center" style="border-radius: 10px; max-width: 100%; width: 175px; height: 40px; max-height: 100%; color: #B0B3B8;">
                <img src="images/photos.png" alt="Photo/Video" width="25" height="25" class="me-1">
                Photo/Video
              </button>
              <button class="btn d-flex align-items-center" style="border-radius: 10px; max-width: 100%; width: 175px; height: 40px; max-height: 100%; color: #B0B3B8;">
                <img src="images/feeling.png" alt="Feeling/Activity" width="25" height="25" class="me-1">
                Feeling/Activity
              </button>
            </div>
          </div>
          <?php
            if (mysqli_num_rows($result)) {
              while ($posts = mysqli_fetch_assoc($result)) {
                if (!empty($posts["content"])) {
                  ?>
                    <div class="postCard rounded-4 shadow-sm my-2" style="width: 100%; max-width: 500px; margin-bottom: 20px;">
                      <div class="card-body">
                        <div class="header d-flex align-items-center mb-3">
                          <img src="images/<?php echo $posts['profile'] ?>" alt="User Profile" width="40" height="40"
                            class="rounded-circle me-2">
                          <div class="flex-grow-1">
                            <h6 class="user name mb-0">
                              <?php echo $posts["firstName"] . " " . $posts["lastName"]; ?>
                            </h6>
                            <small class="timestamp">
                              <?php echo isset($posts['dateTime']) ? date("M j", strtotime($posts['dateTime'])) : "Date not available"; ?>
                            </small>
                          </div>
                        </div>

                        <div class="content my-0">
                          <p class="content-text">
                            <?php echo $posts["content"]; ?>
                          </p>

                        <?php if (!empty($posts['attachment'])): ?>
                          <div class="content-image">
                            <img src="images/<?php echo $posts['attachment']; ?>" alt="Content Image"
                              style="width: 100%; height: auto; object-fit: cover; border-radius: 10px;" />
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="d-flex justify-content-evenly border-top p-2">
                      <button class="btn d-flex justify-content-center align-items-center" style="width: 150px; color:#9A9DA1">
                        <img src="images/like.png" alt="Like" width="20" height="20" class="me-2"> Like
                      </button>
                      <button class="btn d-flex justify-content-center align-items-center" style="width: 150px; color:#9A9DA1">
                        <img src="images/comment.png" alt="Comment" width="20" height="20" class="me-2"> Comment
                      </button>
                      <button class="btn d-flex justify-content-center align-items-center" style="width: 150px; color:#9A9DA1">
                        <img src="images/share.png" alt="Share" width="20" height="20" class="me-2"> Share
                      </button>
                    </div>
                  </div>
                <?php
                }
              }
            }
          ?>
        </div>
      </div>

      <div class="col-3 col-xl-3 col-lg-4 col-md-0 rightSideBar d-none d-lg-block flex-grow-1 mt-5">
        <h6>Contacts</h6>
        <?php

        $query = "SELECT DISTINCT firstName, lastName, profile FROM userInfo LEFT JOIN posts ON userInfo.userID = posts.userID"; 
        $result = mysqli_query($conn, $query); 
        
        while ($userInfo = mysqli_fetch_assoc($result)) { 
          ?>
          <button type="button" class="btn btn-secondary text-start d-flex align-items-center">
            <img src="images/<?php echo $userInfo['profile'] ?>" alt="User Profile" width="30" height="30"
              class="rounded-circle me-2">
            <?php echo $userInfo["firstName"] . " " . $userInfo["lastName"]; ?>
          </button>
          <?php
        } 
        ?>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>