<?php

namespace WcCatalog\Services;

trait ServiceTrait
{
    public function create($data)
    {
        return $this->callCreate($this->uri, $data);
    }

    public function get($id)
    {
        return $this->callGet("$this->uri/$id");
    }

    public function all()
    {
        return $this->callGet($this->uri);
    }

    public function update($id, $data)
    {
        return $this->callUpdate("$this->uri/$id", $data);
    }

    public function delete($id, $data)
    {
        return $this->callDelete("$this->uri/$id", $data);
    }
}
