# PHP Native CRUD Library

Bismillahirohmanirrohim, pada kesempatan kali ini saya akan mencoba membagikan cara ringkas dalam membuat Create Read Update & Delete pada PHP Native. metode ini cocok untuk anda yang sedang membuat skripsi, ujian praktikum ataupun yang lainnya selama projectnya masih bersekala kecil kecilan saja.

>Warning! Sangat tidak disarankan untuk digunakan dalam project bersekala besar seperti membuat ERP dsb..

Jika anda sudah pernah menggunakan framework PHP seperti Laravel, CI, Yii, Symphony dan lainnya, maka sudah tidak asing lagi dengan yang namanya Design Pattern. Disini pun kita akan menggunakan konsep design pattern, ya walaupun ga design-pattern2 banget sih..

Oiya sebelumnya saya akan berasumsi bahwa Anda sudah mengerti konsep dasar membuat Web dengan PHP, yang didalamnya Anda perlu menginstall server seperti (apache/nginx), mysql/mariaDB dan tentu PHP itu sendiri. *disarankan menggunakan PHP 5.2 keatas. Pada kasus kali ini saya menggunakan PHP 7.1

---
Berikut contoh penggunaan : 

## Step 1

Clone repository ini ke project Anda.

## Step 2

Ketika sudah membuat Library.php maka Anda sudah dapat memakainya dimanapun sesuai kebutuhan, pada step kali ini saya akan mencontohkannya untuk pemakaian pada index, create, update dan delete.
Struktur folder yang akan kita gunakan seperti dibawah ini :

!['struktur folder'](https://image.ibb.co/cD7ErK/1_vcvp_W_ESv_Q7s_CA4p_B516ug.png)

Oke setelah itu kita coba buat index.php sebagai list index daftar itemnya, sebagai contoh pada kali ini saya akan membuat database dengan tabel seperti dibawah ini :

produk

| Field         | Type          | Extra |
| ------------- |:-------------:| -----:|
| id            | int(11)       | AI    |
| kode          | varchar(32)   | NULL  |
| nama          | varchar(32)   | NULL  |
| harga         | Float         | NULL  |

### Membuat index.php

```
<?php 
	include 'Library.php'; 
	$model = new Library;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contoh Simple & Fast CRUD</title>
</head>
<body>
	<h3>Daftar Produk</h3>
	<a href="create.php">Tambah Item</a>
	<br>
	<table width="100%" border="1">
		<tr>
			<td>Kode</td>
			<td>Nama</td>
			<td>Harga</td>
			<td>Opsi</td>
		</tr>
		<?php 
			$query = $model->get('produk');
			while($data = mysqli_fetch_array($query)): 
		?>
		<tr>
			<td><?php echo $data['kode'] ?></td>
			<td><?php echo $data['nama'] ?></td>
			<td>Rp. <?php echo number_format($data['harga']) ?></td>
			<td>
				<a href="update.php?id=<?php echo $data['id'] ?>">Edit</a> | 
				<a href="delete.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $data['nama'] ?> ?')">Delete</a>
			</td>
		</tr>
		<?php endwhile; ?>
	</table>	
</body>
</html>
```

### Membuat create.php

```
<?php 
	include 'Library.php'; 
	$model = new Library;
	if (isset($_POST['submit'])) {
		# Penulisan Array untuk php 5.2 => $array = array($_POST['kode'], $_POST['nama'], ...);
		$array = [
			null,
			$_POST['kode'],
			$_POST['nama'],
			$_POST['harga'],
		];
		$model->insert('produk', $array);
		echo $model->redirect('index.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contoh Simple & Fast CRUD</title>
</head>
<body>
<h3>Tambah Data</h3>
	<?php include('form.php') ?>
</body>
</html>
```

```
<form method="post">
	<table width="50%">
		<tr>
			<td width="10%">Kode</td>
			<td width="1%">:</td>
			<td>
				<input type="hidden" name="id" value="<?php echo $item['id'] ?>"></input>
				<input type="text" name="kode" value="<?php echo $item['kode'] ?>"></input>
			</td>
		</tr>
		<tr>
			<td width="10%">Nama</td>
			<td width="1%">:</td>
			<td>
				<input type="text" name="nama" value="<?php echo $item['nama'] ?>"></input>
			</td>
		</tr>
		<tr>
			<td width="10%">Harga</td>
			<td width="1%">:</td>
			<td>
				<input type="number" name="harga" value="<?php echo $item['harga'] ?>"></input>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="submit" name="submit" value="Simpan"></input>
			</td>
		</tr>
	</table>
</form>
```

mengapa kita membuat form.php ? karena ketika ada perubahan atau penambahan field pada tabel database atau ada perubahan tipe form, maka kita tidak perlu merubah satu per satu create dan edit nya :)

### Membuat update.php

```
<?php 
	include 'Library.php'; 
	$model = new Library;
	if (isset($_POST['submit'])) {
		# Mengecek apakah ID yang diinput itu ada..
		if($model->find('produk', 'id', $_POST['id']) == 1){
			# Penulisan Array untuk php 5.2 => $array = array($_POST['kode'], $_POST['nama'], ...);
			$array = [
				$_POST['id'],
				$_POST['kode'],
				$_POST['nama'],
				$_POST['harga'],
			];
			$model->update('produk', $array, 'id', $_POST['id']);
			echo $model->redirect('index.php','memperbarui');
		}
	}
	# mendapatkan 'current item'
	$item = mysqli_fetch_array($model->find('produk', 'id', $_GET['id']));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contoh Simple & Fast CRUD</title>
</head>
<body>
<h3>Update Data</h3>
	<?php include('form.php') ?>
</body>
</html>
```

Terakhir..
### Membuat delete.php

```
<?php 
include 'Library.php'; 
$model = new Library;
$model->delete('produk', 'id', $_GET['id']);
echo $model->redirect('index.php','menghapus');
```

