<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$host = 'localhost';
$dbname = 'cinema';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}

// Handle different HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Get all movies
        try {
            $stmt = $pdo->query('SELECT * FROM movies');
            $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($movies);
        } catch(PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'POST':
        // Add new movie
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            $stmt = $pdo->prepare('INSERT INTO movies (title, description, release_year, rating, poster_url) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['release_year'],
                $data['rating'],
                $data['poster_url']
            ]);
            echo json_encode(['message' => 'Movie added successfully', 'id' => $pdo->lastInsertId()]);
        } catch(PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'PUT':
        // Update movie
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            $stmt = $pdo->prepare('UPDATE movies SET title = ?, description = ?, release_year = ?, rating = ?, poster_url = ? WHERE id = ?');
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['release_year'],
                $data['rating'],
                $data['poster_url'],
                $data['id']
            ]);
            echo json_encode(['message' => 'Movie updated successfully']);
        } catch(PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        // Delete movie
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                $stmt = $pdo->prepare('DELETE FROM movies WHERE id = ?');
                $stmt->execute([$id]);
                echo json_encode(['message' => 'Movie deleted successfully']);
            } catch(PDOException $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Movie ID is required']);
        }
        break;

    default:
        echo json_encode(['error' => 'Method not allowed']);
        break;
} 