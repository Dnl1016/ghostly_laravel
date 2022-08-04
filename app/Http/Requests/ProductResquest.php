<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductResquest extends FormRequest
{
     protected $model = User::class;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =[
            'title'=>['required','max:255'],
            'description'=>['required','max:1000'],
            'price'=>['required','min:1'],
            'stock'=>['required','min:0'],
            'status'=>['required','in:available, unavailable '],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator){
            if ($this->status=='available' && $this->stock==0) {
                $validator->errors()->add('Si el producto esta disponible debe tener un stock');
            }
        });
    }
}
