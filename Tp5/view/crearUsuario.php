<?php
include_once '../configuracion.php';
include_once '../controller/session.php';
include_once '../model/rol.php';

$session = new Session();
if (!$session->validar()) {
    header('Location: login.php');
    exit();
}
$roles = Rol::listar();
include_once 'estructura/header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Usuario</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="text-center mb-4">➕ Nuevo Usuario</h3>
        <form action="action/crearUsuario.php" method="post" class="needs-validation" novalidate>
          <div class="mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="usnombre" class="form-control" required />
            <div class="invalid-feedback">Ingrese un nombre.</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="usmail" class="form-control" required />
            <div class="invalid-feedback">Ingrese un email válido.</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="uspass" minlength="6" class="form-control" required />
            <div class="invalid-feedback">Mínimo 6 caracteres.</div>
          </div>
          <div class="mb-4">
            <label class="form-label">Rol</label>
            <select name="idrol" class="form-select" required>
              <option value="" selected disabled>Seleccione rol...</option>
              <?php foreach($roles as $rol): ?>
                <option value="<?php echo $rol->getIdrol(); ?>"><?php echo htmlspecialchars($rol->getRoldescripcion()); ?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Seleccione un rol.</div>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Crear</button>
            <a href="listarUsuario.php" class="btn btn-outline-light">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
(()=>{const forms=document.querySelectorAll('.needs-validation');Array.from(forms).forEach(f=>{f.addEventListener('submit',e=>{if(!f.checkValidity()){e.preventDefault();e.stopPropagation();}f.classList.add('was-validated');});});})();
</script>
<script src="assets/js/validaciones.js"></script>
</body>
</html>
<?php include_once 'estructura/footer.php'; ?>