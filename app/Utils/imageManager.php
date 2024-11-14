<?php

namespace App\Utils;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class imageManager
{
    public static function uploadImages($request, $post = null): void
    {

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $file = $image->getClientOriginalExtension();
                $imageName = $post->slug . '_' . str::uuid() . '.' . $file;
                $path = $image->storeAs('uploads/posts', $imageName, ['disk' => 'uploads']);

                $post->images()->create([
                    'path' => $path
                ]);
            }
        }


    }

    public static function deleteImage($post): void
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::deleteImageFromLocale($image->path);
            }
        }
    }

    public static function uploadImage($request, $post, $folder): mixed
    {

            $file = $request->file('image')->getClientOriginalExtension();
            $imageName = $post . '_' . str::uuid() . '.' . $file;
            $path = $request->file('image')->storeAs($folder, $imageName, ['disk' => 'uploads']);

            return $path;


    }

    public static function checkImageToUpload($request, /*name of photo */ $user, $folder): void
    {

        if ($request->hasFile('image')) {
            //delete image from locale if exist
            self::deleteImageFromLocale($user->image);
            $path = self::uploadImage($request, $user->username, $folder);

            $user->update([
                'image' => $path
            ]);

        }

    }

    public static function deleteImageFromLocale($image)
    {
        if (File::exists(public_path($image))) {
            File::delete(public_path($image));
        }
    }

    public static function deleteImagefromLocaleAndDb($post): void
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::deleteImageFromLocale($image->path);
                $image->delete();
            }

        }
    }
    public static function uploadImageToSetting($request, $post, $folder ,$image): mixed
    {

        $file = $request->file($image)->getClientOriginalExtension();
        $imageName = $post . '_' . str::uuid() . '.' . $file;
        $path = $request->file($image)->storeAs($folder, $imageName, ['disk' => 'uploads']);

        return $path;
    }



}
