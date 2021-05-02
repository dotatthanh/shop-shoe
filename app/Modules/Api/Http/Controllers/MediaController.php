<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::orderby('id', 'desc');

        if ($request->has('media_filter_date') && $request->media_filter_date != 'all') {
            $query->whereMonth('created_at', date('m', strtotime($request->media_filter_date)));
            $query->whereYear('created_at', date('Y', strtotime($request->media_filter_date)));
        }

        if ($request->has('key')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->key.'%')
                    ->orWhere('url', 'like', '%'.$request->key.'%');
            });
        }

        $page_number = 50;

        $medias = $query->paginate($page_number);

        $data = '';
        if ($medias->isEmpty()) {
            if ($request->page == 1) {
                $code = 204;
                $message = __('Không có dữ liệu');
                $data = '<div class="media-empty" style="font-weight: bold; text-align: center; margin-top: 40px;">'.__('không có tệp tin nào').'</div>';
            } else {
                $code = 404;
                $message = __('Không tồn tại');
            }
        } else {
            $code = 200;
            $message = __('Thành công!');

            if ($medias->count() < $page_number) {
                $page_last = true;
            }

            foreach ($medias as $key => $media) {
                $data .= '<li id="media-li-'.$media->id.'">'.
                    '<input type="hidden" name="value-id" id ="value-id" value="'.$media->id.'">'.
                    '<input type="checkbox" id="cb'.$media->id.'" name="check_image_media[]" value="'.$media->url.'"/>'.
                    '<label for="cb'.$media->id.'"><img src="'.$media->url.'" /></label>'.
                '</li>';
            }
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'page_last' => $page_last ?? false,
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $fileName = date('Y/m').'/'.((Media::orderby('id', 'desc')->first()->id ?? 0) + 1).'-'.time().'.'.$file->getClientOriginalExtension();
            $imageName = $file->getClientOriginalName();
            $imageNameConvert = ((Media::orderby('id', 'desc')->first()->id ?? 0) + 1).'-'.time().'.'.$file->getClientOriginalExtension();
            $img = Image::make($file)->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if (!File::exists('uploads/source')) {
                File::makeDirectory('uploads/source', 0777, true);
            }
            if (!File::exists('uploads/thumbnails')) {
                File::makeDirectory('uploads/thumbnails/', 0777, true);
            }
            $url = 'uploads/source/'.$imageNameConvert;
            $thumbnails_path = 'uploads/thumbnails/'.$imageNameConvert;
            Image::make($file)->save(public_path($url));
            Image::make($file)->resize(150,150)->save(public_path($thumbnails_path));

            $media = Media::create([
                'admin_id' => Auth()->guard('admin')->user()->id,
                'title' => $file->getClientOriginalName(),
                'type' => $file->getClientOriginalExtension(),
                'url' => '/'.$url,
                'thumbnail' => '/'.$thumbnails_path,
                'caption' => $file->getClientOriginalName(),
                'place_storage' => 'local',
                'size' => $file->getSize(),
                'status' => 'active',
            ]);

            $media->url = $media->url;
            $media->thumbnail = $media->thumbnail;
            $media->title = $media->title;
            $media->status = $media->status;

            return response()->json([
                'code' => 200,
                'message' => __('Tải lên thành công.'),
                'data' => $media,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => __('Thiếu dữ liệu file cần tải lên.'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        Media::whereIn('id', $request->array_id)->update([
            'status' => 'delete',
        ]);

        return response()->json([
            'code' => 200,
            'message' => __('Xóa thành công.'),
        ]);
    }
}
