<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../../admin_views/img/logoo.png', 10, 10, 30); // Reemplaza con la ruta real de tu logo
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(40);
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function CrearTablaEmp($header, $data)
    {
        // Colores de los encabezados
        $this->SetFillColor(48, 129, 204); // Azul
        $this->SetTextColor(255);
        $this->SetDrawColor(48, 129, 204);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Cabecera
        $w = array(30, 40, 30, 30, 30, 30); // Anchos de las columnas
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 6, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id_producto'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['producto'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, '$' . number_format($row['precio'], 0, ',', '.'), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row['stock'], 0, ',', '.'), 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, number_format($row['descuento'], 0, ',', '.') . '%', 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, $row['categoria'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
