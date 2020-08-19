<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayment extends FormRequest
{
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
        return [
            'bank' => "required|in:rajhi,jazira,saib,ahli",
            'date' => "required|in:today,yesterday,two_three_days_ago,aweek_ago,a_amonth_ago, other",
            'name' => "required",
            'details' => "nullable",
            'amount' => "required"
        ];
    }
}
