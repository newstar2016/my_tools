<?php

namespace App\Traits;


/**
 * 组件工具类
 *
 * @package App\Traits
 */
trait AssemblyTools
{
    /**
     * 执行组件
     *
     * @param $builderObject
     * @param $config
     * @param $version
     * @param $request_param
     *
     * @return string
     */

    public function doOrderAssembly($builderObject, $config, $version,$request_param)
    {
        $orderObject            = '';
        $class_name_arr         = explode("\\", get_class($builderObject));
        $current_builder_config = $config[$version][end($class_name_arr)] ?? '';

        if (isset($config[$version])) {
            foreach ($config[$version]['default'] as $key => $value) {
                if (class_exists($value)) {
                    $AssemblyObject = new $value();
                    if (!empty($current_builder_config)) {
                        if (isset($current_builder_config[$key])) {
                            $temp_assembly  = $current_builder_config[$key];
                            $AssemblyObject = new $temp_assembly();
                        }
                    }

                    if ($key == 'getOrderObject') {
                        $orderObject = $builderObject->$key($AssemblyObject);
                    }else if($key == 'setRequestParam') {
                        $orderObject = $builderObject->$key($request_param,$AssemblyObject);
                    }else{
                        $builderObject->$key($AssemblyObject);
                    }
                } else {
                    if ($key == 'getOrderObject') {
                        $orderObject = $builderObject->$key();
                    }else if($key == 'setRequestParam'){
                        $builderObject->$key($request_param);
                    }else{
                        $builderObject->$key();
                    }
                }

            }
        } else {
            echo "下单接口版本：" . $version . ',配置不存在';
            exit;
        }
        return $orderObject;
    }
}
