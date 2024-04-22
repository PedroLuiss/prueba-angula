<?php

namespace App\Http\Controllers;

use App\Http\Requests\employee\EmployeeStoreRequest;
use App\Models\Employee;
use App\Observers\employee\EmployeeObserver;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list_employee()
    {
        return response(Employee::all());
    }

    public function edit($id)
    {
        $data = Employee::where('id',$id)->first();
        return response($data);
    }


    public function store(EmployeeStoreRequest $request)
    {

        if ($request->id)
        {
            $model = Employee::findOrFail($request->id);
            $accion = "Editado";

        }
        else
        {
            $model = new Employee;
            $accion = " Creado";

        }

        $model->fill($request->all());

        // el formato del email
        $format_email = str_replace(' ', '', $model->firstname).".".str_replace(' ', '', $model->surname).$request->dominio;

        //formato estuctura del email ejemplo <PRIMER_NOMBRE>.<PRIMER_APELLIDO> Para filtrar en le query
        $filterEmail = str_replace(' ', '', $model->firstname).".".str_replace(' ', '', $model->surname);

        if (!$request->id){

            // ferifica si el email existe
            $verif_e = Employee::where('email', $format_email)->first();
            if ($verif_e) {
                // si existe el email verifica la cantidad de email que existe.
                $count = Employee::where(function ($query) use ($filterEmail) {
                    $query->where('email', 'like', '%' . $filterEmail . '%');
                })->count();
                // Generar email con su numero de incrementación
                $format_email = str_replace(' ', '', $model->firstname).".".str_replace(' ', '', $model->surname).".".($count).$request->dominio;
            }

            $model->email = $format_email;
        }
        // return  response($model);
        $model->save();
        //Verificar si hubo cambios en el campo surname  y firstname
        if($model->wasChanged(['surname','firstname'])){
            //verificar si existe el email
            $verif_e = Employee::where('email', $format_email)->first();
            if ($verif_e) {

                $count = Employee::where(function ($query) use ($filterEmail) {
                    $query->where('email', 'like', '%' . $filterEmail . '%');
                })->count();
                if ($count > 0) {
                    $format_email = str_replace(' ', '', $model->firstname).".".str_replace(' ', '', $model->surname).".".($count).$request->dominio;
                }
            }else{
                $format_email = str_replace(' ', '', $model->firstname).".".str_replace(' ', '', $model->surname).$request->dominio;
                // return response("else");
            }

            $model = Employee::find($request->id);
            $model->email = $format_email;
            $model->save();
        }

        return response()->json(['message' => "Empleado {$accion} correctamente"],201);
    }

    public function delete_employee(Request $request)
    {

        Employee::where('id',$request['id'])->update([
            'stated'=>false
        ]);
        return response()->json(['success' => 'Empleado Eliminado Correctamente.','status' => 200,], 201);
        // }

    }
}
