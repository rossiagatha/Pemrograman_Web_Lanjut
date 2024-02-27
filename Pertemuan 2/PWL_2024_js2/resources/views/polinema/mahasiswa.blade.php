<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <meta name="vieport" content="width+device-width, initial-scale=1">
        <title>PWL 2024</title>
    </head>
    <body>
        <h1>Daftar Mahasiswa</h1>
        <ol>
            <?php 
                foreach ($mahasiswa as $nama) {
                    echo "<li> $nama </li>";
                }
                ?>
       
        </ol>
    </body>
</html>