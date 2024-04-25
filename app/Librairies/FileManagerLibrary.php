<?php

namespace App\Librairies;
use Carbon\Carbon;
use File;
use Config;
use Image;

class FileManagerLibrary
{
	public function createFile($file,$file_directory,$encryptName)
	{
            $fileID = $this->setFileID($file);
            $fileName = $encryptName? $fileID : $file->getClientOriginalName();
            //Enregistrer fichier
            $savedImage = $file->move($file_directory,$fileName);

            return $fileName;
      }

      public function saveUploadFile($request,$entityFile,$entity,$i)
      {
            $file = $request->get('file' . $i);
            $size = $request->get('size' . $i);

            $entityFile->file = $file;
            $entityFile->size = $size;
            $entityFile->fileID = $this->setUniqueId($size);
            $entityFile->save();
             
      }

      public function setFileID($file)
      {
            $daterangeLibrary = new DaterangeLibrary;
            $timestamp = $daterangeLibrary->getFormattedTimestamp();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $fileID = $timestamp . '-' . $size . '-' . rand(11111111, 99999999) . '.' . $extension;
            return $fileID;
      }

      public function setUniqueId($fileSize)
      {
            $daterangeLibrary = new DaterangeLibrary;
            $timestamp = $daterangeLibrary->getFormattedTimestamp();
            $fileID = $timestamp . '-' . $fileSize . '-' . rand(11111111, 99999999);
            return $fileID;

      }


      public function createSliderFile($file,$file_directory)
      {
            $daterangeLibrary = new DaterangeLibrary;
            $timestamp = $daterangeLibrary->getFormattedTimestamp();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $fileName = 'slider-'.$timestamp.'-'.$size.'.'.$extension;
            //Enregistrer image
            $savedImage = $file->move($file_directory,$fileName);

            return $fileName;
      }

	public function createThumbnail($fileName,$file_directory,$thumb_directory)
	{
		    //Créer thumbnail
            $image = Image::make($file_directory.$fileName);
            $thumb = $image->resize(110,106);
            $thumb->save($thumb_directory.$fileName);
      }

      public function getFileIcon($filename)
      {
            if ($filename == '')
                  $icon = "Document-icon.png";
            else {
                  $fileExt = explode(".", $filename);
                  $icon = "";
                  switch ($fileExt[1]) {
                        case 'docx':
                        case 'doc':
                              $icon = "Word-icon.png";
                              break;
                        case 'xlsx':
                        case 'xls':
                              $icon = "Excel-icon.png";
                              break;
                        case 'pdf':
                              $icon = "PDF-Document-icon.png";
                              break;
                        default:
                              $icon = "Document-icon.png";
                              break;
                  }
            }

            return $icon;
      }

	public function deleteFile($file,$directory)
	{
        return File::delete($directory.$file);
	}

      public function domDocumentEncoding($body)
      {
            $dom = new \DOMDocument();
            $body = mb_convert_encoding($body, 'HTML-ENTITIES', 'UTF-8');
            @$dom->loadHTML($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach($images as $img)
            {
                  $src = $img->getAttribute('src');

                  // if the img source is 'data-url'
                  if(preg_match('/data:image/', $src))
                  {
                      
                      // get the mimetype
                      preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                      $mimetype = $groups['mime'];
                      
                      // Generating a random filename
                      $filename = uniqid();
                      $filepath = "/images/upload/$filename.$mimetype";

                      // @see http://image.intervention.io/api/
                      $image = Image::make($src)
                        // resize if required
                         // ->resize(318, 318) 
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));
                      
                      $new_src = asset($filepath);
                      $img->removeAttribute('src');
                      $img->setAttribute('src', $new_src);
                  }
            }

            return $dom;
      }
}