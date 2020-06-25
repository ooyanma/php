<?php
require_once("./lib/util.php");

// データベースユーザー
$user = "";
$password = "";
// 利用するデータベース
$dbname = "class";
// MySQLサーバ
$host = "localhost:3306";
// MySQLのDSN(Data Source Name)文字列 : MySQLに接続するときに使う
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SQL_SELECT</title>
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/tablestyle.css">
  </head>
  <body>
    <?php
    // MySQLに接続
    try {
      $pdo = new PDO($dsn, $user, $password);
      // プリペアドステートメントのエミュレーションを無効にする
      // 実行したいSQLをコンパイルした一種のテンプレートのようなもの(マニュアルの例題参照)
      // http://php.net/manual/ja/pdo.prepared-statements.php
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // 例外がスローされるよう設定
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "データベース{$dbname}に接続しました。";
      // SQL文の作成
      $sql = "UPDATE member SET name = '新倉立男' WHERE id = 5";
      //プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      //SQL実行
      $stm->execute();
      // 結果の取得:連想配列での取得(FETCH_ASSOCを指定)
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);

      // テーブル:タイトル行
      echo "<table>";
      echo "<thead><tr>";
      echo "<th>","ID","</th>";
      echo "<th>","名前","</th>";
      echo "<th>","年齢","</th>";
      echo "<th>","性別","</th>";
      echo "</th></thead>";
      //値を取り出して行に表示
      echo "<tbody>";
      foreach ($result as $row) {
        echo "<tr>";
        echo "<td>", es($row['id']), "</td>";
        echo "<td>", es($row['name']), "</td>";
        echo "<td>", es($row['age']), "</td>";
        echo "<td>", es($row['sex']), "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      // 接続を解除
      $pdo = NULL;
    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }
    ?>
  </body>
</html>
