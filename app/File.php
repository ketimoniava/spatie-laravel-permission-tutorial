<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class File extends Model
{
    protected $guarded = [];

    public function post(){     
        return $this->belongsTo(Post::class);
    }

    public function user(){  
        return $this->belongsTo(User::class);
    }

    public static function getMaxSize()
    {
        return (int)ini_get('upload_max_filesize') * 2000;
    }
    /**
     * Get directory for the specific user
     * @return string Specific user directory
     */
    public function getUserDir()
    {
        return Auth::user()->name . '_' . Auth::id();
    }
    /**
     * Get all extensions
     * @return array Extensions of all file types
     */
    public static function getAllExtensions()
    {
        $merged_arr = array_merge(self::$image_ext, self::$audio_ext, self::$video_ext, self::$document_ext);
        return implode(',', $merged_arr);
    }
    /**
     * Get type by extension
     * @param  string $ext Specific extension
     * @return string      Type
     */
    public function getType($ext)
    {
        if (in_array($ext, self::$image_ext)) {
            return 'image';
        }
        if (in_array($ext, self::$audio_ext)) {
            return 'audio';
        }
        if (in_array($ext, self::$video_ext)) {
            return 'video';
        }
        if (in_array($ext, self::$document_ext)) {
            return 'document';
        }
    }

    /**
     * Get file name and path to the file
     * @param  string $type      File type
     * @param  string $name      File name
     * @param  string $extension File extension
     * @return string            File name with the path
     */

    public function resize($path, $uploaded_file, $filename, $size){
       
        $image_resize = Image::make($uploaded_file->getRealPath());              
        $image_resize->resize($size);
        $image_resize->save(storage_path($path.$filename));
    }

    public function getName($type, $name, $extension)
    {
        return '/public/' . $this->getUserDir() . '/' . $type . '/' . $name . '.' . $extension;
    }


    public function getFileName($type, $name)
    {
        return '/public/' . $this->getUserDir() . '/' . $type . '/' . $name;
    }

    /**
     * Upload file to the server
     * @param  string $type      File type
     * @param  object $file      Uploaded file from request
     * @param  string $name      File name
     * @param  string $extension File extension
     * @return string|boolean    String if file successfully uploaded, otherwise - false
     */


    public function upload($path, $type, $file, $name, $extension)
    {
       
        $full_name = $name . '.' . $extension;
        return Storage::putFileAs($path, $file, $full_name);
    }//

   
}