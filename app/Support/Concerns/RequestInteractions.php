<?php

namespace App\Support\Concerns;

use App\Support\FormAction;
use Illuminate\Http\Request;

trait RequestInteractions
{
    public function setRequest(Request $request): FormAction
    {
        $this->request = $request;

        return $this;
    }

    public function set(string|array $key, mixed $value = null, bool $replace = false): FormAction
    {
        if (is_array($key)) {
            if ($replace) {
                $this->request->replace($key);
            } else {
                $this->request->merge($key);
            }
        } else {

            if (is_callable($value)) {
                $value = $this->app->call($value);
            }

            // TODO: Check if the value is an Enum, if so, get the value

            if ($replace) {
                $this->request->replace([$key => $value]);
            } else {
                if (! $this->request->has($key)) {
                    $this->request->merge([$key => $value]);
                    // if($key === 'user') {
                    //     dd($this->request->all());
                    // }
                }
            }
        }

        return $this;
    }

    public function setIfMissing(string|array $key, mixed $value): FormAction
    {
        if(is_array($key)) {
            foreach ($key as $k => $v) {
                if(! $this->has($k)) {
                    $this->set($k, $v);
                }
            }

            return $this;
        }
        
        $this->set($key, $value, replace: false);

        return $this;
    }

    public function replace(string|array $key, mixed $value): FormAction
    {
        $this->set($key, $value, replace: true);

        return $this;
    }

    public function has(string|array $key): bool
    {
        return $this->request->has($key);
    }

    public function hasAny(string|array $keys): bool
    {
        return $this->request->hasAny($keys);
    }

    public function hasAll(array $keys): bool
    {
        foreach ($keys as $key) {
            if (! $this->has($key)) {
                return false;
            }
        }

        return true;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->request->get($key, $default);
    }
}
