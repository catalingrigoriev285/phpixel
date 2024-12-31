<?php
require_once 'app/instances/model.php';

class User extends Model
{
    protected $table = 'users';

    public static function all()
    {
        return parent::all();
    }

    public static function find($id)
    {
        return parent::find($id);
    }

    public static function create($data)
    {
        return parent::create($data);
    }

    public static function update($id, $data)
    {
        return parent::update($id, $data);
    }

    public static function delete($id)
    {
        return parent::delete($id);
    }
}
?>