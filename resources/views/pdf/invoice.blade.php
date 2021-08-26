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

        @media print {
            #printBtn {
                visibility: hidden !important; // To hide 
            }
            #totalPenjualan {
                visibility: hidden !important; // To hide 
            }

            @page { margin: 0; }
            body { margin: 1.6cm; }

            body * {
                -webkit-print-color-adjust: exact !important; // not necessary use         
            }

            #page-wrapper * {
                visibility: visible; // Print only required part
                text-align: left;
                -webkit-print-color-adjust: exact !important;
            }
        }
    </style>

</head>

<body>
    <button id="printBtn" onclick="genPDF()">Generate PDF</button>
    @php
        $total = 0;
    @endphp
    @foreach ($datas as $data)
        <div class="page-break">
            <h2 align="center">KUITANSI</h2>
            <table width="100%">
                <tr>
                    <td width="15px">No</td>
                    <td width="15px">:</td>
                    @php
                        $month = explode('-', $data['order_date']);
                        if (!isset($month[1])) {
                            $month[1] = 1;
                        }
                    @endphp
                    <td>KEVA/{{date("Y")}}/{{strtoupper($data['channel_name'])}}/{{getRomawi($month[1])}}/{{invoice_num($loop->iteration)}}</td>
                </tr>
                <tr>
                    <td width="15px">Tanggal</td>
                    <td width="15px">:</td>
                    <td>{{ invoiceFormat($data['order_date'])}}</td>
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

        {{-- <br>

        <table width="100%">
            <tr>
                <td width="10px">No. Pesanan</td>
                <td width="10px">:</td>
                <td width="250px">{{$data['channel_order_id']}}</td>
            </tr>
        </table> --}}

        <br>

        <table width="100%">
            <tr>
                <td width="100px"><strong>Infomasi Jasa Kirim</strong></td>
            </tr>
            <tr>
                <td width="100px">Package 1 : </td>
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
                    <th><strong>Disc</strong></th>
                    <th><strong>Subtotal</strong></th>
                </tr>
            </thead>
            @php $totalPesanan = 0 @endphp 
            @php $ppnTotal = 0 @endphp 
            @foreach ($data['items'] as $item)
                @php
                    $subtotal = ($item['quantity'] * $item['price']) - $item['discount'];
                    $totalPesanan += $subtotal;
                    $ppnTotal += $item['ppn'];
                @endphp
                <tbody>
                    <tr>
                        <td align="center">{{$loop->iteration}}</td>
                        <td align="left">{{$item['name']}}</td>
                        <td align="center">{{rupiah($item['price'])}}</td>
                        <td align="center">{{$item['quantity']}}</td>
                        <td align="right">{{rupiah($item['discount'])}}</td>
                        <td align="right">{{rupiah($subtotal)}}</td>
                    </tr>
                </tbody>
            @endforeach
            @php
                $total += $totalPesanan;
            @endphp
            <tfoot>
                <tr>
                    <td colspan="4" align="right" style="font-size: 10px;"><strong>Total Pesanan</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    <td colspan="1" align="right">{{rupiahWithoutPrefix($totalPesanan)}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="font-size: 10px;"><strong>PPN</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    <td colspan="1" align="right">{{rupiahWithoutPrefix($ppnTotal)}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="font-size: 15px;"><strong>Total Pembayaran</strong></td>
                    <td colspan="1" align="right">Rp</td>
                    @php
                        $totalbayar = ($totalPesanan)
                    @endphp
                    <td colspan="1" align="right">{{rupiahWithoutPrefix($totalbayar)}}</td>
                </tr>
            </tfoot>
        </table>
        </div>
    @endforeach

    <h2 id="totalPenjualan">TOTAL PENJUALAN : {{rupiah($total)}}</h2>
    <script>
        function genPDF() {
                window.print()
        }
    </script>
</body>

</html>
