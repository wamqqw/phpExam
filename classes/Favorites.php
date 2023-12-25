<?php
class Favorites {
    private $id;
    private $userId;
    private $cityId;
    private $order;

    public function __construct($userId, $cityId, $order) {
        $this->userId = $userId;
        $this->cityId = $cityId;
        $this->order = $order;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getCityId() {
        return $this->cityId;
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }
}
?>