<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
    thead {
      background-color: lawngreen;
      text-align: left;
    }
   table {
     width: 450px;
     border-spacing: 0;
   }

    td {

      padding: 2px 5px;

    }

    tr:nth-of-type(2n) {
       background-color: #f7f7f7;
    }

  </style>
</head>
<body>
  <form method="POST">
    <input name="description" placeholder="задача" type="text" />
    <button>Добавить</button>
  </form>
  <h1>Спиок литературы</h1>
  <?php
  $pdo = new PDO("mysql:host=localhost; dbname=task13;charset=utf8", "root", "");

 if($_POST['description']){
   $insert_sql = "INSERT into tasks (description) values ('".$_POST['description']."')";
   $pdo->query($insert_sql);
 }

if($_GET['action']=='delete'){
  $delete_sql = "DELETE FROM tasks WHERE id=".$_GET['id'];
  $pdo->query($delete_sql);
}
if($_GET['action']=='change'){
  $change_sql= "UPDATE tasks SET is_done=true WHERE id=".$_GET['id'];
  $pdo->query($change_sql);
}

    $sql = "SELECT * FROM tasks";


  ?>
<table>
  <thead>
    <th>id</th>
    <th>description</th>
    <th>date_added</th>
    <th>is_done</th>
    <th>controls</th>
  </thead>
  <tbody>
      <?php
      foreach ($pdo->query($sql) as $row) {
        echo  "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['date_added']."</td>";
        echo "<td>".$row['is_done']."</td>";
        echo "<td> <a href='?id=".$row['id']."&action=delete'>Удалить</a> <a  href='?id=".$row['id']."&action=change'>Изменить</a></td>";
        echo "</tr>";
      }
      ?>
  </tbody>
</table>
</body>
</head>

</html>
