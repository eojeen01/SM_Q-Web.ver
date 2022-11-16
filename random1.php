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

<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

    
	$con = mysqli_connect("localhost", "root", "", "sample");
	$sql = "select * from board1 order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수
    
    $num = rand(1, $total_record)-1;
    $sql = "select * from board1 order by num desc limit $num, 1";
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
	$sql = "update board1 set hit=$new_hit where num=$num";   
    mysqli_query($con, $sql);
?>
        <div id="board_box">
	    <h3 class="title">
			과목 질문 게시판 > 내용보기
		</h3>
        <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$id?> | <?=$regist_day?></span>
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
					<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
					<li><button onclick="location.href='message_form.php'">답변하기</button></li>
					<?php
					exit;
				}
				else{
					?>
					<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
					<li><button onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
					<li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
					
					<?php
					exit;
				}
                ?>
		</ul>
    </div> <!-- board_box -->
</body>
</html>
