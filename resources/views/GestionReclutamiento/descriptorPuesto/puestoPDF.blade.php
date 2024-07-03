<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Puesto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            width: 150px;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
            color: #000;
        }
        .date {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 14px;
            color: #333;
        }
        .content {
            padding: 20px;
            margin-top: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            background-color: #eee;
            padding: 10px;
            margin: 0;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .section p, .section table {
            padding: 10px;
            margin: 0;
            text-align: left;
        }
        .footer {
            text-align: right;
            padding: 20px;
        }
        .footer p {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
        @media (max-width: 768px) {
            .header img {
                width: 100px;
            }
            .header h1 {
                font-size: 20px;
            }
            .section h2 {
                font-size: 16px;
            }
            .table th, .table td {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="date">
            Generado el {{ date('d-m-Y') }}
        </div>
        <div class="header">
            <img src="{{ asset('images/image.jpg') }}" alt="Logo">
            <h1>DESCRIPCIÓN DE PUESTO</h1>
        </div>
        <div class="content">
            <div class="section">
                <table class="table">
                    <tr>
                        <th>Fecha de elaboración</th>
                        <td>{{ $descripcion->fechaElaboracion }}</td>
                        <th>Fecha de revisión RH</th>
                        <td>{{ $descripcion->fechaRevision }}</td>
                    </tr>
                    <tr>
                        <th>Título de puesto</th>
                        <td>{{ $descripcion->tituloPuesto }}</td>
                        <th>Área</th>
                        <td>{{ $descripcion->operacionArea }}</td>
                    </tr>
                    <tr>
                        <th>Puesto al que reporta</th>
                        <td>{{ $descripcion->puestoAlQueReporta }}</td>
                        <th>Puestos que le reportan</th>
                        <td>
                            Directos: {{ $descripcion->directosCantidad }}<br>
                            Indirectos: {{ $descripcion->indirectosCantidad }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="section">
                <h2>I. Propósito o Finalidad del Puesto</h2>
                <p>{{ $descripcion->propositoPuesto }}</p>
            </div>
            <div class="section">
                <h2>II. Funciones Principales</h2>
                <p>{{ $descripcion->funcionesPrincipales }}</p>
            </div>
            <div class="section">
                <h2>III. Impacto de Decisiones</h2>
                <p>{{ $descripcion->impactoDecisiones }}</p>
            </div>
        </div>
    </div>
</body>
</html>
