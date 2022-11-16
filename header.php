
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
            <div id="logo">
             
                <a href="index.php">
                <img src="./img/logo_s.png">
                </a>
             
            </div>
            
            
            <ul id="top_menu">  
<?php
    if(!$userid) {
?>                
            <div id="menu_bar">
            <ul>  
                <li><a href="login_form.php">로그인</a></li>&nbsp;
                <li><a href="member_form.php">회원가입</a></li> &nbsp;          
                <li><a href="board_list.php">과목 질문 게시판</a></li>&nbsp;
                <li><a href="board_list2.php">생활 질문 게시판</a></li>
            </ul>
            </div>
<?php
    } else {
        ?>
        <h3>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php
             $con = mysqli_connect("localhost", "root", "", "sample");
             $sql = "select * from members where id='$userid'";
             $result = mysqli_query($con, $sql);
             $row = mysqli_fetch_array($result);
             $userlevel = $row["level"];
	         $userpoint = $row["point"];
             if($row["point"]>=20){
                $sql = "update members set level=9 where id='$userid'";
                mysqli_query($con, $sql);
            }
            if($row["point"]>=100){
                $sql = "update members set level=8 where id='$userid'";
                mysqli_query($con, $sql);
            }
            if($row["point"]>=300){
                $sql = "update members set level=7 where id='$userid'";
                mysqli_query($con, $sql);
            }
            if($row["point"]>=600){
                $sql = "update members set level=6 where id='$userid'";
                mysqli_query($con, $sql);
            }
            if($row["point"]>=1000){
                $sql = "update members set level=5 where id='$userid'";
                mysqli_query($con, $sql);
            }
            //관리자
            if($row["point"]>=1000000000){
                $sql = "update members set level=1 where id='$userid'";
                mysqli_query($con, $sql);
            }
             ?>
             <?=$logged = $userid."님[Level:".$userlevel.", Point:".$userpoint."]";?>&nbsp;
            
             <?php
            if($userlevel==1) {
            ?>
                <a href="admin.php">[관리자 모드]</a>
            <?php
            }
            ?>&nbsp;
             <img src="./img/control1.png" onclick="location.href='member_modify_form.php'"></img>&nbsp;
            <img src="./img/logout.png" onclick="location.href='logout.php'"></img>
            <br>
            </h3>
        <div id="menu_bar">
        <ul>  
            <li><a href="board_list.php">과목 질문 게시판</a></li>&nbsp;
            <li><a href="board_list2.php">생활 질문 게시판</a></li>&nbsp;&nbsp;
            <li><a href="message_box.php?mode=rv">수신 쪽지함</a></li>         
            <li><a href="message_box.php?mode=send">송신 쪽지함</a></li>                 
        </ul>
        
    <?php
    }
    ?>
    </div>
        