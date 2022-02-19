 <?php

class PDF extends FPDF{
	function letak($gambar){
	//memasukkan gambar untuk header
	$this->Image($gambar,10,6,25,25);
	//menggeser posisi sekarang
	}

	function judul($teks1, $teks2, $teks3, $teks4, $teks5){
	$this->Cell(15);
	$this->SetFont('Times','B','17');
	$this->Cell(0,5,$teks1,0,1,'C');
	$this->Cell(15);
	$this->SetFont('Times','B','12');
	$this->Cell(0,5,$teks2,0,1,'C');
	$this->Cell(15);
	$this->Cell(0,5,$teks3,0,1,'C');
	$this->Cell(15);
	$this->SetFont('Times','I','9');
	$this->Cell(0,5,$teks4,0,1,'C');
	$this->Cell(15);
	$this->Cell(0,2,$teks5,0,1,'C');
	}
	function garis(){
	$this->SetLineWidth(1);
	$this->Line(10,36,200,36);
	$this->SetLineWidth(0);
	$this->Line(10,37,200,37);
	}

	function surat($nomor, $berkas, $hal){
		$this->Ln(5);
		$this->SetFont('Times','',8);
		$date = date('d F Y');
		$this->Cell(0,5,'Sukabumi,'.$date,0,1,'R');
		$this->SetFont('Times','',12);
		$this->Cell(10,5,'Nomor',0,0,'L');
		$this->Cell(15);
		$this->Cell(2,5,':',0,0,'L');
		$this->Cell(5);
		$this->Cell(1,5,$nomor,0,1,'L');
		$this->Cell(10,5,'Lampiran',0,0,'L');
		$this->Cell(15);
		$this->Cell(2,5,':',0,0,'L');
		$this->Cell(5);
		$this->Cell(1,5,$berkas,0,1,'L');
		$this->Cell(10,5,'Perihal',0,0,'L');
		$this->Cell(15);
		$this->Cell(2,5,':',0,0,'L');
		$this->Cell(5);
		$this->Cell(1,5,$hal,0,1,'L');
		$this->SetFont('Times','',12);
	}
	function tujuan($Industri,$alamat){
		$this->Ln(5);
		$this->SetFont('Times','',12);
		$this->Cell(10,5,'Kepada Yth,',0,1,'L');
		$this->Cell(10,5,$Industri,0,1,'L');
		$this->Cell(10,5,'Bapak/Ibu',0,1,'L');
		$this->Cell(10,5,'Di',0,1,'L');
		$this->Cell(10,5,$alamat,0,1,'L');
	}
	function kepsek(){
		$this->Ln(5);
		$this->Cell(130);
		$this->Cell(0,5,'Direktur,',0,1,'L');
		$this->Cell(130);
		$this->Cell(0,5,'Politeknik Sukabumi.',0,1,'L');	
	}
	function kepsek2(){
		$this->Ln(14);
		$this->Cell(130);
		$this->SetFont('Times','B',12);
		$this->Cell(0,5,'Nonda Muldani, ST.,M.Kom',0,1,'L');
		$this->SetFont('Times','',12);
		$this->Cell(130);
		$this->Cell(0,5,'NIDN.0430067203,',0,1,'L');
	}

	function barcode($barcode,$legal){
		
		$this->Ln(5);
		$this->Image($barcode,10,277,25,10);
		$this->Ln(8);
		$this->SetY(-15);
	    $this->SetFont('Times','I',8);
		$this->Cell(0,-8,$legal,0,0,'R');
	}
}
	$pdf=new pdf();

	// $pdf->SetAuthor('Ramlan Ramdani | http://polteksmi.ac.id | ramlanramdani3@gmail.com');
	$pdf->SetTitle('Surat Pengajuan Prakerin');
	$pdf->AddPage('P', 'A4');

	$pdf->letak(base_url('adminBSB/images/Politeknik2.png'));
	$pdf->judul('POLITEKNIK SUKABUMI','PRAKTIK KERJA INDUSTRI', 'BIRO ADMINIDTRASI AKADEMIS KEMAHASISWAAN','Jl. Babakan Sirna No.25 Benteng Sukabumi 43132 Telp. (0266) 215417', 'Website: http://polteksmi.ac.id | E-Mail: backoffice@polteksmi.ac.id');
	$pdf->garis();
	$pdf->surat('  / KK.06.11/1/Polteksmi/PP.'.$date= date('d-F-Y'), '-', 'Permohonan Izin Praktik Kerja Industri Mahasiswa');
	
	$pdf->Ln(5);
	$alamat_kecil = strtolower($list->alamat.", ".$list->namakecamatan.", ".$list->namakota.", ".$list->name);
    $alamat_new = ucwords($alamat_kecil);
	$pdf->tujuan($list->namaindustri,$alamat_new);

	$pdf->Ln(8);
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,5,'Dengan hormat,dalam rangka pelaksanaa program akademik, Program Studi D-III  Politeknik Sukabumi mewajibkan pada mahasiswa untuk melaksanakan Praktik Kerja Industri pada semester IV(Empat).',0,'LR');

	$pdf->Ln(8);
	$pdf->MultiCell(0,5,'Oleh Karena itu kami memohon kesediaan Bapak/ibu agar dapat menerima mahasiswa kami untuk melaksanakan Praktik Kerja Industri (Prakerin) selama 2 (dua) bulan di '. $list->namaindustri . ', terhitung mulai tanggal '.date("d F ", strtotime($list->tglmulai)). ' s.d '.date("d F Y", strtotime($list->tglakhir)).'.' ,0,'LR');


	$pdf->Ln(5);
    $pdf->Cell(0,5, "Adapun mahasiswa kami tersebut adalah:",0, "LR");

 if(!empty($listt)){ 	
   $pdf->Ln(10);
   $pdf->SetX(10);
   $pdf->SetFont('Times','',12);
   $pdf->SetLineWidth(0);
   $pdf->Cell(7,10,"No",1,"LR","C",0,0);
   $pdf->Cell(30,10,"Nim",1 ,"LR", "C", 0,0);
   $pdf->Cell(70,10,"Nama",1 ,"LR", "C", 0,0);
   $pdf->Cell(30,10,"No telepon",1 ,"LR", "C", 0,0);
   $pdf->Cell(55,10,"jurursan",1 ,"LR", "C", 0,0);
  
   
   $pdf->Ln();
      
       $no = 0;
       $nilaiY = $pdf->GetY();
       foreach ($listt as $foto){
           $no ++;
           $pdf->SetX(10);
           $pdf->Cell(7,10,	$no,1,"LR","C");
           $pdf->Cell(30,10,   $foto->nim,1,"LR","C");
           $pdf->Cell(70,10,   $foto->nama,1,"LR","C");
           $pdf->Cell(30,10,   $foto->notelepon,1,"LR","C");
           $pdf->Cell(55,10,   $foto->namajurusan ,1,"LR","C");
           $pdf->Ln();
           $nilaiY = $pdf->GetY();
       }
   }


    $pdf->Ln(5);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0,5, "Demikian harapan kami, atas bantuan dan kerja sama yang baik kami ucapkan terima kasih.",0, "LR");

    $pdf->Ln(8);
	$pdf->kepsek();
	$pdf->Ln(5);
    $pdf->Cell(10);
	$pdf->kepsek2();
	$pdf->barcode($list->barcode,'printed on: '.$date=date('d F Y').' by '.$this->session->userdata('SESS_NAME'));
	$pdf->Output('Surat_Pengajuan_'.$list->idpengajuan.'_'. date ('d_F_Y').'.pdf','I');

 ?>