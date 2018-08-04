# PHP Native CRUD Library

Bismillahirohmanirrohim, pada kesempatan kali ini saya akan mencoba membagikan cara ringkas dalam membuat Create Read Update & Delete pada PHP Native. metode ini cocok untuk anda yang sedang membuat skripsi, ujian praktikum ataupun yang lainnya selama projectnya masih bersekala kecil kecilan saja.

>Warning! Sangat tidak disarankan untuk digunakan dalam project bersekala besar seperti membuat ERP dsb..
>Jika anda sudah pernah menggunakan framework PHP seperti Laravel, CI, Yii, Symphony dan lainnya, maka sudah tidak asing lagi dengan yang namanya Design Pattern. Disini pun kita akan menggunakan konsep design pattern, ya walaupun ga design-pattern2 banget sih..

Oiya sebelumnya saya akan berasumsi bahwa Anda sudah mengerti konsep dasar membuat Web dengan PHP, yang didalamnya Anda perlu menginstall server seperti (apache/nginx), mysql/mariaDB dan tentu PHP itu sendiri. *disarankan menggunakan PHP 5.2 keatas. Pada kasus kali ini saya menggunakan PHP 7.1


## Step 1

Clone repository ini ke project Anda.

## Step 2

Ketika sudah membuat Library.php maka Anda sudah dapat memakainya dimanapun sesuai kebutuhan, pada step kali ini saya akan mencontohkannya untuk pemakaian pada index, create, update dan delete.
Struktur folder yang akan kita gunakan seperti dibawah ini :

-> Folder
   '-> Library.php
   '-> create.php
   '-> delete.php
   '-> form.php
   '-> index.php
   '-> update.php

Oke setelah itu kita coba buat index.php sebagai list index daftar itemnya, sebagai contoh pada kali ini saya akan membuat database dengan tabel seperti dibawah ini :

| Field         | Type          | Extra |
| ------------- |:-------------:| -----:|
| id            | int(11)       | AI    |
| kode          | varchar(32)   | NULL  |
| nama          | varchar(32)   | NULL  |
| harga         | Float         | NULL  |


