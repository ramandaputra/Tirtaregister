<?php

$k = 'TANJUNG UBAN KOTA';
$w = DB::table('wilayah_operasional')->where('kelurahan_desa', 'LIKE', '%'.$k.'%')->first();
var_dump($w ? $w->namaarea : 'not found');
