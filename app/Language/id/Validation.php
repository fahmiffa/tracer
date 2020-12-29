<?php

/**
 * Validation language strings.
 *
 * @package      CodeIgniter
 * @author       CodeIgniter Dev Team
 * @copyright    2014-2019 British Columbia Institute of Technology (https://bcit.ca/)
 * @license      https://opensource.org/licenses/MIT	MIT License
 * @link         https://codeigniter.com
 * @since        Version 3.0.0
 * @filesource
 * 
 * @codeCoverageIgnore
 */

return [
	// Core Messages
	'noRuleSets'            => 'Tidak ada aturan yang ditentukan dalam konfigurasi Validasi.',
	'ruleNotFound'          => '{0} bukan sebuah aturan yang valid.',
	'groupNotFound'         => '{0} bukan sebuah grup aturan validasi.',
	'groupNotArray'         => '{0} grup aturan harus berupa sebuah array.',
	'invalidTemplate'       => '{0} bukan sebuah template Validasi yang valid.',

	// Rule Messages
	'alpha'                 => 'Field {field} hanya boleh mengandung karakter alfabet.',
	'alpha_dash'            => 'Field {field} hanya boleh berisi karakter alfanumerik, setrip bawah, dan tanda pisah.',
	'alpha_numeric'         => 'Field {field} hanya boleh berisi karakter alfanumerik.',
	'alpha_numeric_space'   => 'Field {field} hanya boleh berisi karakter alfanumerik dan spasi.',
	'alpha_space'  			=> 'Field {field} hanya boleh berisi karakter alfabet dan spasi.',
	'decimal'               => 'Field {field} harus mengandung sebuah angka desimal.',
	'differs'               => 'Field {field} harus berbeda dari Field {param}.',
	'equals'                => 'The {field} field must be exactly: {param}.',
	'exact_length'          => 'Field {field} harus tepat {param} panjang karakter.',
	'greater_than'          => 'Field {field} harus berisi sebuah angka yang lebih besar dari {param}.',
	'greater_than_equal_to' => 'Field {field} harus berisi sebuah angka yang lebih besar atau sama dengan {param}.',
	'in_list'               => 'Field {field} harus salah satu dari: {param}.',
	'integer'               => 'Field {field} harus mengandung bilangan bulat.',
	'is_natural'            => 'Field {field} hanya boleh berisi angka.',
	'is_natural_no_zero'    => 'Field {field} hanya boleh berisi angka dan harus lebih besar dari nol.',
	'is_not_unique'         => 'The {field} field must contain a previously existing value in the database.',
	'is_unique'             => 'Field {field} sudah ada.',
	'less_than'             => 'Field {field} harus berisi sebuah angka yang kurang dari {param}.',
	'less_than_equal_to'    => 'Field {field} harus berisi sebuah angka yang kurang dari atau sama dengan {param}.',
	'matches'               => 'Field {field} tidak cocok dengan Field {param}.',
	'max_length'            => 'Field {field} tidak bisa melebihi {param} panjang karakter.',
	'min_length'            => 'Field {field} setidaknya harus {param} panjang karakter.',
	'not_equals'            => 'The {field} field cannot be: {param}.',
	'numeric'               => 'Field {field} hanya boleh mengandung angka.',
	'regex_match'           => 'Field {field} tidak dalam format yang benar.',
	'required'              => 'Field {field} harus diisi.',
	'required_with'         => 'Field {field} harus diisi.',
	'required_without'      => 'Field {field} harus diisi saat {param} tidak hadir.',
	'timezone'              => 'Field {field} harus berupa sebuah zona waktu yang valid.',
	'valid_base64'          => 'Field {field} harus berupa sebuah string base64 yang valid.',
	'valid_email'           => 'Field {field} harus berisi sebuah alamat email yang valid.',
	'valid_emails'          => 'Field {field} harus berisi semua alamat email yang valid.',
	'valid_ip'              => 'Field {field} harus berisi sebuah IP yang valid.',
	'valid_url'             => 'Field {field} harus berisi sebuah URL yang valid.',
	'valid_date'            => 'Field {field} harus berisi sebuah tanggal yang valid.',
	'cek'   				=> 'Field {field} tidak valid.',

	// Credit Cards
	'valid_cc_num'          => '{field} tidak tampak sebagai sebuah nomor kartu kredit yang valid.',

	// Files
	// 'uploaded'              => '{field} bukan sebuah berkas diunggah yang valid.',
	'uploaded'              => '{field} diunggah yang tidak valid.',
	'max_size'              => '{field} terlalu besar dari sebuah berkas.',
	'is_image'              => '{field} bukan berkas yang valid.',
	'mime_in'               => '{field} tidak memiliki sebuah tipe mime yang valid.',
	'ext_in'                => '{field} tidak memiliki sebuah ekstensi berkas yang valid.',
	'max_dims'              => '{field} terlalu lebar atau tinggi.',
];