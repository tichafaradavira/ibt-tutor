<?php

namespace Modules\Files\Http\Controllers\Traits;


use Illuminate\Http\Request;

trait Fileable
{

    function getFileMeta(Request $request)
    {
        $meta['extension'] = $request->file('file')->getMimeType();
        $meta['size'] = $request->file('file')->getSize();
        $meta['original_name'] = $request->file('file')->getClientOriginalName();
        return $meta;
    }

    function getDirectory($file_group)
    {
        return 'public/tutor_' . $this->course_repository->user->id . '/' . $file_group;
    }
}
