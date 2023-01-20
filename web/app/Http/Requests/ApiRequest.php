<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApiRequest extends FormRequest
{
	/**
	 * Handle a failed validation attempt.
	 *
	 * @param  Validator  $validator
	 * @return void
	 *
	 * @throws HttpResponseException
	 */
	protected function failedValidation(Validator $validator)
	{
		$data = [
			'errors' => $validator->errors()->toArray(),
		];

		throw new HttpResponseException(response()->json($data, Response::HTTP_UNPROCESSABLE_ENTITY));
	}
}
