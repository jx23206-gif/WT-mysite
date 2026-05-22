<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ワールドトリガー　トリガー設定サイト</title>
	    <link rel="stylesheet" type="text/css" href="WT_mycss.css">
    </head>
    <body>
        <header>
            <div class="hamburger">&#9776</div>
            <h2>ワールドトリガー　トリガーセット完了</h2>  
        </header>
        <nav class="ham_nav">
            <ul id="#">
		        <li><a href="WT_mytrigger_home.html">ホーム</a></li>
                <li><a href="WT_mytrigger_introduction.html">ワールドトリガーとは</a></li>
                <li><a href="WT_mytrigger_triggers.php">トリガー一覧</a></li>
                <li><a href="WT_mytrigger_setTrigger.php">自分専用のトリガーを構成する</a></li>
                <li><a href="WT_mytrigger_showMadeTriggerSets.php">作成されたトリガー構成を見る</a></li>
                <li><a href="WT_mytrigger_showOfficalTriggerSets.php">ワールドトリガーの隊員のトリガー構成を見る</a></li>
            </ul>
        </nav>
        <div class="content">
            <?php
                $user_name = $_POST['user_name'];
                $trigger1 = $_POST['trigger1'];
                $trigger2 = $_POST['trigger2'];
                $trigger3 = $_POST['trigger3'];
                $trigger4 = $_POST['trigger4'];
                $trigger5 = $_POST['trigger5'];
                $trigger6 = $_POST['trigger6'];
                $trigger7 = $_POST['trigger7'];
                $trigger8 = $_POST['trigger8'];

                $dsn='mysql:dbname=if0_41952283_worldtrigger; host=sql213.infinityfree.com';
                $user='if0_41952283';
                $password='Konami55Sougetu';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->query('set names utf8');

                $sql = 'insert into user_trigger_sets(user_name, trigger1, trigger2, trigger3, trigger4, trigger5, trigger6, trigger7, trigger8) 
                        value("'.$user_name.'", "'.$trigger1.'", "'.$trigger2.'", "'.$trigger3.'", "'.$trigger4.'", "'.$trigger5.'", "'.$trigger6.'", "'.$trigger7.'", "'.$trigger8.'")';
                $stmt=$dbh->prepare($sql);
                $stmt->execute();

                $dbh=null;
            ?>

            <h3>作成完了</h3><br><br>
            <img src="images/トリガーホルダー.png" alt="トリガーホルダーのイメージ画像" class="trigger_holder"><br>
            <p class="Bcolor"><a href="WT_mytrigger_home.html">ホーム</a></p><br>
            <p class="Bcolor"><a href="WT_mytrigger_showMadeTriggerSets.php">自分のつくったトリガー構成を見る</a></p>
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>