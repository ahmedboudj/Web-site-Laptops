<?php

class Image extends Model
{

    public function __construct()
        {
            parent::__construct();
            $this->table = "Image";
        }

    public function upload($data)
        {
            $this->sql = "insert into " . $this->table . "(id_laptop, chemin_image) VALUE (:id_laptop, :chemin_image)";
            return $this->getLines($data, null);

        }

    public function update($data)
        {
            $this->sql = "UPDATE " . $this->table . " SET chemin_image = :chemin_image WHERE id_laptop = :id_laptop";
            return $this->getLines($data, null);
        }

}