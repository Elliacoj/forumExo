<?php

namespace App\Model\Manager\Traits;

trait TraitsManager {
    private static ?Object $manager = null;

    /**
     * Return manager or new manager
     * @return TraitsManager|Object|null
     */
    public static function getManager() {
        if(self::$manager === null) {
            self::$manager = new self();
        }
        return self::$manager;
    }
}