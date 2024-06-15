<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Pago</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-size: 12px; /* Tamaño de letra adecuado para PDF */
            font-family: Arial, sans-serif; /* Fuente para el PDF */
            margin: 0; /* Eliminar márgenes predeterminados */
            padding: 0; /* Eliminar padding predeterminado */
        }
        .container {
            width: 100%;
            margin: 30px auto; /* Ajuste de márgenes para centrar */
            padding: 0 20px; /* Padding interior para contenido */
        }
        .title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .discounts {
            margin-bottom: 20px;
        }
        .discounts th, .discounts td {
            text-align: right;
            padding: 8px;
        }
        .discounts th {
            width: 70%;
            border-bottom: 1px solid #000;
        }
        .discounts table {
            width: 100%;
            border-collapse: collapse;
        }
        .discounts th, .discounts td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <strong>Boleta de Pago</strong>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                <p><strong>Empleador:</strong> {{ $empleador }}</p>
                <p><strong>Fecha de Incorporación:</strong> {{ $fechaIncorporacion }}</p>
            </div>

            <div style="flex: 1;">
                <p><strong>Nombre:</strong> {{ $nombre }}</p>
                <p><strong>Cargo:</strong> {{ $cargo }}</p>
                <p><strong>Fecha de Pago:</strong> {{ $fechaPago }}</p>
                <p><strong>Método de Pago:</strong> {{ $metodoPago }}</p>
                <p><strong>Cuenta:</strong> {{ $cuenta }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="details">
                            <p><strong>Período Laborado:</strong> {{ $periodoLaborado }}</p>
                            <p><strong>Días de Descanso:</strong> {{ $diasDescanso }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="details">
                            <p><strong>Recargo Vacaciones:</strong> $ {{$recargoVacaciones}}</p>
                            <p><strong>Bonificaciones:</strong> ${{ $bonificaciones}}</p>
                            <p><strong>Salario Bruto:</strong> ${{ $salarioBruto}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="discounts">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descuento</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ISSS</td>
                        <td>${{$isss}}</td>
                    </tr>
                    <tr>
                        <td>AFP</td>
                        <td>${{$afp}}</td>
                    </tr>
                    <tr>
                        <td>RENTA</td>
                        <td>${{$renta}}</td>
                    </tr>
                    <tr>
                        <th>Total Descuentos</th>
                        <th>${{$totalDescuentos}}</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="details">
            <p><strong>Salario Neto:</strong> ${{$salarioNeto}}</p>
            <p><strong>Fecha de Emisión:</strong> {{ $fechaEmision }}</p>
        </div>
    </div>
</body>
</html>
