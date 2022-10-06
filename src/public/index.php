<?php
//DB接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=memo; charset=utf8',
  $dbUserName, 
  $dbPassword
);

//pagesテーブル取得
$stmt =" SELECT
    *
FROM pages";

$statement = $pdo->prepare($stmt);
$statement->execute();
$pages = $statement->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>メモ一覧</title>
    </head>
    <!-- メモを検索ボタン -->
    
    <font size="5">メモ一覧</font><br />

    <body>

    <div>
      <a href="create.php">メモを追加</a>
    </div>
    <!-- sort を追加 phpかな -->
    <div class="background right">
      <a href="index.php?<?php array_multisort(array_column($pages,'created_at'),SORT_ASC, $pages); ?>">新しい順</a>
      <a href="index.php?<?php array_multisort(array_column($pages,'created_at'),SORT_DESC, $pages); ?>">古い順</a>
    </div>

      <table border="1" width="800" bgcolor= #EEEEEE>
       <tr>
         <th>タイトル</th>
         <th>内容</th>
         <th>作成日時</th>
         <th>編集</th>
         <th>削除</th>
       </tr>

      <!-- foreach1でtableデータを一覧表示 -->
      <?php foreach ($pages as $page): ?> 
       <tr>       
         <td><?php echo $page['title']. "\n"; ?></td>
         <td><?php echo $page['content']. "\n"; ?></td>
         <td><?php echo $page['created_at']. "\n"; ?></td>
         <td><a style="text-align: right" href="edit.php?id=<?php echo $page['id']; ?>">編集</a></td>
         <td><a style="text-align: right" href="delete.php?id=<?php echo $page['id']; ?>">削除</a></td>
       </tr>
      <?php endforeach; ?>
      </table>

    </body>

</html>