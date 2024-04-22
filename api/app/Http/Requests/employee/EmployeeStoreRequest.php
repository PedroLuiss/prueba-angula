<?php

namespace App\Http\Requests\employee;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id;
        return [
            'email' =>
            [
                'required',
                'email',
                // Rule::unique('employees','email')->ignore($id,'id'),
                'max:300'
            ],
            'surname' =>['required', 'regex:/^[ A-Za-z]*$/', 'max:20','uppercase'],
            'secondsurname' => ['required', 'regex:/^[ A-Za-z]*$/', 'max:20','uppercase'],
            'firstname' => ['required', 'regex:/^[ A-Za-z]*$/', 'max:20','uppercase'],
            'othernames' => ['regex:/^[ A-Za-z]*$/', 'max:50','uppercase'],
            'countryemployment' => 'required',
            'typeidentifi' => 'required',
            'numberidentifi' =>[
                'required',
                'max:20',
                'string',
                Rule::unique('employees','numberidentifi')->ignore($id,'id')
            ],
            'numberidentifi' => ['regex:/^[a-zA-Z0-9\-]+$/'],
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            // 'email.unique' => 'El campo email ya esta en uso.',
            'email.max' => 'El campo email debe ser maximo 300 caracteres.',

            'surname.required' => 'El campo primer apellido es obligatorio.',
            'surname.regex' => 'El campo primer apellido solo permite caracteres de la A a la Z mayúscula, sin acentos ni Ñ.',
            'surname.max' => 'El campo primer apellido debe ser maximo 20 letras.',
            'surname.uppercase' => 'El campo primer apellido solo permite textos en mayusculas.',

            'secondsurname.required' => 'El campo segundo apellido es obligatorio.',
            'secondsurname.regex' => 'El campo segundo apellido solo permite caracteres de la A a la Z mayúscula, sin acentos ni Ñ.',
            'secondsurname.max' => 'El campo segundo apellido debe ser maximo 20 letras.',
            'secondsurname.uppercase' => 'El campo segundo apellido solo permite textos en mayusculas.',

            'firstname.required' => 'El campo primer nombre es obligatorio.',
            'firstname.regex' => 'El campo primer nombre solo permite caracteres de la A a la Z mayúscula, sin acentos ni Ñ.',
            'firstname.max' => 'El campo primer nombre debe ser maximo 20 letras.',
            'firstname.uppercase' => 'El campo primer nombre solo permite textos en mayusculas.',

            'othernames.required' => 'El campo otros nombres es obligatorio.',
            'othernames.regex' => 'El campo otros nombres solo permite caracteres de la A a la Z mayúscula, sin acentos ni Ñ.',
            'othernames.max' => 'El campo otros nombres debe ser maximo 50 letras.',
            'othernames.uppercase' => 'El campo otros nombres solo permite textos en mayusculas.',

            'countryemployment.required' => 'El campo país del empleo es obligatorio.',


            'numberidentifi.required' => 'El campo número de identificación es obligatorio.',
            'numberidentifi.regex' => 'El campo número de identificación debe ser alfanumérico permitiendo los siguientes conjuntos de caracteres (a-z / A-Z / 0-9 / -)',
            'numberidentifi.max' => 'El campo número de identificación debe ser maximo 20 letras.',
            'numberidentifi.string' => 'El campo número de identificación debe ser tipo string.',
        ];
    }


        /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $dataResp=[
            "errors"=>$validator->errors(),
            "return"=>false
        ];
        throw new HttpResponseException(response()->json($dataResp, 422));
    }
}
