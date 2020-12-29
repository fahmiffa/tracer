<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Tracer Alumni SMKN 1 GEBANG</title>
    <style>
        @media print {
            @page {
                margin: 0 auto;
                /* imprtant to logo margin */
                sheet-size: 300px 120mm;
                /* imprtant to set paper size */
            }

            html {
                direction: rtl;
            }

            html,
            body {
                margin: 0;
                padding: 0
            }

            td {
                padding: 5px;
            }

            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
            }

            .text-center {
                text-align: center;
            }
        }
    </style>
</head>
<!-- <body onload="window.print();"> -->

<body>
    <br>
    <div id='printContainer'>
        <h4 style="margin-top:0" class="text-center">Tracer Alumni SMKN 1 GEBANG</h4>

        <table>
            <tr>
                <td>NIS</td>
                <td></td>
                <td><b><?= $al[0]->al_nis ?></b></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td></td>
                <td><b><?= date_to_id($al[0]->al_date) ?><br></b></td>
            </tr>

            <tr>
                <td>Nama</td>
                <td></td>
                <td><b><?= $al[0]->al_name ?></b></td>
            </tr>
        </table>
        <br>
        <center>
            <small><b>No. Registrasi : <?= $al[0]->al_id ?></b></small>
            <p>Berikut adalah sebagai bukti Anda Telah berpartisipasi dalam Program Tracer Alumni SMKN 1 GEBANG</p>
        </center>

        <table>
            <tr>
                <td class="text-center"><b><?= base_url() ?></b></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center"><i>Terima kasih sudah Berpartispasi Program Tracer<br> Semoga Anda Sukses Selalu</i></td>
                <td></td>
            </tr>
        </table>
        <hr>

    </div>
</body>

</html>