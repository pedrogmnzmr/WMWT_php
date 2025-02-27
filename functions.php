<?php
declare(strict_types=1);

/**
 * Renderiza una plantilla con los datos pasados.
 */
function render_template(string $template, array $data = []): void {
    extract($data);
    require "templates/$template.php";
}

/**
 * Realiza un GET a la URL y decodifica el JSON.
 */
function get_data(string $url): array {
    $result = file_get_contents($url);
    $data = json_decode($result, true);
    return $data;
}


/**
 * Obtiene una película desde la OMDb API por su IMDb ID.
 */
function getMovieById(string $imdbId): ?Movie {
    $url = OMDB_BASE_URL . "?i=" . $imdbId . "&apikey=" . OMDB_API_KEY;
    $data = get_data($url);
    if (!isset($data['Response']) || $data['Response'] === "False") {
        return null;
    }
    return new Movie(
        $data['Title'] ?? '',
        $data['Poster'] ?? '',
        $data['Released'] ?? '',
        $data['Plot'] ?? '',
        $data['Year'] ?? '',
        $data['Genre'] ?? ''
    );
}

/**
 * Selecciona dos películas aleatorias a partir de un archivo CSV con IDs.
 * El archivo CSV debe tener la siguiente estructura:
 * Movie ID, Movie Name, Year
 */
function getRandomMovies(): array {
    $csvFile = 'movies.csv'; 
    $imdbIds = [];
    
    if (($handle = fopen($csvFile, 'r')) !== false) {
        fgetcsv($handle, 1000, ",", '"', "\\");
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $movieId = $data[0];
            $formattedId = sprintf("%07d", (int)$movieId);
            $imdbIds[] = "tt" . $formattedId;
        }
        fclose($handle);
    }
    
    // mezcla el array de IDs de forma aleatoria
    shuffle($imdbIds);
    // selecciona los dos primeros IDs
    $selected = array_slice($imdbIds, 0, 2);
    $movies = [];
    foreach ($selected as $id) {
        $movie = getMovieById($id);
        if ($movie !== null) {
            $movies[] = $movie;
        }
    }
    return $movies;
}
