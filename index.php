<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>
<?php
require_once 'connec.php';
$pdo = new \PDO(DSN,USER,PASS);

if(!empty($_POST)){
  $errors=[];
  if(empty($_POST['lastname']) || strlen($_POST['lastname'])>45) {
    $errors['lastname'] = "Your lastname is invalid";
  }
  elseif(empty($_POST['firstname']) || strlen($_POST['firstname'])>45) {
    $errors['firstname'] = "Your firstname is invalid";
  }else {
    $lastname = trim($_POST['lastname']); // get the data from a form
    $firstname = trim($_POST['firstname']); // get the data from a form
    
    
    $query = 'INSERT INTO friend (lastname,firstname) VALUES(:lastname, :firstname)';
    
    
    $statement = $pdo->prepare($query);
    
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    
    
    $statement->execute();
    header('Location: ');
    exit;
  }

}
  

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(\PDO::FETCH_ASSOC); 

echo "<h1>My friend's list</h1>";

echo "<ul>";
foreach($friends as $friend){
    echo "<li>".$friend['firstname'] . ' '.$friend['lastname']."</li>";
}
echo "</ul>";

?>
<div style="text-align: center">
    <?php if (!empty($errors)) : ?>
        <div >
            <p>You can't to be my friend, please, correct your error</p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<form  action=""  method="post">

<div>

  <label  for="firstname">First name :</label>

  <input  type="text"  id="firstname" placeholder="firstname" name="firstname">

</div>

<div>

  <label  for="lastname">Last name :</label>

    <input  type="text"  id="lastname" placeholder="lastname" name="lastname">

</div>

<div  class="button">

  <button  type="submit">Be my friend</button>

</div>

</form>


</body>
</html>












