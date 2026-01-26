<?php

namespace App\Models;

class Order extends BaseModel
{
    /**
     * Crea una nueva orden/compra en la BD
     */
    public function create(int $userId, array $items): ?int
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO compra (idusuario, cofecha) VALUES (?, NOW())");
            $stmt->execute([$userId]);
            $orderId = $this->pdo->lastInsertId();
            
            // Crear los items de la compra
            foreach ($items as $item) {
                $stmt = $this->pdo->prepare("INSERT INTO compraitem (idcompra, idproducto, cicantidad, ciprecio) VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $orderId,
                    $item['idproducto'],
                    $item['cantidad'],
                    $item['precio']
                ]);
            }
            
            // Crear estado inicial: "iniciada"
            $stmt = $this->pdo->prepare("INSERT INTO compraestado (idcompra, idcompraestadotipo, cefechaini) VALUES (?, 1, NOW())");
            $stmt->execute([$orderId]);

            $this->pdo->commit();
            return $orderId;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log("Error al crear orden: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtiene una orden por su ID con todos sus detalles
     */
    public function findById(int $orderId): ?array
    {
        $sql = "SELECT c.*, u.usmail, u.usnombre, u.usmail 
                FROM compra c
                JOIN usuario u ON c.idusuario = u.idusuario
                WHERE c.idcompra = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Obtiene todas las órdenes de un usuario
     */
    public function findByUserId(int $userId): array
    {
        $sql = "SELECT c.*, 
                       (SELECT cetdescripcion FROM compraestadotipo cet 
                        JOIN compraestado ce ON ce.idcompraestadotipo = cet.idcompraestadotipo
                        WHERE ce.idcompra = c.idcompra 
                        ORDER BY ce.cefechaini DESC LIMIT 1) as estado_actual
                FROM compra c
                WHERE c.idusuario = ?
                ORDER BY c.cofecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene todas las órdenes (para admin)
     */
    public function getAll(): array
    {
        $sql = "SELECT c.*, u.usnombre, u.usmail,
                       (SELECT cetdescripcion FROM compraestadotipo cet 
                        JOIN compraestado ce ON ce.idcompraestadotipo = cet.idcompraestadotipo
                        WHERE ce.idcompra = c.idcompra 
                        ORDER BY ce.cefechaini DESC LIMIT 1) as estado_actual
                FROM compra c
                JOIN usuario u ON c.idusuario = u.idusuario
                ORDER BY c.cofecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene los items de una orden
     */
    public function getItems(int $orderId): array
    {
        $sql = "SELECT ci.*, p.pronombre, p.proimagen 
                FROM compraitem ci
                JOIN producto p ON ci.idproducto = p.idproducto
                WHERE ci.idcompra = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el estado actual de una orden
     */
    public function getCurrentStatus(int $orderId): ?array
    {
        $sql = "SELECT ce.*, cet.cetdescripcion, cet.cetdetalle
                FROM compraestado ce
                JOIN compraestadotipo cet ON ce.idcompraestadotipo = cet.idcompraestadotipo
                WHERE ce.idcompra = ?
                ORDER BY ce.cefechaini DESC
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Obtiene el historial de estados de una orden
     */
    public function getStatusHistory(int $orderId): array
    {
        $sql = "SELECT ce.*, cet.cetdescripcion, cet.cetdetalle
                FROM compraestado ce
                JOIN compraestadotipo cet ON ce.idcompraestadotipo = cet.idcompraestadotipo
                WHERE ce.idcompra = ?
                ORDER BY ce.cefechaini ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
