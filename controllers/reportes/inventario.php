<?php
require_once __DIR__ . "/../lib/pdf.php";
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $producto = new Producto();
    $resultado = $producto->traer_productos();
    $productos = [];

    if ($resultado["productos"]) {
        while ($fila = $resultado["productos"]->fetch_assoc()) {
            foreach ($fila as $key => $value) {
                $fila[$key] = htmlspecialchars($value);
            }

            unset($fila["estado"]);
            unset($fila["descripcion"]);

            $productos[] = $fila;
        }


        # Crear instacia
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        # Titulo
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Reporte de inventario', 0, 1, 'C');
        $pdf->Ln(5);

        # Fecha de creacion
        $fecha_creacion = date('Y-m-d H:i:s');
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Fecha de Creacion: ' . $fecha_creacion, 0, 1, 'R');
        $pdf->Ln(10);

        # Encabezados
        $header = ['Id', 'Nombre', 'Precio', 'Stock', 'Descuento', 'Categoria'];


        $pdf->CrearTablaEmp($header, $productos);
        $pdf->Output("reporte_inventario.pdf", "I");
    }
}
