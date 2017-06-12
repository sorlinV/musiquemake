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
        if (isset($_GET['del']) && is_file('music/' . $_GET['del'])) {
            $filename = "music/" . htmlspecialchars($_GET['del']);
            unlink($filename);
        }
        if (isset($_POST['name']) && $_POST['name'] != "") {
            $temp = 200;
            if (isset($_POST['temps'])) {
                $temp = htmlspecialchars($_POST['temps']);
            }
            $i = -1;
            $content = $temp . "/";
            while (isset($_POST['id'.$i])) {
                $content .= htmlspecialchars($_POST['id'.$i] . "/");
                $i++;
            }
            $file = fopen("music/" . $_POST['name'], 'w');
            fwrite($file, $content);
            fclose($file);
        }
    ?>
    <form action="index.php" method="post" id="notes">
        <input type="submit" value="Save">
        <input type="text" name='name' placeholder="Name">
        <input type="text" name='temps' id="temps" placeholder="temps">
    </form>
    <Button id="add">+</Button>
    <Button id="play">Play</Button>
    <audio src="" id="audio"></audio>
    <main>
        <?php
            $musics = scandir("music");
            foreach ($musics as $music) {
                if ($music[0] != '.') {
        ?><form action="index.php" method="get">
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