<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_bahan extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->fungsi->restrict();
        $this->load->model('kelola/m_kelola_bahan');
		$this->load->model('master/m_master_bahan');
		$this->load->model('master/m_satuan');
		$this->load->model('master/m_kategori_alat_dan_bahan');
		$this->load->model('master/m_sumber_pendanaan');
		$this->load->model('kelola/m_kelola_penyimpanan');
		$this->load->model('master/m_nama_alat');
    }

    public function index()
    {
        $this->fungsi->check_previleges('kelola_bahan');
		$data['kelola_bahan'] = $this->m_kelola_bahan->getData();
		$data['data_peminjaman'] = $this->m_kelola_bahan->get_peminjaman();
		$data['data_hapus'] = $this->m_kelola_bahan->get_hapus();
        $this->load->view('kelola/kelola_bahan/kelola_bahan_list', $data);
    }

    public function form($param='')
	{
		$content   = "<div id='divsubcontent'></div>";
		$header    = "Form Kelola Bahan";
		$subheader = "kelola_bahan";
		$buttons[] = button('jQuery.facebox.close()','Tutup','btn btn-default','data-dismiss="modal"');
		echo $this->fungsi->parse_modal($header,$subheader,$content,$buttons,"");
		if($param=='base'){
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan/show_addForm/","#divsubcontent")');	
		}
		else{
			$base_kom=$this->uri->segment(5);
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan/show_editForm/'.$base_kom.'","#divsubcontent")');	
		}
	}

    public function show_addForm()
	{
		$this->fungsi->check_previleges('kelola_bahan');
		$this->load->library('form_validation');
		$config = array(
				array(
					'field'	=> 'id_nama_bahan',
					'label' => 'id_nama_alat',
					'rules' => 'required'
                ),
                array(
					'field'	=> 'satuan_bahan',
					'label' => 'satuan_alat',
                    'rules' => 'required'
                )
			);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<span class="error-span">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$data['nama_bahan'] = $this->m_master_bahan->getData();
			$data['satuan'] = $this->m_satuan->getData();
			$data['kategori'] = $this->m_kategori_alat_dan_bahan->getData();
			$data['dana'] = $this->m_sumber_pendanaan->getData();
			$data['lokasi'] = $this->m_kelola_penyimpanan->getDatatersedia();
			$data['kondisi'] = $this->m_nama_alat->getDatakondisi();
			// $data['status']='';
			$this->load->view('kelola/kelola_bahan/kelola_bahan_add',$data);
		}
		else
		{
			$datapost = get_post_data(array('id','id_nama_bahan','satuan_bahan','kategori', 'stock', 'stock_minimal', 'lokasi', 'pendanaan', 'harga', 'jenis','kondisi','tahun','keterangan'));
            $this->m_kelola_bahan->insertData($datapost);
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan","#content")');
			$this->fungsi->message_box("Data Kelola Nama Bahan sukses disimpan...","success");
			$this->fungsi->catat($datapost,"Menambah Kelola kelola_bahan dengan data sbb:",true);
		}
    }
	public function listpinjam($param='',$id)
	{
		$content   = "<div id='divsubcontent'></div>";
		$header    = "Form Kelola Bahan";
		$subheader = "kelola bahan";
		$buttons[] = button('jQuery.facebox.close()','Tutup','btn btn-default','data-dismiss="modal"');
		echo $this->fungsi->parse_modal($header,$subheader,$content,$buttons,"");
		if($param=='pinjam'){
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan/showpinjam/'.$id.'","#divsubcontent")');	
		}
		else{
			$base_kom=$this->uri->segment(5);
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan/showhabis/'.$id.'","#divsubcontent")');	
		}
	}
	public function showpinjam($id)
	{
		$data['detail']=$this->m_kelola_bahan->pinjambahan($id);
		$this->load->view('kelola/kelola_bahan/dipinjam',$data);
	}
	public function showhabis($id)
	{
		$data['detail']=$this->m_kelola_bahan->habisbahan($id);
		$this->load->view('kelola/kelola_bahan/habis',$data);
	}
    public function show_editForm($id='')
	{
		$this->fungsi->check_previleges('kelola_bahan');
		$this->load->library('form_validation');
		$config = array(
			array(
				'field'	=> 'id_nama_bahan',
				'label' => 'id_nama_alat',
				'rules' => 'required'
            ),
            array(
				'field'	=> 'satuan_bahan',
				'label' => 'satuan_bahan',
				'rules' => 'required'
			)
		);

	    $this->form_validation->set_rules($config);
	    $this->form_validation->set_error_delimiters('<span class="error-span">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$data['edit'] = $this->db->get_where('kelola_bahan',array('id'=>$id));
			$data['nama_bahan'] = $this->m_master_bahan->getData();
			$data['satuan'] = $this->m_satuan->getData();
			$data['kategori'] = $this->m_kategori_alat_dan_bahan->getData();
            $data['dana'] = $this->m_sumber_pendanaan->getData();
			$data['lokasi'] = $this->m_kelola_penyimpanan->getDatatersedia();
			$data['kondisi'] = $this->m_nama_alat->getDatakondisi();

		$this->load->view('kelola/kelola_bahan/kelola_bahan_edit',$data);
		}
		else
		{
			$datapost = get_post_data(array('id','id_nama_bahan','satuan_bahan','kategori', 'stock', 'stock_minimal', 'lokasi', 'pendanaan', 'harga','jenis','kondisi','tahun','keterangan'));
			$this->m_kelola_bahan->updateData($datapost);
			$this->fungsi->run_js('load_silent("kelola/kelola_bahan","#content")');
			$this->fungsi->message_box("Data Kelola Bahan sukses diperbarui...","success");
			$this->fungsi->catat($datapost,"Mengedit Kelola kelola_alat dengan data sbb:",true);
		}
	}

    public function delete($id)
    {
        $this->fungsi->check_previleges('kelola_bahan');
		if($id == '' || !is_numeric($id)) die;
		$this->m_kelola_bahan->deleteData($id);
		$this->fungsi->run_js('load_silent("kelola/kelola_bahan","#content")');
		$this->fungsi->message_box("Data Kelola Bahan Berhasil dihapus...","notice");
		$this->fungsi->catat("Menghapus laporan dengan id ".$id);
    }
	
	public function cetak()
    {
<<<<<<< HEAD
		$this->load->library("excel");
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		
		$table_columns = array("No", "Nama Bahan", "Jenis", "Tahun", "Kategori", "Stock", "Stock Dipinjam", "Stock Habis", "Stock Ada", "Stock Minimal", "Lokasi", "Pendanaan", "Harga", "Kondisi", "Keterangan");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		
		$data = $this->m_kelola_bahan->getData()->result();
		$peminjaman = $this->m_kelola_bahan->get_peminjaman();
		$hapus = $this->m_kelola_bahan->get_hapus();
		$excel_row = 2;
		$i = 1;
		foreach($data as $row)
		{
			$stok_real=$row->stock-@$peminjaman[$row->id]-@$hapus[$row->id];
			if(isset($hapus[$row->id])){
				$stok_hapus = button('load_silent("kelola/kelola_bahan/listpinjam/hapus/'.$row->id.'","#modal")',@$hapus[$row->id],'btn btn-info','data-toggle="tooltip" title="Edit"');
			}
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nama_bahan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, ($row->jenis==1)?'Habis Pakai':'Non Habis Pakai');
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->tahun);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->kategori_alat_bahan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->stock);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, '');
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $stok_real);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->stock_minimal);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->Nama_penyimpanan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->sumber_pendanaan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Rp. '.number_format($row->harga));
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->kond);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->keterangan);
			$excel_row++;
			$i++;
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Kelola Bahan.xlsx"');
		$object_writer->save('php://output');
    }
	
	public function cek()
	{
        $this->fungsi->check_previleges('kelola_bahan');
		$data['kelola_bahan'] = $this->m_kelola_bahan->getData()->result();
		$data['data_peminjaman'] = $this->m_kelola_bahan->get_peminjaman();
		$data['data_hapus'] = $this->m_kelola_bahan->get_hapus();
		
		print_r($data['kelola_bahan']);
	}
=======
        $this->fungsi->check_previleges('kelola_bahan');
		$data['kelola_bahan'] = $this->m_kelola_bahan->getData();
		$data['data_peminjaman'] = $this->m_kelola_bahan->get_peminjaman();
		$data['data_hapus'] = $this->m_kelola_bahan->get_hapus();
        $this->load->view('kelola/kelola_bahan/cetak_kelola_bahan', $data);
    }
>>>>>>> 9ce1c66a8f246f56736af96e4c9927e1f0abcc10
}