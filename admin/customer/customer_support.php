<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./customer_support.css">
    <style>
        .content-status {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
        .status-customer {
            display: block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: green;
            margin-right: 5px;
        }
        .status-customer.offline {
            background-color: red;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <?php
    include('../../config/config.php');
    include('../includes/header.php');
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    ?>
    <!-- container-support -->
    <?php
    require_once('../../config/config.php');
    // lấy ra id khách hàng và admin
    $CusId = $_REQUEST["CusId"];
    $UserId = $_SESSION['UserId'];

    // lấy thông tin khách hàng
    $sql_customer = "select * from customer where CusId = $CusId";
    $result_customer = mysqli_query($connection, $sql_customer);
    $data_customer = mysqli_fetch_assoc($result_customer);

    ?>
    <div class="container-chatbox">
        <div class="chatbox">
            <div class="chat-header">
                <div class="profile">
                    <div class="profile-avatar">
                        <img src="../../clients/upload/<?= $data_customer["CusImage"] ?>">
                    </div>
                    <div class="profile-info">
                        <h2><?= $data_customer["CusUserName"] ?></h2>
                        <?php if (isset($_SESSION['cusid']) && $_SESSION['cusid'] == $data_customer["CusId"]) { ?>
                            <div class="content-status">
                                <span class="online status-customer"></span>
                                <p>Online</p>
                            </div>
                        <?php   } else { ?>
                            <div class="content-status">
                                <span class="offline status-customer"></span>
                                <p>Offline</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="chat-messages">
            </div>
            <form method="post" action="./customer_support_sending.php?userID=<?php echo $CusId ?>" class="input-box">
                <input class="input_mess" type="text" name="textmessage" placeholder="Type a message...">
                <input type="submit" value="Gửi">
            </form>
        </div>
    </div>
    <script>
        function getNewMessages() {
            var xhr = new XMLHttpRequest();
            var url = "./customer_new_message.php?userID=<?php echo $ReceverID ?>"
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var chatMessages = document.querySelector('.chat-messages');
                    var newMessages = JSON.parse(this.responseText);
                    newMessages.reverse();

                    // Clear the chat box before appending new messages
                    chatMessages.innerHTML = '';

                    for (var i = 0; i < newMessages.length; i++) {
                        var message = newMessages[i];
                        var isFromMe = (message.my_id == <?php echo $my_userID ?>);
                        var messageElement = document.createElement('div');
                        messageElement.classList.add('message');
                        if (isFromMe) {
                            messageElement.classList.add('message-sender');
                        }
                        var messageText = document.createElement('p');
                        messageText.innerText = message.message;
                        messageElement.appendChild(messageText);
                        chatMessages.appendChild(messageElement);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }
            };
            xhr.send();
        }

        setInterval(getNewMessages, 1000);


        window.onload = () => {
            document.querySelector(".input_mess").focus(),
                document.querySelector(".chat-messages").scrollTop = document.querySelector(".chat-messages").scrollHeight;
        }
    </script>

    <?php
    include_once('../includes/footer.php')
    ?>

</body>

</html>