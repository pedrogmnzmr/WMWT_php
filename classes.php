<?php
class Movie {
    public $title;
    public $poster;
    public $released;
    public $plot;
    public $year;
    public $genre;

    public function __construct(string $title, string $poster, string $released, string $plot, string $year, string $genre) {
        $this->title = $title;
        $this->poster = $poster;
        $this->released = $released;
        $this->plot = $plot;
        $this->year = $year;
        $this->genre = $genre;
    }
}
