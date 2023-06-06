<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Mail\enviaMailable;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\Muelle;
use App\Models\Plaza;

use Illuminate\Http\Request;


class ServicioController extends Controller
{

    // Para proteger las rutas tienes 2 opciones:
    //  - except: para indicar a que métodos no se les aplicará el middleware.
    //  - only: para indicar los métodos a los que se les aplicaría el middleware.
    public function __construct()
    {

        $this->middleware('gerencia')->except(['index', 'show']); // Desde Gerencia hacia arriba, es decir Xunta se encargan de todo. 
        $this->middleware('guarda-muelle')->only(['index', 'show']); // Desde Guarda-muelles, pasando por Policía hasta Gerencia solo acceden a show e index.
    }


    public function index()
    {

        //Necesitamos mostrar únicamente los servicios de las embarcaciones atracadas en las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $servicios = Servicio::all(); // Recogemos todos los muelles disponibles.

        } else { //Si no, mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
            // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            //Obtengo el usuario logeado.
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            //Obtengo la instalacion a la que pertenece el usuario logeado.
            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            //Obtengo los muelles a los que pertenece el usuario logeado.
            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();


            //Obtengo las plazas pertenecientes a la Instalacion a las que pertenece el usuario logeado.
            $plazas = [];
            for ($i = 0; $i < count($muelles); $i++) {
                $plaza = Plaza::where('idMuelle', $muelles[$i])->get()->toArray();
                array_push($plazas, $plaza);
            }

            //Obtengo las embarcaciones a las que pertenece el usuario logeado.
            $embarcaciones = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $embarcacione = Embarcacione::where('id_plaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($embarcacione[0]["matricula"])) {
                        array_push($embarcaciones, $embarcacione[0]);
                    }
                }
            }

            //Obtengo los servicios que pertenecen al usuario logeado.
            $servicios = [];
            for ($a = 0; $a < count($embarcaciones); $a++) {
                for ($i = 0; $i < count($embarcaciones[$a]); $i++) {
                    $servicio = Servicio::where('matricula', $embarcaciones[$a][$i])->get()->toArray();
                    array_push($servicios, $servicio[0]);
                }
            }
        }

        return view('servicio.index', compact('servicios'))
            ->with('i', 0);
    }


    public function create()
    {
        $servicio = new Servicio();
        $servicio->fechaSolicitud = date('d-m-Y');
        /* $servicio->fechaSolicitud = date('Y-m-d H:i:s'); */

        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('servicio.create', compact('servicio', 'embarcaciones'));
    }


    public function store(Request $request)
    {

        request()->validate(Servicio::$rules);
        Servicio::create($request->all());

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio created successfully.');
    }


    public function destroy($id)
    {
        Servicio::find($id)->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio deleted successfully');
    }


    public function show($id)
    {

        $servicio = Servicio::find($id);

        return view('servicio.show', compact('servicio'));
    }


    public function edit($id)
    {

        $servicio = Servicio::find($id);
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('servicio.edit', compact('servicio', 'embarcaciones'));
    }


    public function update(Request $request, Servicio $servicio)
    {
        request()->validate(Servicio::$rules);

        $servicio->update($request->all());

        if ($servicio->finalizado == 1 && $request->input('action') === 'generaPdf') {
            $this->servicioPDF($servicio);
        }/* elseif ($servicio->finalizado == 1 && $request->input('action') === 'enviaEmail') {
            $this->servicioEmail($servicio);
        }  */       

        return redirect()->route('servicios.index')->with('success', 'Servicio updated successfully');
    }

    public function servicioPDF($servicio) {
        
        if(is_string($servicio)){
            $servicio = Servicio::find($servicio);            
        }
        
        //Servicio
        $matriculaEmbarcacion = $servicio->matriculaEmbarcacion;
        $tipoServicio = $servicio->tipoServicio;
        $precioHora = $servicio->precioHora;
        $numHoras = $servicio->numHoras;
        $fechaSolicitud = $servicio->fechaSolicitud;
        $total = $numHoras * $precioHora;
        /* $abonado = $servicio->abonado;
        $abonadoTxt = $abonado ? 'Sí' : 'No';
        <p><strong>Abonado:</strong> ' . $abonadoTxt . '</p> */
        //Embarcacion
        $nombreEmbarcacion = $servicio->embarcacion->nombre;
        $numDocumentoCliente = $servicio->embarcacion->id_cliente;
        $plazaEmbarcacion = $servicio->embarcacion->id_plaza;
        //Cliente
        $cliente = Cliente::where('numDocumento', $numDocumentoCliente)->first();
        $nombreCliente = $cliente->nombre;
        $apellidoCliente = $cliente->apellidos;
        $emailCliente = $cliente->email;

        // Generamos el HTML de la tabla con los datos del servicio
        $htmlRecibo = '
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
                    <p><strong>Matrícula Embarcación:</strong> ' . $matriculaEmbarcacion . '</p>
                    <p><strong>Nombre Embarcación:</strong> ' . $nombreEmbarcacion . '</p>   
                    <p><strong>Plaza Embarcación:</strong> ' . $plazaEmbarcacion . '</p>               
                    <p><strong>Propietario:</strong> ' . $numDocumentoCliente . '</p> 
                    <p><strong>Nombre cliente:</strong> ' . $nombreCliente . '</p>
                    <p><strong>Apellido cliente:</strong> ' . $apellidoCliente . '</p>
                    <p><strong>Email cliente:</strong> ' . $emailCliente . '</p>
                    <p><strong>Tipo servicio:</strong> ' . $tipoServicio . '</p>
                    <p><strong>Fecha Solicitud:</strong> ' . $fechaSolicitud . '</p>                    
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
                                <td>' . $tipoServicio . '</td>
                                <td>' . $numHoras . '.00</td>
                                <td>' . $precioHora . '.00</td>              
                                <td>' . $total . '.00</td>                    
                            </tr>
                            <!-- Agregar más filas de detalles si es necesario -->
                        </tbody>
                    </table>
                </div>
                <div class="total">
                    <p>IVA(21%): ' . ($total * 0.21) . '€</p>
                    <p>Total(IVA): ' . ($total * 0.21) + $total . '€</p>
                </div>
            </div>';


        // Instanciamos y usamos las clase dompdf        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlRecibo);

        // Especificamos tamaño del papel y orientaciónn.
        $dompdf->setPaper('A4', 'landscape');

        // Renderizamos el PDF
        $dompdf->render();

        // Generamos el nombre del archivo
        $timestamp = date('d-m-Y_H:i:s');
        $timestamp = str_replace('_', ':', $timestamp); // NO FUNCIONA. PORQUE?
        $nombreArchivo = $nombreEmbarcacion . '_' . $matriculaEmbarcacion . '_' . $timestamp . '.pdf';

        // Enviamos el PDF al navegador con el nombre de archivo
        $dompdf->stream($nombreArchivo);
    }


    public function servicioEmail($servicio) {   
        $numDocumentoCliente = $servicio->embarcacion->id_cliente;
        $cliente = Cliente::where('numDocumento', $numDocumentoCliente)->first();

        $contenidoPDF = $this->servicioPDF($servicio);
        Mail::to($cliente->email)->send(new enviaMailable($contenidoPDF));  


        /* $destinatario = $servicio->embarcacion->cliente->email; */
    
    }
}
