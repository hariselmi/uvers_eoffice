<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR TEMUAN AUDIT MUTU INTERNAL</title>
</head>

<body>
    <h2 style="text-align: center">DAFTAR TEMUAN AUDIT MUTU INTERNAL</h2><br>
    <table>
        <tr>
            <td>Nama Auditee</td>
            <td>:</td>
            <td>{{ $finding->auditee_name }}</td>
        </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td>{{ Get_field::get_data($finding->division_id, 'divisions', 'title') }}</td>
            </tr>
        <tr>
            <td>Periode </td>
            <td>:</td>
            <td>{{ Get_field::get_data($finding->period_id,'periods','title') }} {{ Get_field::get_data($finding->period_id,'periods','semester') }}</td>
        </tr>
        <tr>
            <td>Tanggal Audit</td>
            <td>:</td>
            <td>{{ Get_field::format_indo($finding->schedule_date) }}
            </td>
        </tr>
    </table><br>

    <table style="width: 100%; border-collapse: collapse" border="1px">
        <tr style="background-color: #4091f5; color:white;">
            <th style="border: 1px solid black; width: 1%; text-align:center">No</th>
            <th style="border: 1px solid black; text-align:center">KTS/OB</th>
            <th style="border: 1px solid black; text-align:center">Referensi</th>
            <th style="border: 1px solid black; text-align:center">Pernyataan</th>
            <th style="border: 1px solid black; width: 10%; text-align:center">Setuju</th>
            <th style="border: 1px solid black; width: 15%;text-align:center">Tidak Setuju</th>
        </tr>
        @if (count($findingDetails) > 0)
            @foreach ($findingDetails as $index => $item)
                <tr>
                    <th scope="row" style="text-align:center">{{ $index + 1 }}</th>
                    <td style="padding-left:10px;">
                        @switch($item->category)
                            @case(1)
                                KTS (Minor)
                            @break
                            @case(2)
                                KTS (Mayor)
                            @break
                            @case(3)
                                OB
                            @break
                            @default

                        @endswitch
                    </td>
                    <td style="padding-left:10px; ">{{ $item->reference }}</td>
                    <td style="padding-left:10px; ">{{ $item->statement }}</td>
                    <td style="text-align: center">
                        @if ($item->answer == 1)
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/checklist.png'))) }}"
                                width="20px" height="20px">
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if ($item->answer == 2)
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/checklist.png'))) }}"
                                width="20px" height="20px">
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <th colspan="6" style="text-align:center">Tidak ada data</th>
            </tr>
        @endif
    </table>

    <div style="margin-top: 70px">
        <table style="width: 100%">
            <tr>
                <td style="width:25%; text-align: center; ">Disusun Oleh,</td>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center; ">Disetujui Oleh,</td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <td style="width:25%; text-align: center"><u>{{ $finding->auditor_name }}</u></td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center"><u></u></td>
                <td style="width:25%; text-align: center"><u>{{ $finding->auditee_name }}</u></td>
            </tr>
            <tr>
                <td style="width:25%; text-align: center">Ketua Auditor</td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center"></td>
                <td style="width:25%; text-align: center">Auditee</td>
            </tr>
        </table>
    </div>

</body>

</html>
