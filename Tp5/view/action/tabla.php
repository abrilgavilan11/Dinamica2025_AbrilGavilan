<?php
// Include correct global configuration
include_once('../configuracion.php');

$obj = new VerUsuarios;
$arrayUsuarios = $obj->listarUsuarios();

if (empty($arrayUsuarios)) {

    echo '<h1 class="text-light h-100">No se encuentran personas cargadas</h1>';
} else {
?>


    <table class="table table-dark table-striped table-hover ">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Dni Mail</th>
                <th scope="col">Habilitacion</th>
                <th scope="col">Rol</th>
                <th scope="col" class="text-end">
                    <form action="../crearUsuario.php" method="get" class="d-inline">
                        <button class="btn btn-success btn-sm" title="Nuevo Usuario" type="submit"><i class="bi bi-person-plus"></i></button>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrayUsuarios as $auto) { ?>
                <tr>
                    <th scope="row"><?php echo $auto->getIdusuario(); ?></th>
                    <td><?php echo $auto->getUsnombre(); ?></td>
                    <td><?php echo $auto->getUspass(); ?></td>
                    <td><?php echo $auto->getUsmail(); ?></td>
                    <td><?php echo $auto->getUsdeshabilitado() === 'Habilitado' ? 'Habilitado' : 'Deshabilitado'; ?></td>
                    <td><?php $rol = $obj->verRolesUsuario($auto->getIdusuario()); echo $rol->getRoldescripcion()  ?></td>
                    <td class="d-flex h-100 gap-4">
                        <form action="modificar.php" method="post" class="d-inline" title="Editar">
                            <input type="hidden" name="idusuario" value="<?php echo $auto->getIdusuario(); ?>">
                            <input type="hidden" name="idrol" value="<?php echo $rol->getIdrol(); ?>">
                            <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </form>
                        <?php $habilitado = ($auto->getUsdeshabilitado() === 'Habilitado'); ?>
                        <form action="action/<?php echo $habilitado ? 'eliminarLogin.php' : 'habilitarUsuario.php'; ?>" method="post" class="d-inline" title="<?php echo $habilitado ? 'Deshabilitar' : 'Rehabilitar'; ?>">
                            <input type="hidden" name="idusuario" value="<?php echo $auto->getIdusuario(); ?>">
                            <button type="submit" class="btn btn-link p-0 text-decoration-none" onclick="return confirm('<?php echo $habilitado ? '¿Deshabilitar este usuario?' : '¿Rehabilitar este usuario?'; ?>')">
                                <?php if ($habilitado) { ?>
                                    <i class="bi bi-slash-circle text-warning"></i>
                                <?php } else { ?>
                                    <i class="bi bi-check-circle text-success"></i>
                                <?php } ?>
                            </button>
                        </form>
                        <form action="action/eliminarUsuario.php" method="post" class="d-inline" title="Eliminar definitivamente">
                            <input type="hidden" name="idusuario" value="<?php echo $auto->getIdusuario(); ?>">
                            <button type="submit" class="btn btn-link p-0 text-decoration-none" onclick="return confirm('¿Eliminar DEFINITIVAMENTE este usuario<?php echo $habilitado ? '' : ' deshabilitado'; ?>? Esta acción no se puede deshacer.')">
                                <i class="bi bi-trash3 text-danger"></i>
                            </button>
                        </form>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
} ?>