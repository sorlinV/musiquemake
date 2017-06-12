<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Musique</title>
</head>
<body>
    <?php
        if (!is_dir("music")) {
            mkdir("music");
        }
        if (isset($_GET['del'])) {
            $filename = "music/" . htmlspecialchars($_GET['del']);
            unlink($filename);
        }
        if (isset($_POST['name']) && $_POST['name'] != "") {
            $i = -1;
            $content = "";
            while (isset($_POST['id'.$i])) {
                $content .= htmlspecialchars($_POST['id'.$i] . "/");
                $i++;
            }
            $file = fopen("music/" . $_POST['name'], 'w');
            fwrite($file, $content);
            fclose($file);
        }
    ?>
    <form action="" method="post" id="notes">
        <input type="submit" value="Save">
        <input type="text" name='name' placeholder="Name">
    </form>
    <Button id="add">+</Button>
    <Button id="play">Play</Button>
    <audio src="" id="audio"></audio>
    <main>
        <?php
            $musics = scandir("music");
            foreach ($musics as $music) {
                if ($music[0] != '.') {
        ?><form action="" method="get">
            <input type="hidden" value="<?php
                echo file_get_contents("music/".$music);
            ?>">
            <input type="hidden" name="del" value="<?php
                echo $music;
            ?>">
            <input type="button" class="saved" value="jouer <?php
                echo $music;
            ?>">
            <input type="submit" value="supprimer <?php
                echo $music;
            ?>">
        </form>
        <?php
                }
            }
        ?>
    </main>
    <script type="text/javascript" src="musique.js"></script>
</body>
</html>