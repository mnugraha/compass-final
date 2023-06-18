<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nilai Ujian</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}

    <style>
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }

        header,
        footer {
            display: none;
        }
    </style>
</head>

<body onload="window.print()" style="font-family: Times New Roman;font-size: 12px;">
    <div style="width: 700px;">
        <center>
            <p style="font-size: 16px; margin-top: 15px;">
                Nilai Ujian
            </p>
            <p style="font-size: 16px; margin-top: -15px;">
                {{ $data->exam->title }}
            </p>
        </center>

        <table>
            <tbody>
                <tr>
                    <td style="width: 170px;"><b>ID USER</b></td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted; border-width: 1px;width: 200px;">
                        {{ $data->user->id_user }}
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td colspan="3" style="padding-top: 10px;"><b>HASIL UJIAN</b></td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">1. Nama</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->user->name }}
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">2. Ujian</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->exam->title }} - {{ $data->exam_session->title }}
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 15px;width: 155px;">3. Mulai Mengerjakan</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->start_time }}
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 15px;width: 155px;">4. Selesai Mengerjakan</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->end_time }}
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">5. Jumlah Benar</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->total_correct }}
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">6. Jumlah Salah</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->total_incorrect }}
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">7. Nilai</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px;width: 500px;">
                        {{ $data->grade }}
                    </td>
                </tr>

            </tbody>
        </table>


    </div>



    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script> --}}
</body>

</html>
