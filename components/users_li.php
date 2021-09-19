<?php
include("db/connectionDB.php");

$idUser = $_SESSION['idUser'];

$sql = 'SELECT * FROM Users WHERE idUser <>' . $idUser;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <li>
            <form id="<?=$row['idUser']?>" action="create_or_go_to_channel.php" method="POST" >
                <input  style="width:170px" class="my-1 btn grow
                <?php
                if($row['idUser']==$_SESSION["user2"]){
                    echo 'btn-primary';
                }
                else{
                    echo 'btn-secondary';
                }
                ?>
                mx-1" type="submit" value=<?= $row['username'] ?> name=username>
                <input type="hidden" value=<?= $idUser ?> name=user1>
                <input type="hidden" value=<?= $row['idUser'] ?> name=user2>
            </form>
        </li>
        
<?php 
    }
}
$conn->close();
?>