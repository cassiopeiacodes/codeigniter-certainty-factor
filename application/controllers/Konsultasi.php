<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('getdata');
	}

	public function index()
	{
		//get_class_methods($this->get_data('info_penyakit'));
		$data['gejala'] = $this->getdata->_resultDB('info_gejala');
		$data['check']	= $this->getdata->_resultDB('info_gejala','num_rows');

		$this->load->view('Konsultasi/header');
		$this->load->view('Konsultasi/konsultasi',$data);
    $this->load->view('Konsultasi/footer');
	}

	public function Hasil()
	{
		isset($_POST['pilihan']) ? '' : exit('No direct script access allowed');
		$arr = array(
			'table'			=> 'aturan',
			'where_in'	=> array(
				'key'		=> 'gejala_id',
				'data'	=> $_POST['pilihan'],
			),
		);

		$olah = $this->getdata->_resultDB($arr);

		$data['result']	 = $this->result_MYCIN($olah);
		$data['pilihan'] = $_POST['pilihan'];

		$this->load->view('Konsultasi/header');
		$this->load->view('Konsultasi/hasil',$data);
    $this->load->view('Konsultasi/footer');
	}

	/**
	*	Perhitungan MYCIN
	*/


	private function sortirProb( $items = array() )
	{
		if (!function_exists('sortByProb'))
		{
			function sortByProb( $a, $b )
			{
				return $a['hasil'] == $b['hasil'] ? 0 : ( $b['hasil'] < $a['hasil'] ? -1 : 1 );
			}
		}
		usort($items, 'sortByProb');

		return $items;
	}

	/* Penyelarasan data untuk ditampilkan */
	private function result_MYCIN( $items )
	{
		switch ( is_array($items) )
		{
			case TRUE:
			 $count = count($items);
			 break;

			default:
			 return exit('Terjadi kesalahan pada saat pemasukan data! Tidak dapat melanjutkan perhitungan. Harap masukkan data array.');
			 break;
		}

		foreach ($items as $val)
		{
			if ( array_key_exists('mb', $val) & array_key_exists('md',$val) & array_key_exists('id', $val) & array_key_exists('penyakit_id', $val) )
			{
				list( 'penyakit_id' => $penyakit, 'mb' => $mb, 'md' => $md, 'id' => $id ) = $val;

				$no	 = isset($no) & isset($prev) ? ( $penyakit === $prev ? $no + 1 : 0 ) : 0;
				$prev = isset($prev) ? ( $penyakit === $prev ? $prev : $penyakit ) : $penyakit;

				$data[$penyakit][$no]['mb'] = $mb;
				$data[$penyakit][$no]['md'] = $md;

				$gejala[$penyakit][$no] = $id;

				unset($penyakit, $mb, $md, $id);
			}
			else return exit('Terjadi kesalahan! Terdapat data yang tidak ditemukan. Harap periksa kembali data yang di masukkan untuk perhitungan.');
		}
		unset($val, $no, $prev);

		switch ( $count >= 2 )
		{
		 case TRUE:
		 	 $select = array(
				 'info_gejala.id as gejala_id',
				 'info_gejala.kode as gejala_kode',
				 'info_gejala.keterangan as gejala_nama',
				 'info_penyakit.kode as penyakit_kode',
				 'info_penyakit.nama as penyakit_nama',
				 'info_penyakit.keterangan as penyakit_keterangan'
			 );

			 foreach ( $data as $penyakit => $val )
			 {
				 $prob = $this->count($val);

				 if ( $prob != FALSE)
				 {
					 $no	 = isset($no) ? $no+1 : 0 ;

					 $output[$no]['penyakit']	= $penyakit;
					 $output[$no]['hasil'] 		= $prob;

					 $arr = array(
						 'table'			=> 'aturan',
						 'select'		=> implode(',',$select),
						 'where_in'	=> array(
							 'key'		=> 'aturan.penyakit_id',
							 'data'	=> $penyakit,
						 ),
						 'join' 		=> array(
							 array(
								 'table' 	=> 'info_penyakit',
								 'on'			=> 'info_penyakit.id = aturan.penyakit_id',
							 ),
							 array(
								 'table' => 'info_gejala',
								 'on'		=> 'info_gejala.id = aturan.gejala_id',
							 ),
						 ),
					 );
					 $output[$no]['info'] = $this->getdata->_resultDB($arr);
				 }
			 }
			 return isset($output) ? $this->sortirProb( $output ) : FALSE;
			 break;

		 default:
			 return FALSE;
			 break;
		}
	}

	/* Untuk mencari hasil perhitungan */
	private function count($data)
	{
		$key = array_keys($data);

		list($first) = $key;
		$last	= end($key);

		if ( $last == 0 ) $output = FALSE;
		else
		{
			foreach ($data as $no => [ 'mb' => $mb, 'md' => $md ])
			{
				$mb_lama = $first === $no ? $mb : ( $mb_lama + ( $mb * ( 1 - $mb_lama) ) );
				$md_lama = $first === $no ? $md : ( $md_lama + ( $md * ( 1 - $md_lama) ) );

				$output 	= $last === $no ? ( $mb_lama - $md_lama  ) : FALSE;
			}
		}

		return $output === FALSE ? FALSE : round( $output * 100 , 2, PHP_ROUND_HALF_UP );
	}
}
