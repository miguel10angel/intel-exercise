<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $appends = ['date_formated', 'buttons', 'preview'];
    protected $guarded = [];

    /**
     * Da formato a la fecha de ingreso.
     *
     * @return void
     */
    public function getDateFormatedAttribute(){
        return \Carbon\Carbon::parse($this->ingresed_at)->locale('es')->isoFormat('DD [de] MMMM YYYY');
    }

    /**
     * Agrega los botones para editar y elimiar los registros
     *
     * @return void
     */
    public function getButtonsAttribute(){
        return '<a class="btn btn-primary" href="javascript:getUser(' . $this->id . ')" >Detalles</a> <a class="btn btn-danger" id="' . $this->id . '" href="javascript:;" >Eliminar</a>';
    }

    /**
     * Agrega la vista previa de la imagen del usuario
     *
     * @return void
     */
    public function getPreviewAttribute(){
        return '<div class="preview" style="background-image: url(/files/users/' . $this->file . ')"></div>';
    }
}
