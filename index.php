<?php
require_once('functions.php');
if(isset($_SERVER['HTTP_REFERER'])){
  $previousLink = parse_url($_SERVER['HTTP_REFERER']);
  if ($previousLink['path'] == '/new.php'){
    unsetSession();
  };
};
setToken();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
  WELCOME!
  <div>
    <?php if($_SESSION['login'] !== ''): ?>
      <p><?php echo 'ようこそ'.$_SESSION['login'].'さん'; ?></p>
      <p><?php echo $_SESSION['login'].'さんでは無い場合は下のボタンでログアウトして下さい。'?></p>
      <form action="store.php" method="POST">
        <input type="hidden" name="type" value="logout">
        <input type="submit" value="ログアウト">
      </form>
      <?php else : ?>
        <p>ユーザーの方はログインして下さい。</p>
        <form action="store.php" method="post" name="userConf">
          <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
          <div>
            <?php if(isset($_SESSION['error'])): ?>
              <p> <?php echo $_SESSION['error'] ?>
              </p>
            <?php endif; ?>
            <p class="iblock">USER NAME</p>
            <input type="text" name="user_name">
          </div>
          <div>
            <p class="iblock">PASSWORD</p>
            <input type="password" name="pw">
          </div>
          <input type="hidden" name="type" value="login">
          <input type="submit" value="ログイン" name="submit">
        </form>
      <?php endif; ?>
    <a href="new.php">
      <p>新規作成</p>
    </a>
  </div>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach(index() as $todo): ?>
        <tr>
          <td><?php echo h($todo['id']) ?></td>
          <td><?php echo h($todo['todo']) ?></td>
          <td>
            <a href="edit.php?id=<?php echo h($todo['id']) ?>">更新</a>
          </td>
          <td>
            <form action="store.php" method="POST">
              <input type="hidden" name="id" value="<?php echo h($todo['id']) ?>">
              <input type="hidden" name="type" value="delete">
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>