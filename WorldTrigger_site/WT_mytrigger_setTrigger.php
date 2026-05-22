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
            <h2>ワールドトリガー　トリガー選択</h2>  
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
                $dsn='mysql:dbname=if0_41952283_worldtrigger; host=sql213.infinityfree.com';
                $user='if0_41952283';
                $password='Konami55Sougetu';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->query('set names utf8');

                function triggerSet($slot)
                {
                    global $dbh;
                    $sql='select id, name from triggers';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();

                    echo '<select name="'.$slot.'">';
                    while(true)
                    {
                        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                        if($rec==false)
                            break;
                        echo '<option value="'.$rec["id"].'">'.$rec["name"].'</option>';
                    }
                    echo '</select>';
                }
            ?>
            <h3>トリガーホルダーに8つのトリガーをセットしよう！</h3><br>
            <form method="post" action="WT_mytrigger_setTriggerCheck.php">
                <div class="name">
                    <p class="Bcolor">ユーザネーム：</p>
                    <input name="user_name" type="text" style="width:160px"><br>
                </div>
                <br>
                <div class="trigger_set">
                    <div class="left_hand Bcolor">
                        <p class="bor">サブトリガー（左手）</p><br>
                        <?php triggerSet("trigger5"); ?><br>
                        <?php triggerSet("trigger6"); ?><br>
                        <?php triggerSet("trigger7"); ?><br>
                        <?php triggerSet("trigger8"); ?><br>
                    </div>
                    <div class="right_hand Bcolor">
                        <p class="bor">メイントリガー（右手）</p><br>
                        <?php triggerSet("trigger1"); ?><br>
                        <?php triggerSet("trigger2"); ?><br>
                        <?php triggerSet("trigger3"); ?><br>
                        <?php triggerSet("trigger4"); ?><br>
                    </div>
                </div>
                <br>
                <input type="submit" value="決定">
            </form>
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>