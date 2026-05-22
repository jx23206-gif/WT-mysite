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
            <h3>ワールドトリガーに登場する隊員のトリガーセットを閲覧できます。</h3>
            <?php
                $dsn='mysql:dbname=if0_41952283_worldtrigger; host=sql213.infinityfree.com';
                $user='if0_41952283';
                $password='Konami55Sougetu';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->query('set names utf8');

                function triggerSet($triggers)
                {
                    global $dbh;
                    $sql='select id, name from triggers';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();

                    echo '<select name="'.$triggers.'">';
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
            <form method="post" action="WT_mytrigger_searchedShowOfficalTriggerSets.php">
                <p class="Bcolor">検索</p><br>
                <p class="Bcolor">キャラクター名：</p>
                <input name="user_name" type="text" style="width:100px"><br>
                <p class="Bcolor">隊名：</p>
                <input name="team" type="text" style="width:100px"><br>
                <p class="Bcolor">ポジション：</p>
                <input name="position" type="text" style="width:100px"><br>
                <p class="Bcolor">トリガー：</p>
                <?php triggerSet("trigger"); ?><br>
                <input type="submit" value="検索する">
            </form>
            <br>
            <?php
                function showCharacterData($Cdata, $triggers)
                {
                    echo "<h4>".$Cdata['Cname']."</h4><br>";
                    echo '<p class="Bcolor">'.$Cdata['Cteam'].' '.$Cdata['Cposition']."</p><br>";

                    $maxSlot = ($Cdata['Cname'] === "木崎　レイジ") ? 7 : 4;
                    $Tholder = [];

                    foreach(['right', 'left'] as $side)
                    {
                        for($i = 1; $i <=$maxSlot; $i++)
                        {
                            $Tholder[$side][$i] = "free";
                        }
                    }
                    foreach($triggers as $t)
                    {
                        $Tholder[$t['side']][$t['slot']] = $t['Tri_name'];
                    }

                    foreach(['right', 'left'] as $side)
                    {
                        if($side == 'right')
                        {
                            echo '<p class="Bcolor">メイントリガー：';
                        }
                        if($side == 'left')
                        {
                            echo '<p class="Bcolor">サブトリガー　：';
                        }
                        for($i = 1; $i <$maxSlot; $i++)
                        {
                            echo $Tholder[$side][$i]." , ";
                        }
                        echo $Tholder[$side][$maxSlot]."</p><br>";
                    }
                    echo '<br>';
                }

                $sql =  'SELECT
                            c.id AS Cid,
                            c.name AS Cname,
                            c.team AS Cteam,
                            c.position AS Cposition,

                            ct.side AS Side,
                            ct.slot AS Slot,
                            t.name AS Tri_name

                        FROM characters c

                        LEFT JOIN character_triggers ct ON c.id = ct.character_id
                        LEFT JOIN triggers t ON ct.trigger_id = t.id
                        ORDER BY c.id, ct.side, ct.slot
                        ';
                $stmt=$dbh->prepare($sql);
                $stmt->execute();

                $C_id = null;
                $triggers = [];
                while(true)
                {
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec==false)
                        break;
                    if($C_id !== $rec['Cid'])    //次の行が別の隊員なら
                    {
                        if($C_id !== null)
                        {
                            showCharacterData($Cdata, $triggers);   //表示
                        }
                        //次のキャラへ更新
                        $C_id = $rec['Cid'];    
                        $Cdata = [];    //空にする
                        $Cdata['Cname'] = $rec['Cname'];
                        $Cdata['Cteam'] = $rec['Cteam'];
                        $Cdata['Cposition'] = $rec['Cposition'];
                        $triggers = []; //空にする
                    }
                    if(!empty($rec['Tri_name']))
                    {
                        $triggers[] = [
                            'Tri_name' => $rec['Tri_name'],
                            'side'     => $rec['Side'],
                            'slot'     => $rec['Slot']
                        ];
                    }
                }
                if($C_id !== null)
                {
                    showCharacterData($Cdata, $triggers);
                }
                $dbh=null;
            ?>
        </div>
        
        <footer>

        </footer>

        <script src="hamburger.js"></script>
    </body>
</html>