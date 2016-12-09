<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Repository class that handles the conversion of custom data list into a Laravel paginated collection
 *
 * @author Thai-Vu Nguyen
 */
class PaginationRepository {

    /**
     * Method to paginate custom search query results.
     * 
     * Credit to psampaz
     * http://psampaz.github.io/custom-data-pagination-with-laravel-5/
     * 
     * @param array $data The custom collection of data you want to paginate
     * @param string $path Where your pagination link should lead to
     * @param int $perPage The maximum amount of elements displayed per page
     * 
     */
    public function makePaginableCollection($data, $path, $perPage = 6) {
        $currPage = LengthAwarePaginator::resolveCurrentPage();
        //Convert the array of data into a laravel collection
        $collection = new Collection($data);

        //Slicing the results by the number of the results per page
        $currentPageResults = $collection->slice(($currPage - 1 ) * $perPage, $perPage)->all();
        //Paginated results
        $paginatedResults = new LengthAwarePaginator($currentPageResults, count($collection), $perPage);
        return $paginatedResults->setPath($path);
    }

}
