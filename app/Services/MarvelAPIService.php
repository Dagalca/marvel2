<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Pagination\LengthAwarePaginator;

class MarvelAPIService
{
    private $client;
    private $publicKey;
    private $privateKey;

    // Constructor: inicializa el cliente HTTP y las claves de la API
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://gateway.marvel.com/v1/public/']);
        $this->publicKey = env('MARVEL_API_PUBLIC_KEY');
        $this->privateKey = env('MARVEL_API_PRIVATE_KEY');
    }

    // Construye la consulta con autenticación para la API de Marvel
    private function queryWithAuth($query = [])
    {
        $timestamp = now()->timestamp;
        $hash = md5($timestamp . $this->privateKey . $this->publicKey);
        return array_merge($query, [
            'apikey' => $this->publicKey,
            'ts' => $timestamp,
            'hash' => $hash,
        ]);
    }

    // Método genérico para obtener datos de la API
    public function fetchData($endpoint, $page = 1, $limit = 12, $additionalQuery = [])
    {
        $offset = ($page - 1) * $limit;
        $query = array_merge(['limit' => $limit, 'offset' => $offset], $additionalQuery);

        try {
            $response = $this->client->request('GET', $endpoint, ['query' => $this->queryWithAuth($query)]);
            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['data']['results'])) {
                throw new \Exception('Invalid API response');
            }

            return new LengthAwarePaginator($data['data']['results'], $data['data']['total'], $limit, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]);
        } catch (GuzzleException | \Exception $e) {
            return new LengthAwarePaginator([], 0, $limit, $page);
        }
    }

    // Método para obtener recursos (personajes, cómics, etc.) de la API
    public function get($type, $page = 1, $limit = 12, $additionalQuery = [])
    {
        return $this->fetchData($type, $page, $limit, $additionalQuery);
    }

    // Método para obtener un recurso específico por ID
    public function getById($type, $id)
    {
        try {
            $response = $this->client->request('GET', "{$type}/{$id}", ['query' => $this->queryWithAuth()]);
            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['data']['results'][0])) {
                return $data['data']['results'][0];
            } else {
                return [];
            }
        } catch (GuzzleException | \Exception $e) {
            return [];
        }
    }

    // Método para obtener recursos relacionados (personajes en cómics, etc.)
    public function getRelated($type, $id, $relatedType)
    {
        try {
            $response = $this->client->request('GET', "{$type}/{$id}/{$relatedType}", ['query' => $this->queryWithAuth()]);
            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['data']['results'])) {
                return $data['data']['results'];
            } else {
                return [];
            }
        } catch (GuzzleException | \Exception $e) {
            return [];
        }
    }

    // Método para buscar recursos (personajes, cómics, etc.) en la API
    public function search($type, $searchTerm, $page = 1, $limit = 12)
    {
        $searchFields = [
            'characters' => 'nameStartsWith',
            'comics' => 'titleStartsWith',
            'series' => 'titleStartsWith',
            'creators' => 'firstNameStartsWith',
            'stories' => 'titleStartsWith',
        ];

        $query = [
            $searchFields[$type] => $searchTerm,
            'apikey' => $this->publicKey,
            'ts' => now()->timestamp,
            'hash' => md5(now()->timestamp . $this->privateKey . $this->publicKey),
        ];

        return $this->fetchData($type, $page, $limit, $query);
    }

    // Métodos específicos para obtener elementos destacados (featured)
    public function getFeaturedCharacters($limit = 50)
    {
        // Primero, encuentra la serie "A+X" y obtén su ID
        $seriesId = $this->findSeriesIdByTitle('A+X');
        if (!$seriesId) {
            return [];
        }

        // Luego, utiliza el ID de la serie para obtener los personajes relacionados
        return $this->getCharactersBySeriesId($seriesId, $limit);
    }

    private function findSeriesIdByTitle($title)
    {
        try {
            $query = $this->queryWithAuth(['title' => $title, 'limit' => 1]);
            $response = $this->client->request('GET', 'series', ['query' => $query]);
            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['data']['results'][0]['id'])) {
                return $data['data']['results'][0]['id'];
            }

            return null;
        } catch (GuzzleException | \Exception $e) {
            return null;
        }
    }

    private function getCharactersBySeriesId($seriesId, $limit)
    {
        try {
            $query = $this->queryWithAuth(['series' => $seriesId, 'limit' => $limit]);
            $response = $this->client->request('GET', 'characters', ['query' => $query]);
            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['data']['results']) && count($data['data']['results']) > 0) {
                return $data['data']['results'];
            }

            return [];
        } catch (GuzzleException | \Exception $e) {
            return [];
        }
    }


    public function getFeaturedComics($limit = 20)
    {
        return $this->fetchFeaturedItems('comics', 'avengers', $limit);
    }

    public function getFeaturedSeries($limit = 50)
    {
        return $this->fetchFeaturedItems('series', 'Avengers', $limit);
    }

    private function fetchFeaturedItems($type, $title, $limit)
    {
        try {
            // Ajustar la consulta para obtener elementos destacados
            $query = $this->queryWithAuth(['title' => $title, 'limit' => $limit]);
            $response = $this->client->request('GET', "{$type}", ['query' => $query]);
            $data = json_decode($response->getBody()->getContents(), true);

            // Comprobar si hay resultados y devolverlos
            if (isset($data['data']['results']) && count($data['data']['results']) > 0) {
                return $data['data']['results'];
            } else {
                return [];
            }
        } catch (GuzzleException | \Exception $e) {
            // Considerar la posibilidad de registrar este error
            return [];
        }
    }

}
