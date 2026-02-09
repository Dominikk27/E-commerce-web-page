<?php 

    function getCurrentPage(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if($page < 1) {
            $page = 1;
        }

        return $page;
    }

    function getTotalPages(int $totalItems, int $itemsPerPage){
        return (int) ceil($totalItems / $itemsPerPage);
    }

    function paginate(array $items, int $page, int $itemsPerPage){
        $offset = ($page - 1) * $itemsPerPage;

        return array_slice($items, $offset, $itemsPerPage);
    }

    function getPaginationPages(int $current, int $total, int $range = 2){
        $pages = [];

        $start = max(1, $current-$range);
        $end = min($total - 1, $current + $range);

        if($start > 2){
            $pages[] = "...";
        }

        for($i = $start; $i <= $end; $i++){
            $pages[] = $i;
        }

        if($end < $total - 1){
            $pages[] = '...';
        }

        if($total > 1){
            $pages[] = $total;
        }

        return $pages;
    }

?>