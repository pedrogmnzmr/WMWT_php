<?php
require_once 'consts.php';
require_once 'classes.php';
require_once 'functions.php';


$movies = getRandomMovies();
?>
<!DOCTYPE html>
<html lang="es">
<?php include 'head.php'; ?>
<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Elige tu Película</h1>
    <!-- generar nuevas opciones  -->
    <div class="d-flex justify-content-center mt-2 mb-4">
      <form method="GET" class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary">Generar nuevas opciones</button>
      </form>
    </div>
    <!-- Grid de tarjetas -->
    <div class="row justify-content-center">
      <?php if (!empty($movies)): ?>
        <?php foreach ($movies as $movie): ?>
          <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
              <img 
                src="<?= $movie->poster ?>" 
                class="card-img-top" 
                alt="Poster de <?= $movie->title ?>" 
                style="max-height:450px; object-fit:cover;">
              <div class="card-body">
                <h5 class="card-title"><?= $movie->title ?> (<?= $movie->year ?>)</h5>
                <p class="card-text"><strong>Género:</strong> <?= $movie->genre ?></p>
                <p class="card-text"><?= $movie->plot ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <p class="text-center">No hay películas disponibles.</p>
        </div>
      <?php endif; ?>
    </div>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
