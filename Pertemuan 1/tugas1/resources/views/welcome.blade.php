<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
            h2{
                text-align: center;
            }
             table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            
            td {
              border: 1px solid #8cabe6;
              text-align: left;
              padding: 8px;
            }
            
            th {
              border: 1px solid #8cabe6;
              text-align: center;
              padding: 8px;
            }
            
            tr:nth-child(even) {
              background-color: #8cabe6;
            } 
            </style>
    </head>
    <body class="antialiased">
        <h2><b>PROVINSI JAWA TIMUR<br>KOTA MALANG </br></b></h2>

        <table>
            <tr>
              <td><b>NIK</b></td>
              <td><b>3573056510020010</b></td>
              <div class="container">
                <th rowspan="14"><img src="img/formal.jpg" alt="formal" width="170" height="300">
                <br><img src="img/ttd.png" alt="formal" width="80" height="80"></br>
            </th></div>
            </tr>
            <tr>
              <td>Nama</td>
              <td>Rossi Dea Agatha</td>
            </tr>
            <tr>
              <td>Tempat/Tgl Lahir</td>
              <td>MALANG, 25-10-2002</td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>PEREMPUAN</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;Gol Darah</td>
              <td>A</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>JL.RAYA TLOGOMAS III</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;RT/RW</td>
              <td>002/006</td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;Kel/Desa</td>
              <td>TLOGOMAS</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Kecamatan</td>
                <td>LOWOKWARU</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>ISLAM</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>BELUM KAWIN</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>PELAJAR/MAHASISWA</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>WNI</td>
            </tr>
            <tr>
                <td>Berlaku Hingga</td>
                <td>SEUMUR HIDUP</td>
            </tr>
          </table> 
    </body>
</html>
