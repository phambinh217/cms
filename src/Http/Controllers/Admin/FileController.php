<?php 

namespace Packages\Cms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AdminController;

class FileController extends AdminController
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'files' => 'required',
        ]);

        $pathUpload = image_path();

        // Lưu dữ liệu trả về trình duyệt
        $results = [];

        // Lưu dữ liệu insert vào database
        $dataFile = [];

        // Trường hợp gửi bằng js, qua class FormData
        // Không đặt tên được tên trường chứa file
        // Nên không lấy được file thông qua khóa 'files'
        // Điều này cần khắc phục phía js
        $files = $request->file('files');
        if (! $files) {
            $files = $request->file();
        }

        $urlFiles = [];
        foreach ($files as $file) {
            if ($file->isValid()) {
                $urlFiles[] = image_url($file->getClientOriginalName());
                $info = $file->move($pathUpload, $file->getClientOriginalName());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'message'   =>  'Uploaded',
                'data'        =>    $results,
                'url'        => $urlFiles,
            ], 200);
        }
    }
}
