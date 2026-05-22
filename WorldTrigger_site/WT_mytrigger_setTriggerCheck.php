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
            <h3>選択したトリガー</h3><br>
            <?php
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

                $user_name = $_POST['user_name'];
                $trigger1 = $_POST['trigger1'];
                $trigger2 = $_POST['trigger2'];
                $trigger3 = $_POST['trigger3'];
                $trigger4 = $_POST['trigger4'];
                $trigger5 = $_POST['trigger5'];
                $trigger6 = $_POST['trigger6'];
                $trigger7 = $_POST['trigger7'];
                $trigger8 = $_POST['trigger8'];

                if($user_name=='')
                {
                    print '<p class="Bcolor">ユーザネームが入力されていません。ユーザネームを入力してください。</p><br>';
                    print '<form method="post" action="WT_mytrigger_setTrigger.php">';
                    print '<input type="button" onclick="history.back()" value="戻る">';
                    print '</form>';
                }
                else
                {
                    echo '<div class="name">';
                    echo '<p class="Bcolor">ユーザネーム：'.$user_name;
                    echo '</p><br><br>';
                    echo '</div>';
                    echo '<div class="trigger_set">';
                    echo '<div class="left_hand Bcolor">';
                    echo '<p class="bor">サブトリガー（左手）</p><br>';
                    echo showTriggerName($trigger5).'<br>'.showTriggerName($trigger6).'<br>'.showTriggerName($trigger7).'<br>'.showTriggerName($trigger8).'<br>';
                    echo '</div>';
                    echo '<div class="right_hand Bcolor">';
                    echo '<p class="bor">メイントリガー（右手）</p><br>';
                    echo showTriggerName($trigger1).'<br>'.showTriggerName($trigger2).'<br>'.showTriggerName($trigger3).'<br>'.showTriggerName($trigger4).'<br>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br>';

                    print '<form method="post" action="WT_mytrigger_setTriggerDone.php">';
                    print '<input name="user_name" type="hidden" value="'.$user_name.'">';
                    print '<input name="trigger1" type="hidden" value="'.$trigger1.'">';
                    print '<input name="trigger2" type="hidden" value="'.$trigger2.'">';
                    print '<input name="trigger3" type="hidden" value="'.$trigger3.'">';
                    print '<input name="trigger4" type="hidden" value="'.$trigger4.'">';
                    print '<input name="trigger5" type="hidden" value="'.$trigger5.'">';
                    print '<input name="trigger6" type="hidden" value="'.$trigger6.'">';
                    print '<input name="trigger7" type="hidden" value="'.$trigger7.'">';
                    print '<input name="trigger8" type="hidden" value="'.$trigger8.'">';
                    print '<input type="button" onclick="history.back()" value="戻る">';
                    print '<input type="submit" value="確定">';
                    print '</form>';
                }
            ?>
            
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>