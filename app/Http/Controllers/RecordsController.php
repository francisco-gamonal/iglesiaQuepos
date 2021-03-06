<?php namespace SistemasAmigables\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SistemasAmigables\Entities\Record;
use SistemasAmigables\Repositories\RecordRepository;

class RecordsController extends Controller {
    /**
     * @var RecordRepository
     */
    private $recordRepository;

    /**
     * @param RecordRepository $recordRepository
     */
    public function __construct(RecordRepository $recordRepository)
    {

        $this->recordRepository = $recordRepository;
    }

    /*
    |---------------------------------------------------------------------
    |@Author: Anwar Sarmiento <asarmiento@sistemasamigables.com
    |@Date Create: 2015-12-22
    |@Date Update: 2015-00-00
    |---------------------------------------------------------------------
    |@Description: Consultamos todos los controles cruzados que existen y
    |   lo enviamos a la vista para poder mostrarlo al usuario.
    |----------------------------------------------------------------------
    | @return view
    |----------------------------------------------------------------------
    */
    public function index() {
        $informes = $this->recordRepository->getModel()->orderBy('id','DESC')->paginate(20);
        return View('informes.index', compact('informes'));
    }

    /*
    |---------------------------------------------------------------------
    |@Author: Anwar Sarmiento <asarmiento@sistemasamigables.com
    |@Date Create: 2015-12-22
    |@Date Update: 2015-00-00
    |---------------------------------------------------------------------
    |@Description: Consultamos si existen registro para llevar el conteo de
    |
    |
    |@Pasos:
    |
    |
    |
    |
    |
    |
    |----------------------------------------------------------------------
    | @return mixed
    |----------------------------------------------------------------------
    */
    public function create() {
        $informes = $this->recordRepository->getModel()->all()->last();

        $consecutive = '00001';
        if(isset($informes)):
        $consecutive = '0000'.($informes->numbers+1);
          
            endif;
        return View('informes.create', compact('informes','consecutive'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /historial
     *
     * @return Response
     */
    public function store(Request $request) {

        $record=  $this->recordRepository->getModel();
        $data = $request->all();
        $data['_token']= md5($data['controlNumber']);

        if ($record->isValid($data)):
            $record->fill($data);
            $record->save();
            /* Comprobamos si viene activado o no para guardarlo de esa manera */
            /* Enviamos el mensaje de guardado correctamente */
            return redirect()->route('create-income', [$record->_token]);
        endif;

        /* Enviamos el mensaje de error */
        return redirect('iglesia/informes/create')
            ->withErrors($record)
            ->withInput();
    }

    /**
     * Display the specified resource.
     * GET /historial/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /historial/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /historial/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /historial/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
