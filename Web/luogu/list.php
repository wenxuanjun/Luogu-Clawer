<?php
require_once("mysql.php");
function write($i,$page){
    if ($i == $page)
        echo '<li class="page-item active"><a class="page-link" href="index.html?page='.$i.'">'.$i.'</a></li>';
    else
        echo '<li class="page-item"><a class="page-link" href="index.html?page='.$i.'">'.$i.'</a></li>';
}
$page = $_GET["page"];
$page = intval($page);
echo <<<LABEL
<div align="center">
<div class="input-group" style="width:30%">
<input type="text" class="form-control" id="sendin" placeholder="请输入题号">
<div class="input-group-append">
<button class="btn btn-primary" onclick="window.location.href='luogu/index.html?go='+document.getElementById('sendin').value;" type="button">传送到题目！</button>   
</div>
</div>
</div>
LABEL;
for ($i = 1000+15*($page-1);$i < 1000+15*($page);$i++) {
    if ($i > 4954)
        continue;
    $data=getsql($i);
    echo '<a href="luogu/index.php?go=P'.$i.'">'.$data["title"].'</a><br/>'."\n";
}
echo <<<LABEL
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
LABEL;
if ($page > 1){
    echo '<li class="page-item">';
    echo '<a class="page-link" href="index.html?page='.($page-1).'" aria-label="Previous">';
    echo <<<LABEL
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
LABEL;
}
if ($page >= 1 && $page < 6)
    for ($i = 1;$i <= $page+5;$i++)
        write($i,$page);
if ($page >= 6 && $page <= 258)
    for ($i = $page-5;$i <= $page+5;$i++)
        write($i,$page);
if ($page > 258 && $page <= 264)
    for ($i = $page-5;$i <= 264;$i++)
        write($i,$page);
if ($page < 264){
    echo '<li class="page-item">';
    echo '<a class="page-link" href="index.html?page='.($page+1).'" aria-label="Next">';
    echo <<<LABEL
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
LABEL;
}
echo <<<LABEL
  </ul>
</nav>
LABEL;
?>
