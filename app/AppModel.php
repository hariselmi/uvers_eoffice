<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AppModel extends Model
{
    
    public function fileUrl($col=null, $option=null)
    {
        $col = !empty($col) ? $col : 'avatar';
        
        if (!empty($option) && $option == 'path') {
            return Storage::url($this->$col);
        }  else {
            return asset(Storage::url($this->$col));
        }
    }
}
