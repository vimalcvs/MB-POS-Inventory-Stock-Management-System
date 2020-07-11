<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Barcode</title>
    <style>
        .amdmaininvoice table {
            border-collapse: collapse;
            width: 100%;
        }

        .amdmaininvoice td, .amdmaininvoice th {
            border: 1px solid #d3d3d3;
            text-align: left;
            padding: 8px;
        }

        .amdmaininvoice tr:nth-child(even) {
            background-color: #d3d3d3;
        }
    </style>

</head>

<body style="margin:0;padding:0; font-family: 'Open Sans', sans-serif; font-size:14px;">
<div class="amd-wrapper" style="margin:0 auto; padding:0; max-width:1024px; width:100%; background:#fff;">

    <table style="width:100%; border-collapse: collapse; margin:auto; padding:0;">
        <tbody>
        @for($n = 0; $n < $numberOfCode; $n++)
        <tr>
            <td class="barcode">
                <p style="margin-bottom: 0; padding-bottom:0; "> {{$product->sku}}</p>
                <div><?php  echo DNS1D::getBarcodeHTML($product->sku, "C39", 1,33);  ?></div>
            </td>
        </tr>
        @endfor
        </tbody>
    </table>
</div>
</body>
</html>
