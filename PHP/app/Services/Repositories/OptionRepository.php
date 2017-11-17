<?php

namespace App\Services\Repositories;

use DB;
use Illuminate\Support\Arr;
use Illuminate\Database\QueryException;

class OptionRepository extends Repository {
    static private $transMap = [];

    /**
     * Create a new option repository.
     *
     * @return void
     */
    public function __construct() {
        try {
            $options = DB::table('plugin_options')->orderby('order', 'desc')->get();
        } catch (QueryException $e) {
            $options = [];
        }

        foreach ($options as $option) {
            $this->items[$option->option_name] = $option->status;
        }

    }

    /**
     * Get the specified option value.
     *
     * @param  string $key
     * @param  mixed $default
     * @param  raw $raw return raw value without convertion
     * @return mixed
     */
    public function get($key, $default = null, $raw = false) {
        if (!$this->has($key) && Arr::has(config('aSetting'), $key)) {
            $this->set($key, config("aSetting.$key"));
        }

        $value = Arr::get($this->items, $key, $default);

        if ($raw) return $value;

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'null':
            case '(null)':
                return;

            default:
                return $value;
                break;
        }
    }

    public function delete($key) {
        return DB::table('plugin_options')->where('option_name', $key)->delete();
    }

    //获取启用的所有插件
    public function getEnabled() {
        $enabled_data = array();
        foreach ($this->items as $k => $v) {
            //启用的插件
            if ($v == 2) {
                $enabled_data[] = $k;
            }
        }

        return json_encode($enabled_data);
    }

    /**
     * Set a given option value.
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return void
     */
    public function set($key, $value = null) {
        if (is_array($key)) {
            // If given key is an array
            foreach ($key as $innerKey => $innerValue) {
                Arr::set($this->items, $innerKey, $innerValue);
                $this->doSetOption($innerKey, $innerValue);
            }
        } else {
            Arr::set($this->items, $key, $value);
            $this->doSetOption($key, $value);
        }
    }

    /**
     * Do really save modified options to database.
     *
     * @return void
     */
    public function doSetOption($key, $value, $order = 1) {
        try {

            if (!DB::table('plugin_options')->where('option_name', $key)->first()) {
                $r = DB::table('plugin_options')
                    ->insert(['option_name' => $key,
                        'status' => $value,
                        'create_time' => date('Y-m-d H:i:s'),
                        'order' => $order
                    ]);
                return $r;
            } else {
                $r = DB::table('plugin_options')
                    ->where('option_name', $key)
                    ->update(['status' => $value]);
                return $r;
            }
        } catch (QueryException $e) {
            return;
        }
    }

    /**
     * Do really save modified options to database.
     *
     * @deprecated
     * @return void
     */
    public function save() {
        $this->itemsModified = array_unique($this->itemsModified);

        try {
            foreach ($this->itemsModified as $key) {
                if (!DB::table('plugin_options')->where('option_name', $key)->first()) {
                    DB::table('plugin_options')
                        ->insert(['option_name' => $key, 'status' => $this[$key]]);
                } else {
                    DB::table('plugin_options')
                        ->where('option_name', $key)
                        ->update(['status' => $this[$key]]);
                }
            }

            // clear the list
            $this->itemsModified = [];
        } catch (QueryException $e) {
            return;
        }
    }

    /**
     * Prepend a value onto an array option value.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function prepend($key, $value) {
        $array = $this->get($key);

        array_unshift($array, $value);

        $this->set($key, $array);
    }

    /**
     * Return the options with key in the given array.
     *
     * @param  array $array
     * @return array
     */
    public function only(Array $array) {
        $result = [];

        foreach ($this->items as $key => $value) {
            if (in_array($key, $array)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Save all modified options into database
     */
    public function __destruct() {
        $this->save();
    }

    public static function pluginTrans($plugin, $trans) {
        if (array_key_exists($plugin, self::$transMap)) {
            return self::$transMap[$plugin][$trans];
        } else {
            self::$transMap[$plugin] = include plugin($plugin)->getPath() . '/lang/' . PLUGIN_LANG . '.php';

            return self::$transMap[$plugin][$trans];
        }
    }

}
