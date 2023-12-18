<style>
    .allUsersList {
        width: 350px;
        margin: 20px;
    }

    .allUsersList .card-header {
        background: #683db8;
        color: #FFF;
        padding: 10px;

    }

    .allUsersList .image img {
        border-radius: 16px;
    }

    .usersChatList {
        position: absolute;
        width: 250px;
        bottom: 0;
        margin-bottom: 0;
        right: 360px;
    }

    .show {
        display: block;
    }

    .thumb-user-list {
        display: none;
    }

    .thumb-user-list .image img {
        border-radius: 30px;
    }

    .usersChatList .card-header {
        background: #683db8;
        font-size: 13px;
    }

    .chatBox {
        position: fixed;
        display: none;
        top: 29%;
        right: 0%;
        width: 300px;
        margin: 40px;
        margin-bottom: 0;
        font-size: 13px;
    }

    .chat-content {
        overflow: auto;
        height: 300px;
    }

    .chatBox .card {
        border-radius: 4px;
    }

    .chatBox .card-header {
        align-items: center;
        display: flex;
        background: #683db8;
    }

    .header-title {
        height: 50px;
    }

    .card-header-title i {
        font-size: 10px;
        color: #32e4cd;
        flex: 1;
        margin-right: 6px;
    }

    .card-header .card-header-title {
        color: #FFF;
        display: flex;
        align-items: center;
    }

    .chat-content small {
        margin: 0;
    }

    .chat-content p {
        background: #ecf1f8;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 0;
    }

    .my-content .media-content {
        width: 80%;
    }

    .my-content .message {
        float: right;
        background: #683db8;
        color: #FFF;
        text-align: right;
        padding: 10px;
        margin-bottom: 4px;
        font-size: 13px;
    }

    .my-content .chat-content small {
        float: right;
    }

    .my-content small {
        display: block;
        float: right;
        width: 100%;
        text-align: right;
    }

    .chat-textarea {
        font-size: 14px;
        padding: 8px;
        height: 40px;
        width: 100%;
        border: none;
        overflow: auto;
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        resize: none;
    }

    .chat-message-group {
        margin-top: 10px;
    }

    .chat-message-group .chat-thumb {
        float: left;
        width: 15%;
    }

    .chat-message-group .chat-messages {
        float: left;
        width: 85%;
        margin-bottom: 20px;
    }

    .chat-message-group .message {
        float: left;
        padding: 10px;
        background: #ecf1f8;
        font-size: 13px;
        border-radius: 5px;
        margin-bottom: 3px;
    }

    .chat-messages .from {
        float: left;
        display: block;
        width: 100%;
        text-align: left;
        font-size: 11px;
    }

    .chat-thumb img {
        border-radius: 40px;
    }

    .writer-user .chat-messages {
        float: right;
        width: 100%;
    }

    .writer-user .chat-messages .message {
        float: right;
        background: #683db8;
        color: #FFF;
    }

    .writer-user .chat-messages .from {
        float: left;
        display: block;
        width: 100%;
        text-align: right;
    }

    .chat-message-group .typing {
        float: left;
    }

    .chatBox .card-header-icon i {
        color: #FFF;
        font-size: 13px;
    }

    /* CSSS */
    .outside-box {
        height: 100px;
        background: #F8C;
        width: 200px;
        margin: 20px;
        overflow: auto;
    }

    .outside-box .content-insider {
        height: 300px;
        background: #C9C;
    }

    /* CSS Spinner */
    .spinner {
        margin: 0 30px;
        width: 70px;
        text-align: center;
    }

    .spinner>div {
        width: 4px;
        height: 4px;
        background-color: #888;

        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }

    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    @-webkit-keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0)
        }

        40% {
            -webkit-transform: scale(1.0)
        }
    }

    @keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
        }
    }

    /* EmojiBox */
    .emojiBox {
        width: 150px;
        margin: 30px;
    }

    .emojiBox .box {
        height: 100px;
        padding: 4px;
    }

    /* */
    .card-header-title img {
        border-radius: 40px;
    }

    .card-header-title {
        flex: 1;
    }

    .mess-back i {
        color: #fff;
    }

    .card-footer {
        display: flex;
        align-items: center;
    }

    .input-message {
        flex: 1;
    }

    .submit-message input {
        border: none;
        outline: none;
    }

    .admin-status {
        display: flex;
        flex-direction: column;
        margin-left: 10px;
    }
</style>

<?php
// session_start();
if (isset($_SESSION['UserId'])) {
    $UserId = $_SESSION['UserId'];
    $CusId = $_SESSION['cusid'];
    require_once('../../config/config.php');
    $sqlAdminSupport = "SELECT * FROM user where UserId = $UserId";
    $result = $connection->query($sqlAdminSupport);
    $dataAdmin = $result->fetch_assoc();



    $sql_chat_data = "SELECT * FROM messages WHERE CusId = $CusId AND UserId = $UserId";
    $result_chat_data = mysqli_query($connection, $sql_chat_data);

    // Sử dụng MYSQLI_ASSOC để lấy key là tên trường
    $chatdata = mysqli_fetch_all($result_chat_data, MYSQLI_ASSOC);

    echo '<pre>';
    // var_dump($chatdata);
    echo '</pre>';
}



?>
<?php
if (isset($_SESSION['UserId'])) { ?>
    <div id="chatApp">
        <div class="chatBox" id="chatBox">
            <div class="card">
                <header class="card-header header-title" @click="toggleChat()">
                    <div class="card-header-title">
                        <img src="../../admin/upload/<?php echo $dataAdmin["UserImage"] ?>" style="width: 35px;">
                        <div class="admin-status">
                            <div class="name-admin"><?php echo $dataAdmin["UserName"] ?></div>
                            <i class="fa fa-circle is-online"></i>
                        </div>
                    </div>
                    <div class="mess-back">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </header>
                <div id="chatbox-area">
                    <div class="card-content chat-content">
                        <div class="content">
                            <?php
                            for ($i = 0; $i < count($chatdata); $i++) {
                                $is_from_me = ($chatdata[$i]["WriteId"] == $CusId);
                            ?>
                                <div class="chat-message-group <?= $is_from_me ? "writer-user" : "" ?>">
                                    <div class="chat-messages">
                                        <div class="message"><?= $chatdata[$i]["message"] ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <form class="card-footer" method="post" action="../includes/customer_support_sending.php" id="chatBox-textbox">
                        <div class="input-message">
                            <input id="chatTextarea" name="textmessage" class="chat-textarea" placeholder="Enter message..."></input>
                        </div>
                        <div class="submit-message">
                            <input class="" type="submit" value="send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php   }
?>


<script>
    var firebaseApp = firebase.initializeApp({
        apiKey: "AIzaSyC4cGXqwHlZC1iv9ZjeXaNqyzI-kMh7y6Y",
        authDomain: "kupidochat-bd3c5.firebaseapp.com",
        databaseURL: "https://kupidochat-bd3c5.firebaseio.com",
        storageBucket: "kupidochat-bd3c5.appspot.com",
        messagingSenderId: "972492700679"
    });

    var db = firebaseApp.database();

    var chatApp = db.ref('chatApp'); //chatApp

    var dirRef = chatApp.child('directory');
    var chatRef = chatApp.child('chats');
    var userRef = chatApp.child('users');


    var app = new Vue({
        el: '#chatApp',
        firebase: {
            directory: dirRef
        },
        data: {
            headUser: 'Marinho Gomes',
            showChatList: false,
            chatBoxArea: true,
            currentChats: []
        },
        methods: {
            showUsuario: function(id) {
                console.log(id);
            },
            expandTextArea: function() {
                $('#chatBox-textbox').height(80);
                $('#chatTextarea').height(60);
            },
            dexpandTetArea: function() {
                $('#chatBox-textbox').height(60);
                $('#chatTextarea').height(40);
            },
            toggleChat: function() {
                if (this.chatBoxArea) {
                    $('#chatbox-area').hide();
                } else {
                    $('#chatbox-area').show();
                }
                this.chatBoxArea = !this.chatBoxArea;
            },
            openChatBox: function(info) {

            },
            startChat: function(user) {

            },
            expandChatList: function() {
                $("#userListBox").slideToggle();
                this.showChatList = !this.showChatList;

            }
        }
    })
</script>