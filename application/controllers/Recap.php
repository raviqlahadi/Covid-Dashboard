<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Recap extends CI_Controller {

    public function index()
    {
        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $spreadsheet->getActiveSheet()->mergeCells('A1:F1');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];

        $boldArray = [
            'font' => [
                'bold' => true,
            ],
        ];

        

        $last = count($this->data_to_show())+3;
        $cordinat = 'A3:E' . $last . '';
        $cordinat_last = 'A'.$last.':E' . $last . '';
        $sheet->getStyle($cordinat)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($boldArray);
        $spreadsheet->getActiveSheet()->getStyle('A3:E3')->applyFromArray($boldArray);
        $spreadsheet->getActiveSheet()->getStyle($cordinat_last)->applyFromArray($boldArray);

        $sheet->getStyle('A:E')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:E2')->getAlignment()->setWrapText(true);

        $sheet->getStyle('A:E')->getAlignment()->setHorizontal('center');

        
        $sheet->setCellValue('A1', 'Rekap Data');

        $sheet->setCellValue('A3', 'Tanggal');
        $sheet->setCellValue('B3', 'Jumlah Pasien Dirawat');
        $sheet->setCellValue('C3', 'Jumlah Pasien Sembuh');
        $sheet->setCellValue('D3', 'Jumlah Pasien Meninggal');        
        $sheet->setCellValue('E3', 'Total');

        $arrayData = $this->data_to_show();
        $spreadsheet->getActiveSheet()
        ->fromArray(
            $arrayData,  // The data to set
            NULL,        // Array values with this value will not be set
            'A4'         // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
        );


        $writer = new Xlsx($spreadsheet); // instantiate Xlsx

        $filename = 'Rekap Data Dashboard Covid'; // set filename for excel file to be exported

        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    // download file 
    }

    public function data_to_show()
    {
        $this->load->model('m_patients');
        $patient_by_date = $this->m_patients->get_recap();
        $res = [];
        $total_dirawat = 0;
        $total_sembuh = 0;
        $total_meninggal = 0;
        $total_total=0;

        foreach ($patient_by_date as $key => $value) {
            $total = $value->dirawat+$value->sembuh+$value->meninggal;
            $arr = [$value->date, $value->dirawat, $value->sembuh,$value->meninggal, $value->total];

            $total_dirawat = $total_dirawat + $value->dirawat;
            $total_sembuh = $total_sembuh  + $value->sembuh;
            $total_meninggal = $total_meninggal + $value->meninggal;
            $total_total = $total_total + $total;

            array_push($res, $arr);
        }
        $arr_total = ['TOTAL', $total_dirawat, $total_sembuh, $total_meninggal, $total_total];
        array_push($res, $arr_total);
        return $res;

        
    }
    
    }

    

    
    /* End of file Recap.php */
    

?>