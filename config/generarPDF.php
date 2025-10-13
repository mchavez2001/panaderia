<?php
require '../public/lib/fpdf/fpdf.php';
require_once '../app/controllers/insumosController.php';

$insumosController = new InsumoController();
$insumos = $insumosController->obtenerInsumosListaDelDia();

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        #$this->Image('../public/img/logo.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80);
        $this->Cell(30, 10, 'Lista de Insumos para Enviar', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Tabla simple
    function BasicTable($header, $data)
    {
        foreach ($header as $col) {
            $this->Cell(38, 7, $col, 1);
        }
        $this->Ln();
        foreach ($data as $row) {
            $this->Cell(38, 6, $row['id'], 1);
            $this->Cell(38, 6, $row['insumo'], 1);
            $this->Cell(38, 6, $row['descripcion'], 1);
            $this->Cell(38, 6, $row['stock'], 1);
            $this->Cell(38, 6, $row['medida'], 1);
            $this->Ln();
        }
    }
}

// Datos de ejemplo
$data = [];
foreach ($insumos as $insumo) {
    $data[] = [
        'id' => $insumo->getCod_ins(),
        'insumo' => $insumo->getNom_ins(),
        'descripcion' => $insumo->getDscr(),
        'stock' => $insumo->getStock(),
        'medida' => $insumo->getUni_med()
    ];
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('ID', 'INSUMO', 'DESCRIPCION', 'CANTIDAD', 'MEDIDA');
$pdf->BasicTable($header, $data);
$pdf->Output('F', '../public/pedidosPDF/pedido.pdf');
#$pdf->Output('D', 'insumos.pdf');

header('Location: /panaderia/public/insumos');
exit();