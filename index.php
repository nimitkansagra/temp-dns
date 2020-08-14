<?php
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span>Your IP : <?php echo getUserIpAddr(); ?></span>
    <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <input type="text" name="domain" placeholder="domain name or ip">
        <select name="record">
            <option value="A">A</option>
            <option value="NS">NS</option>
        </select>
        <button type="submit" name="submit">Search</button>
    </form>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['submit'])) {
                $url = $_POST['domain'];
                $record = $_POST['record'];
                
                //$old_path = getcwd();
                //echo getcwd();
                $str = "sh api.sh '$url' '$record'";
                //echo $str;
                $output = shell_exec($str);
                //chdir($old_path);
                echo "<pre>$output</pre>";
            }
        }
    ?>
</body>
</html>
