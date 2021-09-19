<div id="msgBox" class="container-fluid">
    <div style="height: 100px;"></div>
    <section class="discussion " id="discussionBox">
        <?php
        include("db/connectionDB.php");
        $sql = "SELECT Users.username, Message.content,Message.idChannel ,Message.image_url
        FROM Message INNER JOIN Users ON Message.idUser=Users.idUser 
        WHERE Message.idChannel=" . $channel . " ORDER BY idMsg ASC;";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $url = $row["image_url"];
                if (strlen($row["content"]) != 0 || $url != "") {
                    if ($row["username"] == $_SESSION['username']) {
                        echo '<div class="bubble recipient">';
                        echo '<img alt="" src="' . $url . '" style="width:100%">';
                        if (strlen($row["content"]) != 0) {
                            echo $row["content"];
                        }
                        echo "</div>";
                    } else {
                        echo '<div class="bubble sender"><img src="' . $url . '" style="width:100%">';
                        if ($row["content"] != "") {
                            echo $row["username"] . ": " . $row["content"] . "<br>";
                        }
                        echo "</div>";
                    }
                }
            }
        }
        ?>
    </section>
</div>
<form id="formElem" class="input-group mt-3" enctype="multipart/form-data" style="margin-left:200px ;width: calc(100% - 220px);">
    <label for="upload-photo" class="btn btn-primary ">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
        </svg>
    </label>
    <input id="upload-photo" type="file" name="image" accept="image/*" style="width: 230px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <span>&#128512;</span>
    </button>
    <input id="msg" class="form-control " name="message" type="text" autocomplete="off">
    <input class="btn btn-primary " type="submit">
</form>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <emoji-picker style="width: 100%;"></emoji-picker>
        </div>
    </div>
</div>