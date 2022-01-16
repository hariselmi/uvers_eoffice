<?php
namespace App\Exports;

use App\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class SuratMasukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $items = SuratMasuk::select('no_surat', 'tgl_surat', 'perintah_disposisi.nama as status', 'jenis_surat.nama', 'perihal', 'asal_surat' , DB::raw("CONCAT('https://eoffice.uvers2.ac.id/document/', file_surat) AS file_surat_link"))
        ->leftJoin('jenis_surat', 'surat_masuk.jenis_id', 'jenis_surat.id')
        ->leftJoin('perintah_disposisi', 'surat_masuk.status', 'perintah_disposisi.id')
        ->where('surat_masuk.dlt', 0)
        ->get();
        return $items;
    }

    public function headings(): array
    {
        return [
            'No Surat', 'Tanggal Surat', 'Status', 'Jenis Surat', 'Perihal', 'Asal Surat', 'File Surat'
        ];
    }
}