<?php

namespace Modules\Affiliate\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;
use Modules\Affiliate\Entities\AffiliateAccount;

class SaveAffiliateAccountRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => ['required', 'regex:/(0[3|5|7|8|9])+([0-9]{8})\b/u'],
            'address' => 'required|string',
            'status' => 'required|int|in:0,1,2',
            'users' => 'required|array',
            'users.*' => 'required|int|exists:users,id',
            'type' => [
                'required',
                Rule::in([
                    AffiliateAccount::TYPE_NORMAL,
                    AffiliateAccount::TYPE_AGENCY
                ])
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
