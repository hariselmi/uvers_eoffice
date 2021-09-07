<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORMULIR CATATAN TINDAK LANJUT HASIL RAPAT TINJAUAN MANAJEMEN
</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse" border="1px">
        <tr>
            <td style="text-align: center; width: 20px">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/image/logo.jpg'))) }}"
                    width="200px" height="100px">
            </td>
            <td colspan="3">
                <h2 style="text-align: center">FORMULIR CATATAN TINDAK LANJUT <br> HASIL RAPAT TINJAUAN MANAJEMEN
</h2>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">No. Dokumen</td>
            <td style="text-align: center">Revisi</td>
            <td style="text-align: center">Tanggal</td>
            <td style="text-align: center">Halaman</td>
        </tr>
        <tr>
            <td style="text-align: center">F-M4.STD-PD-1.2</td>
            <td style="text-align: center">0</td>
            <td style="text-align: center">2 Januari 2020</td>
            <td style="text-align: center">1 / 1</td>
        </tr>
    </table>

    <div style="margin-top: 20px">
        <table style="width: 100%; border-collapse: collapse" border="1px">

                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Catatan Tindak Lanjut</th>
                                <th class="text-center">Program Studi</th>
                                <th class="text-center">PIC</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Verifikasi</th>
                                <th class="text-center">Catatan Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_posts_body">
                                @foreach ($verification as $index => $item)
                                    <tr id="rec-{{ $index + 1 }}">
                                        <td  style="text-align: center;">
                                            <span class="sn">{{ $index + 1 }}</span>
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                        </td>
                                        <td style="padding: 5px;">{{ $item->respon }}</td>
                                        <td style="padding: 5px;">{{ Get_field::get_data($item->division_id, 'divisions', 'title') }}</td>
                                        <td style="padding: 5px;">{{ Get_field::get_data($item->auditee_id,'users','name') }}</td>
                                        <td style="text-align: center;">{{ Get_field::format_indo($item->deadline) }}</td>

                                        <td style="text-align: center;"> 
                                                @if($item->verification == 1)
                                                  Selesai
                                                @else
                                                  Belum selesai
                                                @endif
                                        </td>
                                        <td style="padding: 5px;">{{ $item->notes }}</td>
                                    </tr>
                                @endforeach
                        </tbody>

        </table>
    </div>

    <div style="margin-top: 70px">
        <table style="width: 100%">
            <tr>
                <td></td>
                <td style="width:40%; text-align: left; ">Batam, {{ Get_field::format_indo(date('Y-m-d')) }}</td>
            </tr>
            <tr>
                <td style="width:60%; text-align: left; "></td>
                <td style="width:40%; text-align: left; "></td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
            </tr>
            <tr>
                <td style="width:60%; text-align: left;"><u></u></td>
                <td style="width:40%; text-align: left"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
            </tr>
            <tr>
                <td style="width:60%; text-align: left"></td>
                <td style="width:40%; text-align: left">LPM</td>
            </tr>
        </table>
    </div>


</body>

</html>
