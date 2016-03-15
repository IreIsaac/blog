<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class PostFormRequest extends Request
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
        $rules = [
            'title'  => 'required|unique:posts,title',
            'body'   => 'required|min:10',
            'tags.*' => 'sometimes|required|exists:tags,id',
        ];

        //  need to make sure we can update a post without changing the title
        if (($postId = (int) $this->request->get('post_id')) > 0) {
            $rules['title'] = $rules['title'].','.$postId;
        }

        return $rules;
    }
}
