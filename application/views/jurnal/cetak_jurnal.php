<?php


class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image(base_url('adminBSB/images/Politeknik2.png'),10,6,25,25);
        
        // Geser Ke Kanan 35mm
        $this->Cell(15);
        
        // Judul
        $this->SetFont('Times','B','17');
        $this->Cell(0,5,'Jurnal Kegiatan Mahasiswa',0,1,'C');
       
        $this->Cell(15);
        $this->SetFont('Times','B','12');
        $this->Cell(0,5,'POLITEKNIK SUKABUMI',0,1,'C');
        $this->Cell(15);
        $this->SetFont('Times','I','9');
        $this->Cell(0,5,'Jl. Babakan Sirna No.25 Benteng Sukabumi 43132 Telp. (0266) 215417',0,1,'C');
        $this->Cell(15);
        $this->Cell(0,2,'Website: http://polteksmi.ac.id | E-Mail: backoffice@polteksmi.ac.id',0,1,'C');
        
        // Garis Bawah Double
        $this->SetLineWidth(1);
        $this->Line(10,36,200,36);
        $this->SetLineWidth(0);
        $this->Line(10,37,200,37);
        
        // Line break 5mm
        $this->Ln(5);
    }

    // Page footer
    function Footer()
    {
        // Posisi 15 cm dari bawah
        // $this->SetY(-18);
        // $barcode=$this->Image(base_url('adminBSB/barcode/PNG1801000001.jpg'));
        // $this->Cell(0,10,$barcode,0,0,'L');
        // Arial italic 8
        $this->SetY(-20);
        $this->SetFont('Arial','I',8);
        
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function surat($nim, $nama_mahasiswa, $nama_industri,$alamat,$tanggal_mulai,$tanggal_selesai){
        $this->Ln(8);
        $this->SetFont('Times','',8);
        // $date = date('d F Y');
        // $this->Cell(0,5,'Sukabumi,'.$date,0,1,'R');
        $this->SetFont('Times','',12);
        $this->Cell(10,5,'Nim',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$nim,0,1,'L');

        $this->Cell(10,5,'Nama Mahasiswa',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$nama_mahasiswa,0,1,'L');

        $this->Cell(10,5,'Nama industri',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$nama_industri,0,1,'L');

        $this->Cell(10,5,'Alamat',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$alamat,0,1,'L');

        $this->Cell(10,5,'Tanggal Mulai Prakerin',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$tanggal_mulai,0,1,'L');

        $this->Cell(10,5,'Tanggal Berakhir Prakerin',0,0,'L');
        $this->Cell(37);
        $this->Cell(2,5,':',0,0,'L');
        $this->Cell(5);
        $this->Cell(1,5,$tanggal_selesai,0,1,'L');
        // $this->SetFont('Times','',12);
    }
}

    //Membuat file PDF
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetTitle('Jurnal Mahasiswa');
    $pdf->AddPage('P', 'A4');
    $pdf->SetFont('Times','',12);

    $alamat_kecil = strtolower($list->alamatindustri." ".$list->namakecamatan.", ".$list->namakota.", ".$list->name);
    $alamat_new = ucwords($alamat_kecil);
    $pdf->surat($list->nim,$list->nama,$list->namaindustri,$alamat_new,date("d F Y", strtotime($list->tglmulai)),date("d F Y", strtotime($list->tglselesai)) );

    if(!empty($jurnal)){     
       $pdf->Ln(10);
       $pdf->SetX(10);
       $pdf->SetFont('Times','',12);
       $pdf->SetLineWidth(0);
       $pdf->Cell(8,10,"No",1,"LR","C",0,0);
       $pdf->Cell(40,10,"Tanggal",1 ,"LR", "C", 0,0);
       $pdf->Cell(102,10,"Kegiatan",1 ,"LR", "C", 0,0);
       $pdf->Cell(40,10,"Status",1 ,"LR", "C", 0,0);

       $pdf->Ln();
          
           $no = 0;
           $nilaiY = $pdf->GetY();
           foreach ($jurnal as $row){
               $no ++;
               $pdf->SetX(10);
               $pdf->Cell(8,10, $no,1,"LR","C");
               $pdf->Cell(40,10,   date("d F Y", strtotime($row->tanggal_kegiatan)),1,"LR","C");
               $pdf->Cell(102,10,  $row->kegiatan,1,"LR","C");
               $pdf->Cell(40,10,   $row->status,1,"LR","C");
               $pdf->Ln();
               $nilaiY = $pdf->GetY();
           }
       }


    $pdf->Output('Jurnal_Prakerin_'.$list->idprakerin.'_'. date ('d_F_Y').'.pdf','I');
?>