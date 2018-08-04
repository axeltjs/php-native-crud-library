<?php

class Library
{	
	public $koneksi;
	
	function __construct()
	{
		$this->koneksi = mysqli_connect('localhost','root','','nama_database');
	}

	/**
	 * @param string nama table
	 * @return Query result
	 */

	public function get($table)
	{
		$data = mysqli_query($this->koneksi, "SELECT * FROM $table") 
			or die($this->koneksi->error);
		return $data;
	}

	/**
	 * @param string nama table
	 * @param string nama field yang berperan sebagai kunci utama / primary key
	 * @param string value record
	 * @return Query result
	 */

	public function find($table, $key, $id)
	{
		$data = mysqli_query($this->koneksi, "SELECT * FROM $table WHERE $key = $id") 
			or die($this->koneksi->error);
		return $data;
	}

	/**
	 * @param string nama table
	 * @param array isi record yang akan disimpan
	 * @return query result
	 */

	public function insert($table, $data)
	{
		$raw_value = array_values($data);
		$value = implode("', '", $raw_value);

		return mysqli_query($this->koneksi, "INSERT INTO $table VALUES('$value') ") 
			or die($this->koneksi->error);
	}

	/**
	 * @param string nama table
	 * @param array isi record yang akan diperbarui
	 * @param string nama field primary key
	 * @param string value dari record primary key
	 * @return query result
	 */ 

	public function update($table, $data, $key, $id)
	{
		$this->delete($table, $key, $id);
		return $this->insert($table, $data);
	}

	/**
	 * @param string nama table
	 * @param string nama field yang berperan sebagai kunci utama / primary key
	 * @param string value record
	 * @return query result
	 */

	public function delete($table, $key, $id)
	{
		return mysqli_query($this->koneksi, "DELETE FROM $table WHERE $key = $id") 
			or die($this->koneksi->error);
	}

	/**
	 * @param string URL
	 * @param string keterangan : e.g menghapus, mengubah, dsb...
	 * @return redirect
	 */

	public function redirect($value, $comment = 'menambah')
	{
		return "<script>alert('berhasil ".$comment." data.'); window.location = '".$value."'; </script>";
	}
}
