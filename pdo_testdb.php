<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDOでデータベース接続</title>
    <link href="./css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php
    // PDO : PHP Data Objects
    // http://php.net/manual/ja/book.pdo.php
    // データベースユーザー
    $user = "";
    $password = "";
    // 利用するデータベース
    $dbname = "class";
    // MySQLサーバ
    $host = "localhost:3306";
    // MySQLのDSN(Data Source Name)文字列 : MySQLに接続するときに使う
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

    // MySQLに接続
    try {
      $pdo = new PDO($dsn, $user, $password);
      // プリペアードステートメントのエミュレーションを無効にする
      // 実行したいSQLをコンパイルした一種のテンプレートのようなもの(マニュアルの例題参照)
      // http://php.net/manual/ja/pdo.prepared-statements.php
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // 例外がスローされるよう設定
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // 接続を解除
      $pdo = NULL;

      echo "データベース{$dbname}に接続しました。";
    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }


    ?>
  </body>
</html>
