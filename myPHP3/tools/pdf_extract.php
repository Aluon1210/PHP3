<?php

require __DIR__ . '/../vendor/smalot/pdfparser/alt_autoload.php-dist';

$input = $argv[1] ?? null;
$output = $argv[2] ?? null;

if (!$input || !$output) {
    fwrite(STDERR, "Usage: php tools/pdf_extract.php <input.pdf> <output.txt>\n");
    exit(1);
}

$parser = new \Smalot\PdfParser\Parser();
$pdf = $parser->parseFile($input);
$text = $pdf->getText();

file_put_contents($output, $text);