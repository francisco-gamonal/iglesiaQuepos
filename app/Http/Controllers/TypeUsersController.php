<?php namespace SistemasAmigables\Http\Controllers;

class TypeUsersController extends Controller {

    /**
     * Display a listing of typeusers
     *
     * @return Response
     */
    public function index() {
        $typeusers = TiposUser::withTrashed()->get();
        return View::make('type_users.index', compact('typeusers'));
    }

    /**
     * Show the form for creating a new typeuser
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created typeuser in storage.
     *
     * @return Response
     */
    public function store() {
        $json = Input::get('data');
        $data = json_decode($json);
        $Tipouser = new TiposUser;
        if ($Tipouser->isValid((array) $data)):
            $Tipouser->name = Str::upper($data->name);
            $Tipouser->save();
            return 1;
        endif;

        if (Request::ajax()):
            return Response::json([
                        'success' => false,
                        'errors' => $Tipouser->errors
            ]);
        else:
            return Redirect::back()->withErrors($Tipouser->errors)->withInput();
        endif;
    }

    /**
     * Display the specified typeuser.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified typeuser.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified typeuser in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update() {
        //capturamos los datos enviados
        $json = Input::get('data');
        $data = json_decode($json);
        //hacemos el cambio de estado de acuerdo a lo solicitado
        if ($data->state == 1):
            TiposUser::withTrashed()->find($data->id)->restore();
        else:
            TiposUser::destroy($data->id);
        endif;
        //enviamos a buscar los datos a editar
        $Tipouser = TiposUser::withTrashed()->find($data->id);
        // si no existe enviamos un mensaje de error via json
        if (is_null($Tipouser)):
            return View::make('type_users.index', json_encode(array('message' => 'El Tipo usuario no existe')));
        endif;
        //validamos los datos
        if ($Tipouser->isValid((array) $data)):
            //si estan correctos los editamos
            $Tipouser->name = Str::upper($data->name);
            $Tipouser->save();
            return 1;
        endif;
        //si estan incorrecto enviamos mensaje via ajax 
        if (Request::ajax()):
            return Response::json([
                        'success' => false,
                        'errors' => $Tipouser->errors
            ]);
        else:
            return Redirect::back()->withErrors($Tipouser->errors)->withInput();
        endif;
    }

    /**
     * Remove the specified typeuser from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $data = TiposUser::destroy($id);
        if ($data):
            return 1;
        endif;

        return json_encode(array('message' => 'Ya esta Inactivo'));
    }

    /**
     * Restore the specified typeuser from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id) {

        $data = TiposUser::onlyTrashed()->find($id);

        if ($data):
            $data->restore();
            return 1;
        endif;

        return json_encode(array('message' => 'Ya esta activa'));
    }

}
