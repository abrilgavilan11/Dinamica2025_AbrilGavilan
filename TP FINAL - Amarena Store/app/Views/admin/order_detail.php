<?php
?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1>Orden #<?php echo htmlspecialchars($order['idcompra']); ?></h1>
            
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5>Detalles del Cliente</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($order['usnombre']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['usmail']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha de Orden:</strong> <?php echo date('d/m/Y H:i', strtotime($order['cofecha'])); ?></p>
                            <p><strong>ID Orden:</strong> <?php echo htmlspecialchars($order['idcompra']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5>Productos</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($items)): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    foreach ($items as $item): 
                                        $subtotal = $item['cicantidad'] * $item['ciprecio'];
                                        $total += $subtotal;
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item['pronombre']); ?></td>
                                            <td><?php echo htmlspecialchars($item['cicantidad']); ?></td>
                                            <td>$<?php echo number_format($item['ciprecio'], 2); ?></td>
                                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-active fw-bold">
                                        <th colspan="3" class="text-end">TOTAL:</th>
                                        <th>$<?php echo number_format($total, 2); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-warning text-dark">
                    <h5>Historial Completo de Estados</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($statusHistory)): ?>
                        <div class="timeline">
                            <?php foreach ($statusHistory as $status): ?>
                                <div class="timeline-item mb-4 pb-4" style="border-bottom: 1px solid #ddd;">
                                    <div class="d-flex">
                                        <div class="timeline-marker bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px; font-size: 20px;">
                                            ✓
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1 text-uppercase fw-bold">
                                                <?php echo htmlspecialchars($status['cetdescripcion']); ?>
                                            </h6>
                                            <p class="text-muted mb-2">
                                                <?php echo htmlspecialchars($status['cetdetalle']); ?>
                                            </p>
                                            <small class="text-secondary">
                                                Desde: <?php echo date('d/m/Y H:i', strtotime($status['cefechaini'])); ?>
                                                <?php if ($status['cefechafin']): ?>
                                                    - Hasta: <?php echo date('d/m/Y H:i', strtotime($status['cefechafin'])); ?>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-info text-white">
                    <h5>Cambiar Estado</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-2"><strong>Estado Actual:</strong></p>
                        <h5 class="badge bg-primary w-100 py-2" style="font-size: 16px;">
                            <?php echo htmlspecialchars($currentStatus['cetdescripcion'] ?? 'Desconocido'); ?>
                        </h5>
                    </div>

                    <?php if (!empty($validTransitions)): ?>
                        <div class="mb-3">
                            <label class="form-label"><strong>Nuevo Estado:</strong></label>
                            <select class="form-select" id="newStatusSelect">
                                <option value="">-- Selecciona un nuevo estado --</option>
                                <?php foreach ($allStatusTypes as $statusType): ?>
                                    <?php if (in_array($statusType['idcompraestadotipo'], $validTransitions)): ?>
                                        <option value="<?php echo $statusType['idcompraestadotipo']; ?>">
                                            <?php echo htmlspecialchars($statusType['cetdescripcion']); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button class="btn btn-warning w-100" id="changeStatusBtn" data-order-id="<?php echo $order['idcompra']; ?>">
                            Cambiar Estado
                        </button>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <small>No hay transiciones válidas para este estado.</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 0;
    }

    .timeline-marker {
        min-width: 45px;
        flex-shrink: 0;
    }

    .sticky-top {
        z-index: 100;
    }
</style>

<script>
document.getElementById('changeStatusBtn')?.addEventListener('click', function() {
    const orderId = this.getAttribute('data-order-id');
    const newStatusId = document.getElementById('newStatusSelect').value;

    if (!newStatusId) {
        alert('Por favor selecciona un nuevo estado');
        return;
    }

    fetch('/admin/orden/cambiar-estado', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'order_id=' + orderId + '&status_id=' + newStatusId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al cambiar el estado');
    });
});
</script>
