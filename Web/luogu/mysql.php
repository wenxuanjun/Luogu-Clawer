<?php
function getsql($go) {
    //这里是需要改的地方
    //数据库地址
    $servername = "localhost";
    //数据库用户名
    $username = "luogu";
    //数据库密码
    $password = "password";
    //数据库名
    $dbname = "luogu";
    
    $idgo = $go-999;
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $result = mysqli_query($con,"SELECT * FROM luogu WHERE id=$idgo");
    while ($row = mysqli_fetch_array($result)) {
        $title = $row["title"];
        $diff = $row["diff"];
        $limi = $row["limi"];
        $passage = $row["passage"];
        $stdcode = $row["stdcode"];
    }
    mysqli_close($con);
    $data = array("title"=>$title,"diff"=>$diff,"limi"=>$limi,"passage"=>$passage,"stdcode"=>$stdcode);
    return $data;
}
?>
