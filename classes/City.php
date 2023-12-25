<?php
class City {
    private $id;
    private $name;
    private $country;
    private $coordinates;

    public function __construct($name, $country, $coordinates) {
        $this->name = $name;
        $this->country = $country;
        $this->coordinates = $coordinates;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getCoordinates() {
        return $this->coordinates;
    }

    public function setCoordinates($coordinates) {
        $this->coordinates = $coordinates;
    }
}
?>