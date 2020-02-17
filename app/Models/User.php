<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $appends = ['date_formated', 'buttons', 'preview'];
    protected $guarded = [];

    public function getDateFormatedAttribute(){
        return \Carbon\Carbon::parse($this->ingresed_at)->locale('es')->format('d \d\e F Y');
    }

    public function getButtonsAttribute(){
        return '<a class="btn btn-primary" href="javascript:getUser(' . $this->id . ')" >Detalles</a> <a class="btn btn-danger" id="' . $this->id . '" href="javascript:;" >Eliminar</a>';
    }

    public function getPreviewAttribute(){
        return '<div class="preview" style="background-image: url(/files/users/' . $this->file . ')"></div>';
    }
}
