<style>
    .recibo {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        font-family: Arial, sans-serif;
    }

    .encabezado {
        text-align: center;
        margin-bottom: 20px;
        background-color: rgba(128, 128, 128, 0.3);
    }

    .encabezado h2 {
        font-size: 24px;
        margin: 0;
    }

    .info-cliente {
        margin-bottom: 20px;
    }

    .info-cliente p {
        margin: 5px 0;
    }

    .detalle {
        margin-bottom: 20px;
    }

    .detalle table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .detalle th {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    .detalle td {
        padding: 10px;
        text-align: center;
    }

    .detalle td:first-child {
        text-align: left;
    }

    .total {
        text-align: right;
        font-weight: bold;
    }

    .total p:first-child {
        font-size: 12px;
        margin-bottom: 5px;
    }
</style>

<div class="recibo">
    <div class="encabezado">
        <h2>Recibo de Pago</h2>
    </div>
    <div class="info-cliente">
    <p><strong>Matrícula Embarcación:</strong> ' . prueba . '</p>
        <p><strong>Nombre Embarcación:</strong> ' . prueba . '</p>
        <p><strong>Plaza Embarcación:</strong> ' . prueba . '</p>
        <p><strong>Propietario:</strong> ' . prueba . '</p>
   <!--      <p><strong>Matrícula Embarcación:</strong> ' . $matriculaEmbarcacion . '</p>
        <p><strong>Nombre Embarcación:</strong> ' . $nombreEmbarcacion . '</p>
        <p><strong>Plaza Embarcación:</strong> ' . $plazaEmbarcacion . '</p>
        <p><strong>Propietario:</strong> ' . $numDocumentoCliente . '</p>
        <p><strong>Nombre cliente:</strong> ' . $nombreCliente . '</p>
        <p><strong>Apellido cliente:</strong> ' . $apellidoCliente . '</p>
        <p><strong>Email cliente:</strong> ' . $emailCliente . '</p>
        <p><strong>Tipo servicio:</strong> ' . $tipoServicio . '</p>
        <p><strong>Fecha Solicitud:</strong> ' . $fechaSolicitud . '</p> -->
    </div>
    <div class="detalle">
        <table>
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Cant.(hrs)</th>
                    <th>Precio(hrs)</th>
                    <th>Monto(€)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . prueba . '</td>
                    <td>' . prueba . '.00</td>
                    <td>' . prueba . '.00</td>
                    <td>' . prueba . '.00</td>
                </tr>
                <!-- Agregar más filas de detalles si es necesario -->
            </tbody>
        </table>
    </div>
  <!--   <div class="total">
        <p>IVA(21%): ' . ($total * 0.21) . '€</p>
        <p>Total(IVA): ' . ($total * 0.21) + $total . '€</p>
    </div> -->
</div>