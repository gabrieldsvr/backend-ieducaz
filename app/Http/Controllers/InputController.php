<?php

namespace App\Http\Controllers;

class InputController extends Controller
{
    public static function input($input)
    {

        switch ($input['type']) {
            case "string":
                return InputController::getInputText($input);
            case "iamge":
                return InputController::getInputImage($input);
        }

        echo "<br>";
        return "";
    }

    public static function getInputText($options = [])
    {
        return ' <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="cidade" class="text-uppercase">'.$options['name'].'</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="cidade">
                        </div>';
    }

    public static function getInputImage($options = [])
    {
        return ' <div class="form-group">
                            <input type="file"  class="form-control" name="photos[]" multiple required>
                        </div>';
    }


}
