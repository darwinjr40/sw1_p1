<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait ApiTrait{

    //-------------------------------------------------------------------------------------------------------------------------------
    //si tenemos incluido
    public function scopeIncluded(Builder $query){

        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included')); //['posts','relacion2']
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (! $allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
    //buscar por filtros
    public function scopeFilter(Builder $query){
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE' , '%' . $value . '%')->orderBy('id', 'asc');
            }
        }
    }
    //ordenar
    public function scopeSort(Builder $query){
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            
            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }

        }
    }
    //mostrar por paginas
    public function scopeGetOrPaginate(Builder $query){
        if (request('perPage')) {
            $perPage = intval(request('perPage'));//retorna un entero

            if ($perPage) { //tiene un valor > 0
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
    //-------------------------------------------------------------------------------------------------------------------------------

}