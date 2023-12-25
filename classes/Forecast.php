<?php
class Forecast {
    private $id;
    private $cityId;
    private $minTemp;
    private $maxTemp;
    private $days;
    private $feelsLike;
    private $wind;

    public function __construct($cityId, $minTemp, $maxTemp, $days, $feelsLike, $wind) {
        $this->cityId = $cityId;
        $this->minTemp = $minTemp;
        $this->maxTemp = $maxTemp;
        $this->days = $days;
        $this->feelsLike = $feelsLike;
        $this->wind = $wind;
    }

    public function getId() {
        return $this->id;
    }

    public function getCityId() {
        return $this->cityId;
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getMinTemp() {
        return $this->minTemp;
    }

    public function setMinTemp($minTemp) {
        $this->minTemp = $minTemp;
    }

    public function getMaxTemp() {
        return $this->maxTemp;
    }

    public function setMaxTemp($maxTemp) {
        $this->maxTemp = $maxTemp;
    }

    public function getDays() {
        return $this->days;
    }

    public function setDays($days) {
        $this->days = $days;
    }

    public function getFeelsLike() {
        return $this->feelsLike;
    }

    public function setFeelsLike($feelsLike) {
        $this->feelsLike = $feelsLike;
    }

    public function getWind() {
        return $this->wind;
    }

    public function setWind($wind) {
        $this->wind = $wind;
    }
}
?>