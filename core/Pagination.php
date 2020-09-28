<?php
namespace Core;
use Core\Input;
use Core\Router;

class Pagination {
    public $currentPage;
    public $totalPages;
    public $perPage;
    public $count;
    public $offset;

    public function __construct($count, $perPage = 10) {
        $this->count = $count;
        $this->perPage = $perPage;
        $this->setCurrentPage();
        $this->findTotalPages();
        $this->offset();
    }

    public function setCurrentPage(): Pagination {
        $request = Input::get('page');
        $this->currentPage = !$request ? 1 : $request;
        return $this;
    }

    public function findTotalPages() {
        return $this->totalPages = ceil($this->count / $this->perPage);
    }

    public function offset() {
        return $this->offset = ($this->currentPage - 1) * $this->perPage;
    }

    public function current() {
        return $this->currentPage;
    }

    public function total() {
        return $this->totalPages;
    }

    public function route($page): string {
        $queryString = '';
        if (Router::queryStringExists()) {
            parse_str(Router::getQueryString(), $queryArray);
            if (isset($queryArray['page'])) {
                unset($queryArray['page']);
            }
            if (!empty($queryArray)) {
                $queryString .= '&' . urldecode(http_build_query($queryArray));
            }
        }
        return Router::getRequestPath() . "?page={$page}" . $queryString;
    }
}