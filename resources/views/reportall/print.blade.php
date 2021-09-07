<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN DAFTAR AUDIT MUTU INTERNAL</title>
</head>

<body>
    <h2 style="text-align: center">LAPORAN DAFTAR AUDIT MUTU INTERNAL 
    <br>
    {{ Get_field::get_data($period_id, 'periods', 'title') }} {{ Get_field::get_data($period_id, 'periods', 'semester') }}</h2>

    <table style="width: 100%; border-collapse: collapse" border="1px">
            <tr>
                <th>No</th>
                <th>Auditor</th>
                <th>Auditee</th>
                <th>Tanggal</th>
                <th>Standar</th>
                <th>Standar Detail</th>
                <th>Status</th>
            </tr>
        @if (count($reports)>0)
            @foreach ($reports as $index => $item)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td style="padding-left: 10px">{{ $item->auditor_name }}</td>
                    <td style="padding-left: 10px">{{ $item->auditee_name }} <br> {{ $item->division }} </td>
                    <td style="padding-left: 10px; text-align: center">{{ Get_field::format_indo($item->schedule_date) }} <br> {{ $item->clock_start }} - {{ $item->clock_finish }}</td>
                    <td style="padding-left: 10px">{{Get_field::get_data($item->standard_id, 'standards', 'standard')}}</td>
                    <td style="padding-left: 10px">{{Get_field::get_data($item->standard_detail_id, 'standard_details', 'standard_details')}}</td>
                    <td style="padding-left: 10px">
                        @switch($item->status)
                            @case(1)
                                Pending
                                @break
                            @case(2)
                                Process
                                @break
                            @case(3)
                                Complete
                                @break
                            @case(4)
                                Cancel
                                @break
                            @default
                                
                        @endswitch
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="text-align: center">Tidak ada data</td>
            </tr>
        @endif
    </table>

</body>

</html>
