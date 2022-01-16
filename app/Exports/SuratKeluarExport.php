<?php
namespace App\Exports;

use App\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class SuratKeluarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $items = SuratKeluar::select('no_surat', 'tgl_surat', 'perintah_disposisi.nama as status', 'jenis_surat.nama', 'perihal', 

            DB::raw("(SELECT nama FROM pegawai WHERE id = surat_keluar.asal_surat) AS asal_surat_pegawai"), 
            DB::raw("(SELECT nama FROM unit_kerja WHERE id = surat_keluar.unit_kerja_id) AS tujuan_surat_pegawai"),
            DB::raw("CONCAT('https://eoffice.uvers2.ac.id/document/', file_surat) AS file_surat_link"))

        ->leftJoin('jenis_surat', 'surat_keluar.jenis_id', 'jenis_surat.id')
        ->leftJoin('perintah_disposisi', 'surat_keluar.status', 'perintah_disposisi.id')
        ->where('surat_keluar.dlt', 0)
        ->get();
        return $items;
    }

    public function headings(): array
    {
        return [
            'No Surat', 'Tanggal Surat', 'Status', 'Jenis Surat', 'Perihal', 'Asal Surat', 'Tujuan Surat', 'File Surat'
        ];
    }
}