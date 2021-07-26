<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Aloha!</title>

	<style type="text/css">
		* {
			font-family: Verdana, Arial, sans-serif;
		}

		table {
			font-size: x-small;
		}

		tfoot tr td {
			font-weight: bold;
			font-size: x-small;
		}

		.wrapper {
			min-height: 100%;
		}

		.gray {
			background-color: lightgray
		}

		.shoppe {
			color: #FF6600
		}

		.red {
			color: #ff0000
		}

		.container {
			width: 100%;
		}

		tr.border_bottom td {
			border-bottom: 1px solid black;
		}

		.shoppebg {
			background-color: #FF6600
		}

		.page-break {
			page-break-after: always;
		}

		u.dotted {
			border-bottom: 1px dashed #999;
			text-decoration: none;
		}
	</style>

</head>

<body>

	<table width="100%">
		<tr>
			<td valign="top" width="50%">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/800px-Shopee.svg.png"
					alt="" width="150" />
				<h3>Nomor Pesanan : <span class="shoppe">210723MDOUVTKC</span></h3>
				<p>Diterbitkan atas nama:
					<br><strong>Penjual <span class="shoppe">esqacosmetics</span></strong>
					<br><strong>Tanggal <span>02 Juli 2021</span></strong>
			</td>
			<td width="50%">
				<strong style="font-size: 14px;">Alamat Pengiriman:</strong><br><br><strong>Aulia</strong><br>Jalan
				Musyawarah No. 25 RT 005/02, Ragunan,
				Pasar Minggu, Jakarta Selatan Pasar Minggu Kota
				Administrasi Jakarta Selatan 12550
				DKI Jakarta
				6281310709434
			</td>
		</tr>
	</table>

	<u class="dotted"></u>

	<table width="100%">
		<thead style="background-color: #FF6600;">
			<tr>
				<th><strong>Produk</strong></th>
				<th><strong>Harga Satuan</strong></th>
				<th><strong>Jumlah</strong></th>
				<th><strong>Subtotal</strong></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ESQA Blush Milan</td>
				<td align="right">Rp 50.000</td>
				<td align="right">1</td>
				<td align="right">Rp 50.000</td>
			</tr>
			<tr class="gray">
				<td>ESQA Blush Milan 2</td>
				<td align="right">Rp 50.000</td>
				<td align="right">1</td>
				<td align="right">Rp 50.000</td>
			</tr>
			<tr>
				<td>ESQA Blush Milan 3</td>
				<td align="right">Rp 50.000</td>
				<td align="right">1</td>
				<td align="right">Rp 50.000</td>
			</tr>
		</tbody>

		<tfoot>
			<tr>
				<td colspan="2"></td>
				<td align="right">Total Pesanan</td>
				<td align="right" class="gray">Rp 150.000</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td align="right">Subtotal Ongkos Kirim</td>
				<td align="right">Rp 0</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td align="right">Biaya Admin</td>
				<td align="right" class="gray">Rp 8.500</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td align="right"><strong>Total Pembayaran</strong></td>
				<td align="right" class="shoppebg">Rp 158.500</td>
			</tr>
		</tfoot>
	</table>

	<div style="float: right;margin-top: 20px;">
		<table width="30%" style="border-style: dotted;">
			<tr class="border_bottom shoppebg">
				<td>J&T Express</td>
				<td>Rp 10.000</td>
			</tr>
			<tfoot>
				<tr>
					<td align="right">Subtotal Ongkos Kirim</td>
					<td align="right">Rp 10.000</td>
				</tr>
			</tfoot>
		</table>
	</div>


</body>

</html>