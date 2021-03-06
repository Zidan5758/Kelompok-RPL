<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelola_alat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->fungsi->restrict();
		$this->load->model('kelola/m_kelola_alat');
		$this->load->model('master/m_nama_alat');
		$this->load->model('master/m_satuan');
		$this->load->model('master/m_kategori_alat_dan_bahan');
		$this->load->model('master/m_sumber_pendanaan');
		$this->load->model('kelola/m_kelola_penyimpanan');
	}

	public function index()
	{
		$this->fungsi->check_previleges('kelola_alat');
		$data['kelola_alat'] = $this->m_kelola_alat->join();
		$data['data_peminjaman'] = $this->m_kelola_alat->get_peminjaman();
		$this->load->view('kelola/kelola_alat/v_kelola_alat_list1',$data);
	}
    public function form($param='')
	{
		$content   = "<div id='divsubcontent'></div>";
		$header    = "Form Kelola Nama Alat";
		$subheader = "kelola_alat";
		$buttons[] = button('jQuery.facebox.close()','Tutup','btn btn-default','data-dismiss="modal"');
		echo $this->fungsi->parse_modal($header,$subheader,$content,$buttons,"");
		if($param=='base'){
			$this->fungsi->run_js('load_silent("kelola/kelola_alat/show_addForm/","#divsubcontent")');	
		}
		else{
			$base_kom=$this->uri->segment(5);
			$this->fungsi->run_js('load_silent("kelola/kelola_alat/show_editForm/'.$base_kom.'","#divsubcontent")');	
		}
	}
    public function listpinjam($param='',$id)
	{
		$content   = "<div id='divsubcontent'></div>";
		$header    = "Form Kelola Nama Alat";
		$subheader = "kelola_alat";
		$buttons[] = button('jQuery.facebox.close()','Tutup','btn btn-default','data-dismiss="modal"');
		echo $this->fungsi->parse_modal($header,$subheader,$content,$buttons,"");
		if($param=='pinjam'){
			$this->fungsi->run_js('load_silent("kelola/kelola_alat/showpinjam/'.$id.'","#divsubcontent")');	
		}
		else{
			$base_kom=$this->uri->segment(5);
			$this->fungsi->run_js('load_silent("kelola/kelola_alat/showhabis/'.$id.'","#divsubcontent")');	
		}
	}
	public function showpinjam($id)
	{
		$data['detail']=$this->m_kelola_alat->pinjamalat($id);
		$this->load->view('kelola/kelola_alat/dipinjam',$data);
	}
	public function show_addForm()
	{
		$this->fungsi->check_previleges('kelola_alat');
		$this->load->library('form_validation');
		$config = array(
				array(
					'field'	=> 'id_nama_alat',
					'label' => 'id_nama_alat',
					'rules' => 'required'
                ),
                array(
					'field'	=> 'satuan_alat',
					'label' => 'satuan_alat',
                    'rules' => 'required'
				),
                array(
					'field'	=> 'tahun',
					'label' => 'Tahun',
                    'rules' => 'required'
                )
			);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<span class="error-span">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$data['nama_alat'] = $this->m_nama_alat->getData();
			$data['satuan'] = $this->m_satuan->getData();
			$data['kategori'] = $this->m_kategori_alat_dan_bahan->getData();
			$data['dana'] = $this->m_sumber_pendanaan->getData();
			$data['lokasi'] = $this->m_kelola_penyimpanan->getDatatersedia();
			$data['kondisi'] = $this->m_nama_alat->getDatakondisi();
			// $data['status']='';
			$this->load->view('kelola/kelola_alat/v_kelola_alat_add1',$data);
		}
		else
		{
			$datapost = get_post_data(array('id','id_nama_alat','satuan_alat','kategori', 'stok', 'stok_minimal', 'lokasi', 'pendanaan', 'harga', 'kondisi','tahun','keterangan'));
			$this->m_kelola_alat->insertData($datapost);
			$this->fungsi->run_js('load_silent("kelola/kelola_alat","#content")');
			$this->fungsi->message_box("Data Kelola Nama Alat sukses disimpan...","success");
			$this->fungsi->catat($datapost,"Menambah Kelola kelola_alat dengan data sbb:",true);
		}
	}

	public function show_editForm($id='')
	{
		$this->fungsi->check_previleges('kelola_alat');
		$this->load->library('form_validation');
		$config = array(
			array(
				'field'	=> 'id',
				'label' => 'wes mbarke',
				'rules' => ''
			),
			array(
				'field'	=> 'id_nama_alat',
				'label' => 'id_nama_alat',
				'rules' => 'required'
            ),
            array(
				'field'	=> 'satuan_alat',
				'label' => 'satuan_alat',
				'rules' => 'required'
			)
		);
	$this->form_validation->set_rules($config);
	$this->form_validation->set_error_delimiters('<span class="error-span">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$data['edit'] = $this->db->get_where('kelola_alat',array('id'=>$id));
			$data['nama_alat'] = $this->m_nama_alat->getData();
			$data['satuan'] = $this->m_satuan->getData();
			$data['kategori'] = $this->m_kategori_alat_dan_bahan->getData();
            $data['dana'] = $this->m_sumber_pendanaan->getData();
			$data['lokasi'] = $this->m_kelola_penyimpanan->getDatatersedia();
			$data['kondisi'] = $this->m_nama_alat->getDatakondisi();

			$this->load->view('kelola/kelola_alat/v_kelola_alat_edit1',$data);
		}
		else
		{
			$datapost = get_post_data(array('id','id_nama_alat','satuan_alat','kategori', 'stok', 'stok_minimal', 'lokasi', 'pendanaan', 'harga', 'kondisi','tahun','keterangan'));
			$this->m_kelola_alat->updateData($datapost);
			$this->fungsi->run_js('load_silent("kelola/kelola_alat","#content")');
			$this->fungsi->message_box("Data Kelola Nama Alata sukses diperbarui...","success");
			$this->fungsi->catat($datapost,"Mengedit Kelola kelola_alat dengan data sbb:",true);
		}
	}
	public function delete($id)
	{
		$this->fungsi->check_previleges('kelola_alat');
		if($id == '' || !is_numeric($id)) die;
		$this->m_kelola_alat->deleteData($id);
		$this->fungsi->run_js('load_silent("kelola/kelola_alat","#content")');
		$this->fungsi->message_box("Data Kelola alat berhasil dihapus...","notice");
		$this->fungsi->catat("Menghapus laporan dengan id ".$id);
	}
	public function show_view()
	{
		$this->fungsi->check_previleges('kelola_alat');
		$data['kelola_alat'] = $this->m_kelola_alat->getData();
		$this->load->view('kelola/kelola_alat/v_kelola_alat_seri_list',$data);
	}
	
	public function cetak()
	{
<<<<<<< HEAD
		$this->load->library("excel");
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		
		$table_columns = array("No", "Nama Alat", "Nama Satuan", "Kategori", "Stock", "Stock Dipinjam", "Stock Tersedia", "Stock Minimal", "Lokasi", "Pendanaan", "Harga", "Kondisi", "Keterangan");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		
		$data = $this->m_kelola_alat->join()->result();
		$peminjaman = $this->m_kelola_alat->get_peminjaman();
		$excel_row = 2;
		$i = 1;
		foreach($data as $row)
		{
			if($row->kondisi==1){
				$kondisi="Sangat Baik";
			}else if($row->kondisi==2){
				$kondisi="Baik";
			}else if($row->kondisi==3){
				$kondisi="Cukup";
			}else if($row->kondisi==4){
				$kondisi="Kurang";
			}else{
				$kondisi="Rusak";
			} 
			$stocktersedia=$row->stok-@$peminjaman[$row->id];
			
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nama_alat);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nama_satuan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->kategori_alat_bahan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->stok);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, '');
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $stocktersedia);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->stok_minimal);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->Nama_penyimpanan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->sumber_pendanaan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, 'Rp. '.number_format($row->harga));
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $kondisi);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->keterangan);
			$excel_row++;
			$i++;
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Kelola Alat.xlsx"');
		$object_writer->save('php://output');
=======
		$this->fungsi->check_previleges('kelola_alat');
		$data['kelola_alat'] = $this->m_kelola_alat->join();
		$data['data_peminjaman'] = $this->m_kelola_alat->get_peminjaman();
		$this->load->view('kelola/kelola_alat/v_cetak_kelola_alat',$data);
>>>>>>> 9ce1c66a8f246f56736af96e4c9927e1f0abcc10
	}
}