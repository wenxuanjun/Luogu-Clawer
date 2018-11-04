<?php
$go = $_GET["go"];
require_once("mysql.php");
$getgo = substr($go,1);
$getgo = intval($getgo);
$data=getsql($getgo);
echo <<<LABEL
<!DOCTYPE html>
<html lang="en">
<head>
LABEL;
echo "<title>".$title."</title>";
require_once("head.php");
echo '<body>';
echo '<div class="container" style="margin-top:30px">';
echo '<div align="center" class="title">'."<h1>".$data["title"]."</h1>"."</div>";
echo '<div align="center">';
echo '<span class="badge badge-secondary" style="font-size:15px;margin:10px;">'."题目难度：".$data["diff"]."</span>";
echo '<span class="badge badge-secondary" style="font-size:15px;margin:10px;">'."时空限制：".$data["limi"]."</span>";
echo "</div>";
echo '<div class="container" style="margin-top:30px">';
echo '<div class="btn-group" role="group" aria-label="Basic example" style="margin-bottom:20px">';
echo '<a class="btn btn-primary" style="width:100px" href="https://www.luogu.org/problemnew/show/'.$getgo.'#sub">提交</a>';
echo '<a class="btn btn-success" style="width:100px" href="https://www.luogu.org/recordnew/lists?pid='.$getgo.'">提交记录</a>';
echo '<a class="btn btn-danger" style="width:100px" href="https://www.luogu.org/discuss/lists?forumname=P'.$getgo.'">讨论</a>';
echo '</div>';
echo '<div class="card raised">';
echo $data["passage"];
if($data["stdcode"]!=""){
    echo '<p></p>';
    echo "<h2>标程</h2>";
    echo $data["stdcode"];
}
echo "</div>";
echo "</div>";
echo "</div>";
echo <<<LABEL
</body>
</html>
LABEL;
?>