<?php

abstract class TableModule
{
    abstract public function read($id = null): array;
    abstract  public function create(array $data, array $file): void;
    abstract public function delete(int $id): void;
}