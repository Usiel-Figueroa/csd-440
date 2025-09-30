<?php
// Usiel Figueroa
// September 29, 2025
// CSD 440-A311 Server-Side Scripting
// Module 11 Programming Assignment
//
// Purpose: Generate a PDF report of the software_practices table
// from the baseball_01 database with formatted table, custom header/footer,
// automatic text wrapping, alternating row colors, and clickable project links.

require('fpdf.php');
require_once "db_config.php"; // Database connection

// Extend FPDF for custom header/footer
class PDF extends FPDF {

    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Software Development Practices Report', 0, 1, 'C');
        $this->Ln(5);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table with wrapping support, clickable links, and alternating row colors
    function FancyTable($headers, $rows, $widths) {
        // --- Header styling ---
        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(51, 53, 55); // Dark gray header
        $this->SetTextColor(255, 255, 255); // White text
        foreach ($headers as $i => $col) {
            $this->Cell($widths[$i], 10, $col, 1, 0, 'C', true);
        }
        $this->Ln();

        // --- Data rows ---
        $this->SetFont('Arial', '', 10);
        $fill = false; // alternating row colors
        foreach ($rows as $row) {
            $yStart = $this->GetY();
            $rowHeight = 0;

            // Compute max height for row
            foreach ($row as $i => $cell) {
                $nb = $this->NbLines($widths[$i], $cell);
                $rowHeight = max($rowHeight, $nb * 8);
            }

            foreach ($row as $i => $cell) {
                $x = $this->GetX();
                $y = $this->GetY();

                // Alternate row background
                if ($fill) {
                    $this->SetFillColor(202, 200, 200); // Light gray
                } else {
                    $this->SetFillColor(255, 255, 255); // White
                }

                // Reset text color for normal cells
                $this->SetTextColor(0, 0, 0);
                $this->SetFont('Arial', '', 10);

                // Completed Project clickable link (index 5)
                if ($i == 5 && !empty($cell)) {
                    $this->SetTextColor(0, 0, 255);
                    $this->SetFont('Arial', 'U', 10);
                    $this->MultiCell($widths[$i], 8, "Project Link", 1, 'L', true);
                    $this->Link($x + 2, $y, $widths[$i], $rowHeight, $cell);
                    $this->SetFont('Arial', '', 10);
                    $this->SetTextColor(0, 0, 0);
                } else {
                    $this->MultiCell($widths[$i], 8, $cell, 1, 'L', true);
                }

                $this->SetXY($x + $widths[$i], $y);
            }

            $this->Ln($rowHeight);
            $fill = !$fill; // toggle row color
        }
    }

    // --- Helpers to expose margins ---
    public function getLeftMargin() {
        return $this->lMargin;
    }
    public function getRightMargin() {
        return $this->rMargin;
    }

    // --- Helper to calculate number of lines for wrapping ---
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2*$this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb > 0 && $s[$nb-1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0; $j = 0; $l = 0; $nl = 1;
        while($i < $nb) {
            $c = $s[$i];
            if($c == "\n") {
                $i++; $sep = -1; $j = $i; $l = 0; $nl++; continue;
            }
            if($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax) {
                if($sep == -1) {
                    if($i == $j) $i++;
                } else $i = $sep+1;
                $sep = -1; $j = $i; $l = 0; $nl++;
            } else $i++;
        }
        return $nl;
    }
}

// --- Query database ---
$query = "
    SELECT id, language_name, category, used_for, skill_level, completed_project, favorite_order
    FROM software_practices
    ORDER BY favorite_order
";
$result = $conn->query($query);

$headers = ["ID", "Language", "Category", "Used For", "Skill Level", "Completed Project", "Favorite Order"];
$rows = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            $row['id'],
            $row['language_name'],
            $row['category'],
            $row['used_for'],
            $row['skill_level'],
            $row['completed_project'],
            $row['favorite_order']
        ];
    }
}

// --- Create PDF ---
$pdf = new PDF();
$pdf->AddPage();

// General intro text
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10,
    "The PDF report presents the contents of the software_practices table "
    . "from the baseball_01 database. It highlights programming languages, "
    . "categories, uses, skill levels, and provides clickable project links. - Usiel Figueroa\n\n"
);

// Page usable width
$pageWidth   = $pdf->GetPageWidth();
$marginLeft  = $pdf->getLeftMargin();
$marginRight = $pdf->getRightMargin();
$usableWidth = $pageWidth - $marginLeft - $marginRight;

// Column proportions (must sum to 1.0)
$colProportions = [0.06, 0.12, 0.14, 0.18, 0.12, 0.20, 0.18];

// Calculate dynamic widths
$widths = [];
foreach ($colProportions as $p) {
    $widths[] = $usableWidth * $p;
}

// Build table
$pdf->FancyTable($headers, $rows, $widths);

// Output to browser inline
$pdf->Output("I", "Usiel_Report.pdf");

// Close connection
$conn->close();
?>
