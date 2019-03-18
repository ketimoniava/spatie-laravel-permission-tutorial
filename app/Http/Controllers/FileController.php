<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
//use App\Mail\PostCreated;

use App\Http\Requests\StorePost;

use Intervention\Image\ImageManagerStatic as Image;


//use Image;
use App\File;

class FileController extends Controller
{
    /**
     * Constructor
     */


    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Fetch files by Type or Id
     * @param  string $type  File type
     * @param  integer $id   File Id
     * @return object        Files list, JSON
     */
    public function index($type, $id = null)
    {
        $model = new File();
        if (!is_null($id)) {
            $response = $model::findOrFail($id);
        } else {
            $records_per_page = ($type == 'video') ? 6 : 15;
            $files = $model::where('type', $type)
                            ->where('user_id', Auth::id())
                            ->orderBy('id', 'desc')->paginate($records_per_page);
            $response = [
                'pagination' => [
                    'total' => $files->total(),
                    'per_page' => $files->perPage(),
                    'current_page' => $files->currentPage(),
                    'last_page' => $files->lastPage(),
                    'from' => $files->firstItem(),
                    'to' => $files->lastItem()
                ],
                'data' => $files
            ];
        }
        return response()->json($response);
    }
    /**
     * Upload new file and store it
     * @param  Request $request Request with form data: filename and file info
     * @return boolean          True if success, otherwise - false
     */

    public function create(Post $post){
        //dd($post->id);
        return view('files.create', compact('post'));
    }    

    public function store(Post $post)
    {        
        //$uploadfiles = request()->allFiles('upload-files');

        $i = 0;

        foreach (request()->allFiles('upload-files') as $uploadfile) {

            $this->validate(request(), [
                'upload-files.*' => 'required|file|mimes:' . File::getAllExtensions() . '|max:' . File::getMaxSize()
            ]);

            //dd($uploadfile['']);

            $file = new File();
            
            $original_file_name = $uploadfile[$i]->getClientOriginalName();
            
            $original_ext = $uploadfile[$i]->getClientOriginalExtension();                
            $type = $file->getType($original_ext);
            $orig_file_size = $uploadfile[$i]->getClientSize();

            $name = substr(str_shuffle("0123456789qwertyuiopasdfghjklzxcvbnm"), 0, 20);

            $filename = $name.'.'.$original_ext;
            
            $attributes = ([
                        "filename" => $filename,
                        "type" => $type,
                        "extension" => $original_ext,
                        "orig_name" => $original_file_name,
                        "orig_size" => $orig_file_size,
                        "user_id" => auth()->id(),
                        "post_id" => $post->id
                    ]); 

            $size = 600;    

            $path = '/public/posts/' . $type . '/original/';        
            
            $path_small = 'app/public/posts/' . $type . '/small/';

            if ($file->upload($path, $type, $uploadfile[$i], $name, $original_ext)) { 
                if($type=='image'){                
                    $file->resize($path_small, $uploadfile[$i], $filename, $size); 
                }
                $post->addFile($attributes);

                return $post->addFile($attributes);           
            }
            $i++;

        } //upload multiple file
        return response()->json(false);
    }
    /**
     * Edit specific file
     * @param  integer  $id      File Id
     * @param  Request $request  Request with form data: filename
     * @return boolean           True if success, otherwise - false
     
    /**
     * Delete file from disk and database
     * @param  integer $id  File Id
     * @return boolean      True if success, otherwise - false
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if (Storage::disk('local')->exists($file->getName($file->type, $file->name, $file->extension))) {
            if (Storage::disk('local')->delete($file->getName($file->type, $file->name, $file->extension))) {
                return response()->json($file->delete());
            }
        }
        return response()->json(false);
    }
}