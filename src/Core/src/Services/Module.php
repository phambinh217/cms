<?php 

namespace Phambinh\Cms\Core\Services;

/**
 * Class Quản lí tất cả các module
 */
class Module
{
    /**
     * Đối tượng module
     * @var array
     */
    protected $modules;

    public function __construct()
    {
        $this->modules = collect();
    }

    public function registerFromJsonFile($id, $path)
    {
        $filename = basename($path);
        if (starts_with($filename, 'theme')) {
            $type = 'theme';
        } else {
            $type = 'module';
        }

        if (\File::exists($path)) {
            $info = json_decode(\File::get($path));
            $path = realpath($path);
            $info->path = $path;
            $info->type = $type;
            $parent_dirname = dirname($path);
            
            if (\File::exists($parent_dirname .'/icon.png')) {
                $info->icon = url(str_replace([public_path(), $type.'.json', DIRECTORY_SEPARATOR], [null, null, '/'], $path) .'icon.png');
            } else {
                $info->icon = config('cms.default-icon');
            }

            $this->modules->push($info);
        }
    }

    /**
     * Gọi các phương thức trang collection
     * @param  string $method
     * @param  array $params
     * @return collection()
     */
    public function __call($method, $params)
    {
        if (! method_exists($this, $method)) {
            return call_user_func_array([$this->modules, $method], $params);
        }
    }
}
