<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="board_box">
	    <h3 class="title">
			생활 질문 게시판 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "sample");
	$sql = "select * from board2 where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update board2 set hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
	$sql2 = "select * from members where id='$id'";
	$result2 = mysqli_query($con, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$level = $row2["level"];
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$id?> [lv.<?=$level?>] | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
		<?php
				if ( $id != $userid )
				{	
					?>
					<img src="./img/list.png" onclick="location.href='board_list2.php?page=<?=$page?>'">&nbsp;
					<img src="./img/reply.png" onclick="location.href='message_form.php?rv_id=<?=$id?>&subject=<?=$subject?>'">
					<?php
					exit;
				}
				else{
					?>
					<img src="./img/list.png" onclick="location.href='board_list2.php?page=<?=$page?>'">&nbsp;
					<img src="./img/edit1.png" onclick="location.href='board_modify_form2.php?num=<?=$num?>&page=<?=$page?>'">
					<img src="./img/trash.png" onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">
					
					
					<?php
					exit;
				}
			?>
		</ul>
	</div> <!-- board_box -->
</section> 
</body>
</html>
