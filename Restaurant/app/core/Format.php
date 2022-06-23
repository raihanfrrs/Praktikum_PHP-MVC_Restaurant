<?php 

class Format{

	public function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka, 0, ",", ".");
		return $hasil_rupiah;
	}

	public function currentText($data, $index){
		$arr = explode(' ', trim($data));

		return ucwords($arr[$index]);
	}
}