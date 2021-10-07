<?php

namespace App\Model\Manager;

use App\Model\Classes\DB;
use ReflectionClass;
use ReflectionException;

class ObjectManager {
    /**
     * Return true if the data add into the data base
     * @param $sql
     * @param $data
     * @return bool
     */
    public static function add($sql, $data): bool {
        $stmt = DB::getInstance()->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Return true if the data has been updated into the data base
     * @param $sql
     * @param $data
     * @return bool
     */
    public static function update($sql, $data): bool {
        $stmt = DB::getInstance()->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Return true id the data has been deleted into the data base
     * @param $sql
     * @return bool
     */
    public static function delete($sql): bool {
        return DB::getInstance()->prepare($sql)->execute();
    }

    /**
     * Return a table of all object of the choice table into the data base
     * @param $sql
     * @param $class
     * @return array
     */
    public static function get($sql, $class): array {
        $entities = [];

        try {
            $reflexion = new ReflectionClass($class);
            $stmt = DB::getInstance()->prepare($sql);
            $result = $stmt->execute();

            if($result && $data = $stmt->fetchAll()) {

                foreach ($data as $entity_line) {
                    $entity = new $class($entity_line['id']);

                    foreach($entity_line as $key => $value) {
                        $method = "set" . ucfirst($key);

                        if(strpos($key, "_fk")) {
                            $key = str_replace('_fk', '', $key);

                            if(strpos($key, "_")) {
                                $part = substr($key, (strpos($key, "_") + 1));
                                $part = ucfirst($part);
                                $key = substr($key, 0 , strpos($key, "_")) . $part;
                            }

                            $itemController = ucfirst($key . "Manager");;

                            $subClass = "App\\Model\\Manager\\$itemController";
                            $itemController = new $subClass();
                            $search = "search";

                            $method = "set". ucfirst($key) . "Fk";
                            $rid = $itemController->$search($value);

                            if($rid) {
                                if($reflexion->hasMethod($method)) {
                                    $entity->$method($rid);
                                }
                            }
                        }
                        elseif (strpos($key, "_")) {
                            $part = substr($key, (strpos($key, "_") + 1));
                            $part = ucfirst($part);
                            $key = substr($key, 0 , strpos($key, "_")) . $part;

                            $item = ucfirst($key);
                            $method = "set". $item;

                            if($reflexion->hasMethod($method)) {
                                $entity->$method($value);
                            }
                        }
                        elseif($reflexion->hasMethod($method)) {
                            $entity->$method($value);
                        }
                    }

                    $entities[] = $entity;
                }
            }
        }
        catch (ReflectionException $e) {}

        return $entities;
    }

    /**
     * Return an object of the choice table into the data base
     * @param $sql
     * @param $class
     * @return object
     */
    public static function search($sql, $class): ?object {
        $entity = null;
        try {
            $reflexion = new ReflectionClass($class);
            $stmt = DB::getInstance()->prepare($sql);
            $result = $stmt->execute();

            if($result && $entity_line = $stmt->fetch()) {
                $entity = new $class($entity_line['id']);

                foreach($entity_line as $key => $value) {
                    $method = "set" . ucfirst($key);

                    if(strpos($key, "_fk")) {
                        $key = str_replace('_fk', '', $key);

                        if(strpos($key, "_")) {
                            $part = substr($key, (strpos($key, "_") + 1));
                            $part = ucfirst($part);
                            $key = substr($key, 0 , strpos($key, "_")) . $part;
                        }

                        $itemController = ucfirst($key . "Manager");
                        $subClass = "App\\Model\\Manager\\$itemController";
                        $itemController = new $subClass();
                        $search = "search";

                        $method = "set". ucfirst($key) . "Fk";
                        $rid = $itemController->$search($value);

                        if($rid) {
                            if($reflexion->hasMethod($method)) {
                                $entity->$method($rid);
                            }
                        }
                    }
                    elseif (strpos($key, "_")) {
                        $part = substr($key, (strpos($key, "_") + 1));
                        $part = ucfirst($part);
                        $key = substr($key, 0 , strpos($key, "_")) . $part;

                        $item = ucfirst($key);
                        $method = "set". $item;

                        if($reflexion->hasMethod($method)) {
                            $entity->$method($value);
                        }
                    }
                    elseif($reflexion->hasMethod($method)) {
                        $entity->$method($value);
                    }
                }
            }
        }
        catch (ReflectionException $e) {}

        return $entity;
    }
}