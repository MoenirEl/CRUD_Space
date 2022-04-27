<?php
require_once "pdo.php";


$stmt =$connect->prepare ("SELECT * FROM planeten WHERE ID = :ID");
$stmt->execute(['ID'=>$_GET['id']]);
$data = $stmt->fetch();

if(isset($_POST["aanpassen"])){ 
    $sql = "UPDATE planeten SET 
    naam = :naam,
    prijs = :prijs,
    beschrijving =:beschrijving 
    WHERE ID = :ID
    ";

$stmt = $connect->prepare($sql);
$stmt->bindParam(":naam", $_POST['naam']);
$stmt->bindParam(":prijs", $_POST['prijs']);
$stmt->bindParam(":beschrijving", $_POST['beschrijving']);
$stmt->bindParam(":ID", $data['ID']);
$stmt->execute();
$stmt->debugDumpParams();
header("Location: ../mainpages/admin.php")
;

}
?>

<form action="" method="post">
    naam<input type="text" name="naam" id=""value=" <?php echo $data ['naam']; ?>"><br />
    Prijs<input type="text" name="prijs" id="" value="<?php echo $data ['prijs']; ?> " ><br />
    beschrijving<input type="text" name="beschrijving" id=""value=" <?php echo $data ['beschrijving']; ?>"><br />

    <input type="submit" name="aanpassen" value="submit">
    <a href="../mainpages/admin.php">back</a>
</form>