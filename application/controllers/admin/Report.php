<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model', 'request');
        $this->load->model('Question_model', 'question');
        $this->load->model('Survei_model', 'survei');
        $this->load->model('Survei_question_model', 'quest');
    }

    public function all()
    {
        $monthFrom = $this->input->post('monthFrom');
        $monthTo = $this->input->post('monthTo');
        $year = $this->input->post('year');

        for ($i = $monthFrom; $i <= $monthTo; $i++) {
            $data['mskUmum' . $i . ''] = $this->request->countDataByField(1, $i, $year);
            $data['mskKomo' . $i . ''] = $this->request->countDataByField(2, $i, $year);
            $data['mskNon' . $i . ''] = $this->request->countDataByField(3, $i, $year);
            $data['mskSi' . $i . ''] = $this->request->countDataByField(4, $i, $year);

            $data['lynUmum' . $i . ''] = $this->request->countDataByFieldStatus(1, $i, $year, 5);
            $data['lynKomo' . $i . ''] = $this->request->countDataByFieldStatus(2, $i, $year, 5);
            $data['lynNon' . $i . ''] = $this->request->countDataByFieldStatus(3, $i, $year, 5);
            $data['lynSi' . $i . ''] = $this->request->countDataByFieldStatus(4, $i, $year, 5);

            $data['rjcUmum' . $i . ''] = $this->request->countDataByFieldStatus(1, $i, $year, -1);
            $data['rjcKomo' . $i . ''] = $this->request->countDataByFieldStatus(2, $i, $year, -1);
            $data['rjcNon' . $i . ''] = $this->request->countDataByFieldStatus(3, $i, $year, -1);
            $data['rjcSi' . $i . ''] = $this->request->countDataByFieldStatus(4, $i, $year, -1);
        }

        $spreadsheet = new Spreadsheet();

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $status = ['Masuk', 'Terlayani', 'Ditolak'];

        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "LAPORAN\nPELAYANAN MASUK PADA BIDANG BIDANG DI PUSDATIN KEMENTAN\nPUSAT DATA DAN INFORMASI PERTANIAN - SEKERTARIAT JENDERAL\nTAHUN 2022")
            ->mergeCells('A1:AL5')
            ->getStyle('A1')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()
            ->setCellValue('A6', 'Tipe Permintaan')
            ->setCellValue('A9', 'Umum')
            ->setCellValue('A10', 'Data Komoditas')
            ->setCellValue('A11', 'Data Non Komoditas')
            ->setCellValue('A12', 'Pengembangan Sistem Informasi')
            ->setCellValue('B6', 'Bulan')
            ->setCellValue('B7', 'Januari')
            ->setCellValue('E7', 'Februari')
            ->setCellValue('H7', 'Maret')
            ->setCellValue('K7', 'April')
            ->setCellValue('N7', 'Mei')
            ->setCellValue('Q7', 'Juni')
            ->setCellValue('T7', 'Juli')
            ->setCellValue('W7', 'Agustus')
            ->setCellValue('Z7', 'September')
            ->setCellValue('AC7', 'Oktober')
            ->setCellValue('AF7', 'November')
            ->setCellValue('AI7', 'Desember')
            ->setCellValue('AL6', 'Total')
            ->getStyle('A6:AL12')->applyFromArray($style_row);
        $spreadsheet->getActiveSheet()->getStyle('A6:A12')->getFont()->setBold('A6:A12');
        $spreadsheet->getActiveSheet()->getStyle('B6:AL7')->getFont()->setBold('B6:AL7');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $column = 2;
        $y = 0;
        while (
            $y < 12
        ) {
            $x = 0;
            while ($x < 3) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 8, $status[$x]);
                $column++;
                $x++;
            }
            $y++;
        }

        $column = 2;
        for ($i = 1; $i < 13; $i++) {
            if (isset($data['mskUmum' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, $data['mskUmum' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, 0);
            }

            if (isset($data['mskKomo' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, $data['mskKomo' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, 0);
            }

            if (isset($data['mskNon' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $data['mskNon' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, 0);
            }

            if (isset($data['mskSi' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, $data['mskSi' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, 0);
            }
            $column++;
            $column++;
            $column++;
        }

        $column = 3;
        for ($i = 1; $i < 13; $i++) {
            if (isset($data['lynUmum' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, $data['lynUmum' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, 0);
            }

            if (isset($data['lynKomo' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, $data['lynKomo' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, 0);
            }

            if (isset($data['lynNon' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $data['lynNon' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, 0);
            }

            if (isset($data['lynSi' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, $data['lynSi' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, 0);
            }
            $column++;
            $column++;
            $column++;
        }

        $column = 4;
        for ($i = 1; $i < 13; $i++) {
            if (isset($data['rjcUmum' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, $data['rjcUmum' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 9, 0);
            }

            if (isset($data['rjcKomo' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, $data['rjcKomo' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 10, 0);
            }

            if (isset($data['rjcNon' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $data['rjcNon' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 11, 0);
            }

            if (isset($data['rjcSi' . $i . ''])) {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, $data['rjcSi' . $i . '']);
            } else {
                $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 12, 0);
            }
            $column++;
            $column++;
            $column++;
        }

        $spreadsheet->getActiveSheet()
            ->setCellValue('AL9', '=SUM(B9:AK9)')
            ->setCellValue('AL10', '=SUM(B10:AK10)')
            ->setCellValue('AL11', '=SUM(B11:AK11)')
            ->setCellValue('AL12', '=SUM(B11:AK12)');

        $spreadsheet->getActiveSheet()
            ->mergeCells('A6:A8')
            ->mergeCells('B6:AK6')
            ->mergeCells('B7:D7')
            ->mergeCells('E7:G7')
            ->mergeCells('H7:J7')
            ->mergeCells('K7:M7')
            ->mergeCells('N7:P7')
            ->mergeCells('Q7:S7')
            ->mergeCells('T7:V7')
            ->mergeCells('W7:Y7')
            ->mergeCells('Z7:AB7')
            ->mergeCells('AC7:AE7')
            ->mergeCells('AF7:AH7')
            ->mergeCells('AI7:AK7')
            ->mergeCells('AL6:AL8');

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Bulan ' . $monthFrom . ' - ' . $monthTo . ' ' . $year . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function list()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $special = $this->input->post('special');

        $startDate = date("j F Y", strtotime($start_date));
        $endDate = date("j F Y", strtotime($end_date));

        if ($this->input->post('officer_id')) {
            $datas = $this->request->getDataOfficerByDate($start_date, $end_date, $special, $this->input->post('officer_id'));
        } elseif ($this->input->post('field_id')) {
            $datas = $this->request->getDataFieldByDate($start_date, $end_date, $special, $this->input->post('field_id'));
        } elseif ($this->input->post('sub_field_id')) {
            $datas = $this->request->getDataSubFieldByDate($start_date, $end_date, $special, $this->input->post('sub_field_id'));
        } else {
            $datas = $this->request->getDataAllByDate($start_date, $end_date, $special);
        }

        $spreadsheet = new Spreadsheet();

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "LAPORAN BULANAN\nPELAKSANAAN TUGAS PELAYANAN KHUSUS INFORMASI PUBLIK\nPUSAT DATA DAN INFORMASI PERTANIAN - SEKERTARIAT JENDERAL\n " . $startDate . " - " . $endDate . "")
            ->mergeCells('A1:I4')
            ->getStyle('A1')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()
            ->setCellValue('A5', 'No Pendaftaran')
            ->setCellValue('B5', 'Tgl Permohonan')
            ->setCellValue('C5', 'Tgl Selesai Permohonan')
            ->setCellValue('D5', 'Nama Pemohon')
            ->setCellValue('E5', 'Insatansi Pemohon')
            ->setCellValue('F5', 'Informasi Publik')
            ->setCellValue('F6', 'Keperluan Untuk')
            ->setCellValue('G6', 'Data yang Dibutuhkan')
            ->setCellValue('H5', 'Petugas Pelayanan')
            ->setCellValue('I5', 'Status')
            ->getStyle('A5:I6')->applyFromArray($style_col);
        foreach (range('A', 'I') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()
            ->mergeCells('A5:A6')
            ->mergeCells('B5:B6')
            ->mergeCells('C5:C6')
            ->mergeCells('D5:D6')
            ->mergeCells('E5:E6')
            ->mergeCells('F5:G5')
            ->mergeCells('H5:H6')
            ->mergeCells('I5:I6');

        $number = 1;
        $numrow = 7;
        foreach ($datas as $data) {
            $sheet =  $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A' . $numrow, $number);
            $sheet->setCellValue('B' . $numrow, $data['created_at']);
            $sheet->setCellValue('C' . $numrow, $data['final_process']);
            $sheet->setCellValue('D' . $numrow, $data['name']);
            $sheet->setCellValue('E' . $numrow, $data['company']);
            if ($data['used_for_id'] == 5) {
                $sheet->setCellValue('F' . $numrow, $data['other_used_for']);
            } else {
                $sheet->setCellValue('F' . $numrow, $data['utility_name']);
            }
            $sheet->setCellValue('G' . $numrow, $data['data_name']);
            $sheet->setCellValue('H' . $numrow, $data['officer_name']);
            if ($data['process_state'] == 5) {
                $sheet->setCellValue('I' . $numrow, 'Terkirim');
            } elseif ($data['process_state'] == -1) {
                $sheet->setCellValue('I' . $numrow, 'Ditolak');
            } else {
                $sheet->setCellValue('I' . $numrow, 'Dalam Proses');
            }

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);

            $number++;
            $numrow++;
        }

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Permohonan Data (' . $startDate . '-' . $endDate . ').xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function question()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $startDate = date("j F Y", strtotime($start_date));
        $endDate = date("j F Y", strtotime($end_date));

        $datas = $this->question->getDataAllByDate($start_date, $end_date);

        $spreadsheet = new Spreadsheet();

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "LAPORAN PENGADUAN\nPUSAT DATA DAN INFORMASI PERTANIAN - SEKERTARIAT JENDERAL\n " . $startDate . " - " . $endDate . "")
            ->mergeCells('A1:F4')
            ->getStyle('A1')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()
            ->setCellValue('A5', 'Pengaduan Masuk')
            ->setCellValue('A6', 'No.')
            ->setCellValue('B6', 'Tanggal')
            ->setCellValue('C6', 'Nama')
            ->setCellValue('D6', 'Email')
            ->setCellValue('E6', 'Nomor Telepon')
            ->setCellValue('F6', 'Pesan')
            ->getStyle('A5:F6')->applyFromArray($style_col);
        foreach (range('A', 'F') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $spreadsheet->getActiveSheet()
            ->mergeCells('A5:F5');

        $number = 1;
        $numrow = 7;
        foreach ($datas as $data) {
            $sheet =  $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A' . $numrow, $number);
            $sheet->setCellValue('B' . $numrow, $data['created_at']);
            $sheet->setCellValue('C' . $numrow, $data['name']);
            $sheet->setCellValue('D' . $numrow, $data['email']);
            $sheet->setCellValue('E' . $numrow, $data['phone_number']);
            $sheet->setCellValue('F' . $numrow, $data['question']);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $number++;
            $numrow++;
        }

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Pengaduan (' . $startDate . '-' . $endDate . ').xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function survei()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $startDate = date("j F Y", strtotime($start_date));
        $endDate = date("j F Y", strtotime($end_date));

        $datas = $this->survei->getDataAllByDate($start_date, $end_date);

        $spreadsheet = new Spreadsheet();

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "LAPORAN SURVEY\nPELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK\nPUSAT DATA DAN INFORMASI PERTANIAN - SEKERTARIAT JENDERAL\n BULAN : ")
            ->mergeCells('A1:AH5')
            ->getStyle('A1')->applyFromArray($style_col);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

        $spreadsheet->getActiveSheet()
            ->setCellValue('A6', 'No.')
            ->setCellValue('B6', 'Tanggal')
            ->setCellValue('C6', 'Nama')
            ->setCellValue('D6', 'Instansi')
            ->setCellValue('E6', 'Email')
            ->setCellValue('F6', 'No. Telepon / Hp')
            ->setCellValue('G6', 'Layanan')
            ->getStyle('A6:AH6')->applyFromArray($style_col);

        $questions = $this->quest->get();
        $column = 8;
        foreach ($questions as $question) {
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($column, 6, $question['question']);
            $column++;
        }

        $number = 1;
        $numrow = 7;
        foreach ($datas as $data) {
            $sheet =  $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A' . $numrow, $number);
            $sheet->setCellValue('B' . $numrow, $data['created_at']);
            $sheet->setCellValue('C' . $numrow, $data['name']);
            $sheet->setCellValue('D' . $numrow, $data['company']);
            $sheet->setCellValue('E' . $numrow, $data['email']);
            $sheet->setCellValue('F' . $numrow, $data['phone_number']);
            $sheet->setCellValue('G' . $numrow, $data['sub_field_name']);
            $sheet->setCellValue('H' . $numrow, $data['first_a']);
            $sheet->setCellValue('I' . $numrow, $data['first_b']);
            $sheet->setCellValue('J' . $numrow, $data['first_c']);
            $sheet->setCellValue('K' . $numrow, $data['second_a']);
            $sheet->setCellValue('L' . $numrow, $data['second_b']);
            $sheet->setCellValue('M' . $numrow, $data['second_c']);
            $sheet->setCellValue('N' . $numrow, $data['third_a']);
            $sheet->setCellValue('O' . $numrow, $data['third_b']);
            $sheet->setCellValue('P' . $numrow, $data['third_c']);
            $sheet->setCellValue('Q' . $numrow, $data['forth_a']);
            $sheet->setCellValue('R' . $numrow, $data['forth_b']);
            $sheet->setCellValue('S' . $numrow, $data['forth_c']);
            $sheet->setCellValue('T' . $numrow, $data['fifth_a']);
            $sheet->setCellValue('U' . $numrow, $data['fifth_b']);
            $sheet->setCellValue('V' . $numrow, $data['fifth_c']);
            $sheet->setCellValue('W' . $numrow, $data['sixth_a']);
            $sheet->setCellValue('X' . $numrow, $data['sixth_b']);
            $sheet->setCellValue('Y' . $numrow, $data['sixth_c']);
            $sheet->setCellValue('Z' . $numrow, $data['seventh_a']);
            $sheet->setCellValue('AA' . $numrow, $data['seventh_b']);
            $sheet->setCellValue('AB' . $numrow, $data['seventh_c']);
            $sheet->setCellValue('AC' . $numrow, $data['eigth_a']);
            $sheet->setCellValue('AD' . $numrow, $data['eigth_b']);
            $sheet->setCellValue('AE' . $numrow, $data['eigth_c']);
            $sheet->setCellValue('AF' . $numrow, $data['ninth_a']);
            $sheet->setCellValue('AG' . $numrow, $data['ninth_b']);
            $sheet->setCellValue('AH' . $numrow, $data['ninth_c']);

            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('V' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AB' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('AH' . $numrow)->applyFromArray($style_row);

            $number++;
            $numrow++;
        }

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);


        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan Survey (' . $startDate . '-' . $endDate . ').xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
