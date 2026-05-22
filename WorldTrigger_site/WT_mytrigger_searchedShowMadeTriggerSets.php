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
            <h2>ワールドトリガー　トリガー</h2>  
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
            <h3>このサイトで作成されたトリガーセットを閲覧できます。</h3>
            <form method="post" action="WT_mytrigger_showMadeTriggerSets.php">
                <input type="submit" value="すべてを表示">
            </form>
            <form method="post" action="WT_mytrigger_searchedShowMadeTriggerSets.php">
                <p class="Bcolor">検索</p><br>
                <p class="Bcolor">ユーザネーム：</p>
                <input name="user_name" type="text" style="width:160px"><br>
                <input type="submit" value="検索する">
            </form>
            <br>
            <?php
                $user_name=$_POST['user_name'];

                $dsn='mysql:dbname=if0_41952283_worldtrigger; host=sql213.infinityfree.com';
                $user='if0_41952283';
                $password='Konami55Sougetu';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->query('set names utf8');

                function showTriggerName($id)
                {
                    global $dbh;
                    $sql='select name from triggers where id='.$id;
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();

                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    return $rec['name'];
                }

                $sql='select * from user_trigger_sets where user_name= ?';
                $stmt=$dbh->prepare($sql);
                $stmt->execute([$user_name]);

                while(true)
                {
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec==false)
                        break;
                    echo "<h4>".$rec['user_name']."</h4><br>";
                    echo '<p class="Bcolor">メイントリガー：';
                    echo showTriggerName($rec['trigger1']).' , '.showTriggerName($rec['trigger2']).' , '.showTriggerName($rec['trigger3']).' , '.showTriggerName($rec['trigger4']);
                    echo "</p><br>";
                    echo '<p class="Bcolor">サブトリガー　：';
                    echo showTriggerName($rec['trigger5']).' , '.showTriggerName($rec['trigger6']).' , '.showTriggerName($rec['trigger7']).' , '.showTriggerName($rec['trigger8']);
                    echo '</p><br><br>';
                }
                $dbh=null;
            ?>
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>