<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
<script>
  function check_input() {
    //   if (!document.message_form.subject.value)
    //   {
    //       alert("제목을 입력하세요!");
    //       document.message_form.subject.focus();
    //       return;
    //   }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<?php
	$rv_id = $_GET["rv_id"];	
	$subject = $_GET["subject"];
	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>
<section>
   	<div id="message_box">
	    <h3 id="write_title">
	    		답변 쪽지 보내기
		</h3>
		<ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
				<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
		</ul>
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>&rv_id=<?=$rv_id?>&subject=<?=$subject?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<?php
						$con = mysqli_connect("localhost", "root", "", "sample");
						$sql2 = "select * from members where id='$userid'";
						$result2 = mysqli_query($con, $sql2);
						$row2 = mysqli_fetch_array($result2);
						$level = $row2["level"];
					?>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?> [lv.<?=$level?>]</span>
				</li>	
				<li>
				<?php
						$sql3 = "select * from members where id='$rv_id'";
						$result3 = mysqli_query($con, $sql3);
						$row3 = mysqli_fetch_array($result3);
						$level2 = $row3["level"];
						mysqli_close($con);

					?>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?=$rv_id?> [lv.<?=$level2?>]</span>
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2">RE : <?=$subject?></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">보내기</button>
	    	</div>	    	
	    </form>
	</div> <!-- message_box -->
</section> 
</body>
</html>
