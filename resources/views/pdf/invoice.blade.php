<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>KUITANSI</title>

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

    </style>

</head>

<body>
    @foreach ($datas as $data)
        <div class="page-break">
            <h2 align="center">KUITANSI</h2>
            <table width="100%">
                <tr>
                    <td width="15px">No</td>
                    <td width="15px">:</td>
                    <td>KEVA/{{date("Y")}}/{{strtoupper($data['channel_name'])}}/VI/00{{$loop->iteration}}</td>
                </tr>
                <tr>
                    <td width="15px">Tanggal</td>
                    <td width="15px">:</td>
                    @php
                        date_default_timezone_set("Asia/Jakarta")
                    @endphp
                    <td>{{date("d/m/Y", ($data['order_date'] / 1000))}}</td>
                </tr>
            </table>

        <br>

        <table width="100%">
            <tr>
                <td>PT. Keva Cosmetics Internasional</td>
            </tr>
            <tr>
                <td>Jl. Panglima Polim No. 28 Pulo Kebayoran Baru Jakarta Selatan DKI Jakarta</td>
            </tr>
            <tr>
                <td>74.673.938.2-019.000</td>
            </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
                <td width="10px">Sudah Terima dari</td>
                <td width="10px">:</td>
                <td width="250px">{{$data['customer_name']}}, 6285251750784</td>
            </tr>
            <tr>
                <td width="10px">No. Pesanan</td>
                <td width="10px">:</td>
                <td width="250px">{{$data['channel_invoice']}}</td>
            </tr>
            <tr>
                <td width="10px">Alamat Pengiriman</td>
                <td width="10px">:</td>
                <td width="250px">{{$data['customer_address']}}</td>
            </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
                <td width="100px"><strong>Infomasi Jasa Kirim</strong></td>
            </tr>
            <tr>
                <td width="100px">Package 1 : {{$data['shipping']['shipping_carrier']}} J&T Express</td>
            </tr>
            <tr>
                <td width="100px">{{count($data['items'])}} products</td>
            </tr>
        </table>

        <br>

        <div style="font-size: x-small"><strong>Informasi Pembayaran</strong></div>
        <table width="100%">
            <thead style="background-color: whitesmoke;">
                <tr>
                    <th><strong>No.</strong></th>
                    <th align="left" width="250px"><strong>Produk</strong></th>
                    <th><strong>Harga Satuan</strong></th>
                    <th><strong>Jumlah</strong></th>
                    <th><strong>Disc (%)</strong></th>
                    <th><strong>Subtotal</strong></th>
                </tr>
            </thead>
            @php $totalPesanan = 0 @endphp 
            @foreach ($data['items'] as $item)
                <tbody>
                    <tr>
                        <td align="center">{{$loop->iteration}}</td>
                        <td align="left">{{$item['name']}}</td>
                        <td align="center">{{rupiah($item['price'])}}</td>
                        <td align="center">{{$item['quantity']}}</td>
                        <td align="right">{{$item['discount'] / $item['price'] * 100}}%</td>
                        <td align="right">{{rupiah($item['price'] - $item['discount'])}}</td>
                    </tr>
                </tbody>
                @php
                    $totalPesanan += $item['price'] - $item['discount']
                @endphp
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="4" align="right" style="font-size: 10px;"><strong>Total Pesanan</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    <td colspan="1" align="right">{{rupiahWithoutPrefix($totalPesanan)}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="font-size: 10px;"><strong>PPN</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    <td colspan="1" align="right">{{rupiahWithoutPrefix($totalPesanan*0.1)}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="font-size: 10px;"><strong>Service Fee</strong></td>
                    <td colspan="1" align="right">-Rp</td>
                    <td colspan="1" align="right">4.250</td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="font-size: 15px;"><strong>Total Pembayaran</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    <td colspan="1" align="right">{{rupiahWithoutPrefix(($totalPesanan + ($totalPesanan*0.1)) - 4.250)}}</td>
                </tr>
            </tfoot>
        </table>
        </div>
    @endforeach
</body>

</html>
