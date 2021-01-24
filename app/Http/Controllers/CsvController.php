<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use DB;

class CsvController extends Controller
{

    /**
     * Index
     */
    public function index(){
        return view('index');
    }

    /**
     * Subida de fichero
     */
    public function uploadCsv(Request $request)
    {
        $request->validate(['file' => 'required']);

        $file = $request->file('file');
        //Ruta del script en python
        $ruteScript = base_path('python')."/script.py";
        //Ruta donde voy a guardar el csv
        $ruteCsv = base_path('python/'). $file->getClientOriginalName();
        //Muevo el fichero a la ruta
        $file->move(base_path('python'), $file->getClientOriginalName());
        //Lanzo un script en python que mediante la funcion copy inserta los datos del csv en la base de datos
        $process = new Process(['python', $ruteScript, $ruteCsv]);
        $process->setTimeout(240);
        $process->run();
        
        //Compruebo si el proceso se ha ejecutado correctamente
        if (!$process->isSuccessful()) {
            return back()->with('error',$process->getOutput());
        }
        
        return back()->with('success',$process->getOutput());
    }

    /**
     * Fecha_desde(inicial) y fecha_desde(final) para un mismo id
     */
    public function fechasId(){
        $result = DB::select('select id, min(fecha_desde), max(fecha_hasta) from csvs group by id');
        $title = "Fecha desde(inicio) y fecha_desde(final) para un mismo id";
        return view('fechas.index', compact('result','title'));
    }

    /**
     * Encontrar registros duplicados
     */
    public function duplicados()
    {
        $result = DB::select('select (csvs.*)::text, count(*) from csvs group by csvs.* having count(*) > 1');
        $title = "Registros duplicados";
        return view('duplicados.index', compact('result','title'));
    }

    /**
     * Encontrar registros erroneos
     */
    public function erroneos()
    {
        $result = DB::select('select (csvs.*)::text, count(*) from csvs where fecha_desde > fecha_hasta group by csvs.*');
        $title = "Registros erroneos";
        return view('erroneos.index', compact('result','title'));
    }

}
