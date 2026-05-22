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
            <h2>ワールドトリガー　トリガー一覧</h2>  
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
            <h3>このサイトで選べるトリガー一覧です</h3><br><br>
            <?php
                $dsn='mysql:dbname=if0_41952283_worldtrigger; host=sql213.infinityfree.com';
                $user='if0_41952283';
                $password='Konami55Sougetu';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->query('set names utf8');

                function showTriggers($trigger_type)
                {
                    global $dbh;
                    $sql='select * from triggers where type= ?';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute([$trigger_type]);

                    while(true)
                    {
                        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                        if($rec==false)
                            break;
                        if($rec['id']==0)
                            continue;
                        echo '<p class="Bcolor">'.$rec['name'].' : '.$rec['説明'].'</p>';
                        echo '<br>';
                    }
                }

                $trigger_types =["アタッカー用トリガー", "ガンナー用トリガー", "スナイパー用トリガー", "防御用トリガー", "オプショントリガー"];

                foreach($trigger_types as $Ttype)
                {
                    echo "<h4>".$Ttype."</h4><br>";
                    showTriggers($Ttype);
                    echo "<br>";
                }
                $dbh=null;
            ?>
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>