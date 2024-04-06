<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura venta</title>

    <style>
        .b{
            border: 1px solid black;

        }

        .shop-info{
            display: block;
            padding: 3px;
            font-size: 12.5px;
        }

        .factura-id{
            font-size: 1.5rem;
            font-style: normal;
            color: #525659;
        }

        .factura-fecha{
            font-size: 1rem;
            font-style: normal;
            color: #525659;
        }

        .productos{
            text-align: center;
            margin-top: 1rem;
        }

        .productos thead{
            background-color: #525659ab;
            color: white;
        }

        .productos tr:nth-child(even){
            background-color: #ddd;
        }

        th,td{
            padding: 10px;
        }

        .badge{
            background-color: #5256598d;
            color: white;
            padding: 3px;
            border-radius:100%;
            font-weight: 500;
            width: 10px;
            margin: 0 auto;


                
        }

    </style>
</head>
<body style="margin-left:-2.5rem;">

    <table width="100%" style="text-align: left; margin-top:-4rem;">
        <tr>        
            <td width="100%" style="text-align: center">
                <p>X</p>
                <h5 style="margin-top:-1rem;">DOCUMENTO FISCAL</h5>
                <h3 style="margin-top:-1rem;">{{$shop->name}}</h3>
            </td>
        </tr>
        <tr>
            <td width="100%">
                <p style="margin-top:-2rem;">Fecha-Hora: {{$sale->created_at}}</p>
            </td>
        </tr>
        <tr>
            <td width="100%">
                    <p style="margin-top:-2rem;">Nº Operación: {{$sale->id}}</p>
            </td>
        </tr>
        <tr>
            <td width="100%">
                <p style="margin-top:-2rem;">Vendedor: {{ Auth::user()->name }}</p>
            </td>
        </tr>
    </table>

    <hr style="margin-top:-1rem;" />

    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <p style="margin-top:-1rem; font-size:small">[COD]</p>
                </td>
                <td>
                    <p style="margin-top:-1rem; font-size:small">DESCRIPCION</p>
                </td>
            </tr>
            <tr>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">CANT</p>
                </td>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">PRECIO UNIT</p>
                </td>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">IMPORTE</p>
                </td>
            </tr>
        </tbody>

    </table>

    <hr style="margin-top:-1rem;" />

    <table width="100%" style="text-align: left;">
        <tbody>
            @forelse ($sale->items as $item)
            <tr>
                <td>
                    <p style="margin-top:-1rem; font-size:small">[{{$item->id}}]</p>
                </td>
                <td>
                    <p style="margin-top:-1rem; font-size:small">{{$item->name}}</p>
                </td>
            </tr>
            <tr>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">{{$item->quantity}}</p>
                </td>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">{{money($item->price)}}</p>
                </td>
                <td width="33%">
                    <p style="margin-top:-2rem; font-size:small">{{money($item->price*$item->quantity)}}</p>
                </td>
            </tr>
                
            @empty
            <tr>
                <td colspan="5">Sin registros</td>

            </tr> 
            @endforelse
        </tbody>
    </table>

    <hr style="margin-top:-1rem;" />

    <table width="100%" style="text-align: left;">
        <tr>
            <td>
                {{-- <p style="margin-top:-1rem;">ARTICULOS: 2</p> --}}
            </td>
        </tr>
        <tr>
            <td>
                <h2 style="margin-top:-2rem;">TOTAL {{money($sale->total)}}</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-top:-2rem;">Gracias por tu compra!</p>
            </td>
        </tr>
    </table>
    
</body>
</html>