<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Puesto</title>
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
            width: 130px;
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
            <img src="{{ asset('storage/images/image.jpg') }}" alt="Logo">
            <h1>Perfil del Puesto: {{$descripcion->tituloPuesto}}</h1>
        </div>
        <div class="content">
            <div class="section">
                <h2>A. Características generales</h2>
                <table class="table">
                    <tr>
                        <th>Edad (Min/Max)</th>
                        <td>{{ $perfil->edad }}</td>
                    </tr>
                    <tr>
                        <th>Sexo</th>
                        <td>{{ $perfil->sexo }}</td>
                    </tr>
                    <tr>
                        <th>Estado Civil</th>
                        <td>{{ $perfil->estadoCivil }}</td>
                    </tr>
                    <tr>
                        <th>Escolaridad</th>
                        <td>{{ $perfil->escolaridad }}</td>
                    </tr>
                    <tr>
                        <th>Residencia preferente (ciudad/país)</th>
                        <td>{{ $perfil->residenciaPreferente }}</td>
                    </tr>
                    <tr>
                        <th>Nacionalidad preferente</th>
                        <td>{{ $perfil->nacionalidad }}</td>
                    </tr>
                </table>
            </div>
            <div class="section">
                <h2>B. Idiomas</h2>
                <p>{{ $perfil->idiomas }}</p>
            </div>
            <div class="section">
                <h2>C. Disponibilidad</h2>
                <p>{{ $perfil->disponibilidad }}</p>
            </div>
            <div class="section">
                <h2>D. Conocimientos específicos (técnicos y/o funcionales)</h2>
                <p>{{ $perfil->conocimientosEspecificos }}</p>
            </div>
            <div class="section">
                <h2>E. Experiencia en puestos previos (tiempo en años)</h2>
                <p>{{ $perfil->experienciasPrevias }}</p>
            </div>
            <div class="section">
                <h2>F. Características y habilidades</h2>
                <p>{{ $perfil->caracteristicasHabilidades }}</p>
            </div>
        </div>
    </div>
</body>
</html>
