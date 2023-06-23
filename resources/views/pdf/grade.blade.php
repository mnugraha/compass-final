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

        body {
            color: black;
            font-family: Georgia, serif;
            font-size: 24px;
        }

        .container {
            border: 15px solid #14366e;
            width: 960px;
            height: 640px;
            margin: 40px auto;
            vertical-align: top;
        }

        .logo {
            margin-top: 40px;
            color: rgb(182, 15, 0);
            text-align: center;
        }

        .marquee {
            color: #14366e;
            font-size: 24px;
            margin-top: 20px;
            text-align: center;
        }

        .assignment {
            margin: 5px;
        }

        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 1px auto;
            width: 400px;
        }

        .reason {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ public_path('/logo-header.png') }}" style="width: 250px">
        </div>

        <div class="marquee">
            Assessment of Indorama Competency Framework
        </div>

        <table style="margin: 20px 40px; font-family: 'Courier New', Courier, monospace">
            <tbody style="font-size: 14px; padding-top: 5px">
                <tr>
                    <td style="padding-left: 15px">Name</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px">
                        {{ $data->user->name }}
                    </td>
                </tr>

                <tr>
                    <td style="padding-left: 15px;width: 155px;">ID</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px">
                        {{ $data->user->id_user }}
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;width: 155px;">Type Assessment</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px">
                        {{ $data->exam->title }}
                    </td>
                </tr>


                <tr>
                    <td style="padding-left: 15px;width: 155px;">Level</td>
                    <td>:</td>
                    <td style="text-transform: uppercase;border-bottom-style: dotted;border-width: 1px">
                        {{ $data->exam->level_id }}
                        @if ($data->exam->level_id == 1)
                            - Senior
                        @elseif($data->exam->level_id == 2)
                            - Middle
                        @elseif($data->exam->level_id == 3)
                            - Junior
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="font-size:14px;font-family: Verdana, Geneva, Tahoma, sans-serif; padding:30px 40px; width:100%;">
            <tr style="text-align: center; font-weight: 700; background-color: rgb(195, 193, 193)">
                <td style="width: 30%; padding: 10px">Correct Answer</td>
                <td style="width: 30%">Wrong Answer</td>
                <td style="width: 20%">Score</td>
                <td style="width: 20%">Status</td>
            </tr>
            <tr style="text-align: center;border: 1px solid #000;">
                <td style="padding: 20px;border: 1px solid #000;">{{ $data->total_correct }}</td>
                <td style="padding: 20px;border: 1px solid #000;">{{ $data->total_incorrect }}</td>
                <td style="font-weight: 700;border: 1px solid #000;">{{ $data->grade }}</td>
                <td style="padding: 20px;border: 1px solid #000;">Pass</td>
            </tr>
        </table>
        <table style="font-size:14px;font-family: Verdana, Geneva, Tahoma, sans-serif; width:90%">
            <td style="width: 70%"></td>
            <td style="text-align: right">
                <p style="">Purwakarta, <?php echo substr($data->end_time, 0, 10); ?></p>
                <img src="{{ public_path('/qr.png') }}" height="80px">
                <div style="font-weight: 700">HR Manager Indorama</div>
            </td>
        </table>

    </div>
</body>

</html>
