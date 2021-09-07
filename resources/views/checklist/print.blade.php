<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DAFTAR CHEKLIST AUDIT MUTU INTERNAL</title>
</head>

<body>
    <h2 style="text-align: center">DAFTAR CHEKLIST AUDIT MUTU INTERNAL</h2><br>
    <table>
        <tr>
            <td>Nama Auditee</td>
            <td>:</td>
            <td>{{ $checklist->auditee_name }}</td>
        </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td>{{ Get_field::get_data($checklist->division_id, 'divisions', 'title') }}</td>
            </tr>
        <tr>
            <td>Periode </td>
            <td>:</td>
            <td>{{ Get_field::get_data($checklist->period_id,'periods','title') }} {{ Get_field::get_data($checklist->period_id,'periods','semester') }}</td>
        </tr>
        <tr>
            <td>Tanggal Audit</td>
            <td>:</td>
            <td>{{ Get_field::format_indo($checklist->schedule_date) }}</td>
        </tr>
    </table><br>

    <table style="width: 100%; border-collapse: collapse" border="1px">
        <tr style="background-color: #4091f5; color:white;">
            <th style="width: 5%; text-align:center; border: 1px solid black">No</th>
            <th style="text-align:center; border: 1px solid black">Referensi</th>
            <th style="text-align:center; border: 1px solid black">Pertanyaan</th>
            <th style="width: 5%text-align:center; border: 1px solid black">Y</th>
            <th style="width: 5%text-align:center; border: 1px solid black">T</th>
            <th style="text-align:center; border: 1px solid black">Catatan Khusus</th>
            <th style="text-align:center; border: 1px solid black">Audit Lapangan</th>
        </tr>
        @if (count($checklistDetails) > 0)
        @foreach ($checklistDetails as $index => $item)
            <tr>
                <td style="text-align: center">{{ $index + 1 }}</td>
                <td style="padding-left: 10px">{{ $item->reference }}</td>
                <td style="padding-left: 10px">{{ $item->question }}</td>
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
                <td style="padding-left: 10px">{{ $item->special_note }}</td>
                <td style="padding-left: 10px">{{ $item->audit }}</td>
            </tr>
        @endforeach
        @else
            <tr>
                <th colspan="7" style="text-align:center">Tidak ada data</th>
            </tr>
        @endif
    </table>

    <div style="margin-top: 70px">
        <table style="width: 100%">
            <tr>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center; ">Disusun Oleh,</td>
            </tr>
            <tr>
                <td><br><br></td>
            </tr>
            <tr>
                <td style="width:25%; text-align: center"><u>{{ $checklist->auditor_name }}</u></td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center"><u>{{ $checklist->member_one_name }}</u></td>
                <td style="width:25%; text-align: center"><u>{{ $checklist->member_two_name }}</u></td>
            </tr>
            <tr>
                <td style="width:25%; text-align: center">Ketua Auditor</td>
                <td style="width:25%"></td>
                <td style="width:25%; text-align: center">Anggota Auditor</td>
                <td style="width:25%; text-align: center">Anggota Auditor</td>
            </tr>
        </table>
    </div>
</body>

</html>
