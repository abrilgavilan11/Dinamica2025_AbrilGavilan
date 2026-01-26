<?php

namespace App\Models;

class Category extends BaseModel
{
    /**
     * Obtiene todas las categorías activas de la base de datos, ordenadas por nombre.
     *
     * @return array Un array de categorías.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM categoria ORDER BY catnombre";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Busca una única categoría activa por su ID.
     *
     * @param int $id El ID de la categoría a buscar.
     * @return array|null La categoría como un array, o null si no se encuentra.
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM categoria WHERE idcategoria = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
}
