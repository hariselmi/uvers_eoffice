<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR DOKUMEN AUDIT MUTU INTERNAL</title>
</head>

<body>
    <h2 style="text-align: center">DAFTAR DOKUMEN AUDIT MUTU INTERNAL</h2><br>
    <table>
        <tr>
            <td>Nama Auditee</td>
            <td>:</td>
            <td>{{ $document->auditee_name }}</td>
        </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td>{{ Get_field::get_data($document->division_id, 'divisions', 'title') }}</td>
            </tr>
        <tr>
            <td>Periode </td>
            <td>:</td>
            <td>{{ Get_field::get_data($document->period_id,'periods','title') }} {{ Get_field::get_data($document->period_id,'periods','semester') }}</td>
        </tr>
        <tr>
            <td>Tanggal Audit</td>
            <td>:</td>
            <td>{{ Get_field::format_indo($document->schedule_date) }}</td>
        </tr>
    </table><br>

    <table style="width: 100%; border-collapse: collapse" border="1px">
        <tr style="background-color: #4091f5; color:white;">
            <th style="width: 5%; text-align:center; border: 1px solid black">No</th>
            <th style="text-align:center; border: 1px solid black">Nama Dokumen</th>
        </tr>
        @if (count($documentDetails)>0)
            @foreach ($documentDetails as $index => $item)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td style="padding-left: 10px">{{ $item->document }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="2" style="text-align: center">Tidak ada data</td>
            </tr>
        @endif
    </table>

    <div style="margin-top: 70px">
        <table style="width: 100%">
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center">Disusun Oleh,</td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center"><u>{{ $document->auditor_name }}</u></td>
            </tr>
            <tr>
                <td style="width: 80%"></td>
                <td style="text-align: center">Ketua Auditor</td>
            </tr>
        </table>
    </div>

</body>

</html>
