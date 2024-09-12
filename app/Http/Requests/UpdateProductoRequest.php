<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'nombre' => 'required|string|max:50',
          'aroma_id' => 'nullable|integer|max:500',
          'condicion_venta_id' => 'required|integer|min:1|max:10', //cambiar a required
          'descripcion' => 'nullable|string|max:250'
        ];
    }
}