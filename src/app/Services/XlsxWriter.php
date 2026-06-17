<?php

namespace App\Services;

use ZipArchive;

class XlsxWriter
{
    protected array $rows = [];

    protected array $headers = [];

    protected string $title = '';

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function setHeaders(array $headers): static
    {
        $this->headers = $headers;

        return $this;
    }

    public function addRow(array $row): static
    {
        $this->rows[] = $row;

        return $this;
    }

    public function getContent(): string
    {
        $zip = new ZipArchive();
        $temp = tempnam(sys_get_temp_dir(), 'xlsx');

        if ($zip->open($temp, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('Could not create XLSX file');
        }

        $sharedStrings = $this->buildSharedStrings();

        $zip->addFromString('[Content_Types].xml', $this->buildContentTypes());
        $zip->addFromString('_rels/.rels', $this->buildRelationships());
        $zip->addFromString('xl/workbook.xml', $this->buildWorkbook());
        $zip->addFromString('xl/_rels/workbook.xml.rels', $this->buildWorkbookRelationships());
        $zip->addFromString('xl/worksheets/sheet1.xml', $this->buildSheet($sharedStrings));
        $zip->addFromString('xl/sharedStrings.xml', $this->buildSharedStringsXml($sharedStrings));
        $zip->addFromString('xl/styles.xml', $this->buildStyles());

        $zip->close();

        $content = file_get_contents($temp);
        unlink($temp);

        return $content;
    }

    protected function buildSharedStrings(): array
    {
        $strings = [];
        $strings[] = $this->title;

        foreach ($this->headers as $header) {
            if (!in_array($header, $strings)) {
                $strings[] = $header;
            }
        }

        foreach ($this->rows as $row) {
            foreach ($row as $value) {
                $str = (string) $value;
                if ($str !== '' && !in_array($str, $strings)) {
                    $strings[] = $str;
                }
            }
        }

        return $strings;
    }

    protected function buildContentTypes(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
  <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
  <Override PartName="/xl/sharedStrings.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml"/>
  <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>
</Types>';
    }

    protected function buildRelationships(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
</Relationships>';
    }

    protected function buildWorkbook(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <sheets>
    <sheet name="Reporte" sheetId="1" r:id="rId1"/>
  </sheets>
</workbook>';
    }

    protected function buildWorkbookRelationships(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
  <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings" Target="sharedStrings.xml"/>
  <Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
</Relationships>';
    }

    protected function buildSheet(array $sharedStrings): string
    {
        $colLetters = $this->getColumnLetters(max(count($this->headers), 1));

        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <sheetViews>
    <sheetView tabSelected="1" workbookViewId="0">
      <pane ySplit="2" topLeftCell="A3" activePane="bottomLeft" state="frozen"/>
    </sheetView>
  </sheetViews>
  <cols>
    <col min="1" max="' . count($colLetters) . '" width="30" customWidth="1"/>
  </cols>
  <sheetData>';

        $rowNum = 1;

        $xml .= '<row r="' . $rowNum . '" ht="20" customHeight="1">';
        $xml .= '<c r="A' . $rowNum . '" t="s" s="1"><v>' . $this->getStringIndex($sharedStrings, $this->title) . '</v></c>';
        $xml .= '</row>';

        $rowNum = 2;

        $xml .= '<row r="' . $rowNum . '">';
        foreach ($this->headers as $colIndex => $header) {
            $cellRef = $colLetters[$colIndex] . $rowNum;
            $xml .= '<c r="' . $cellRef . '" t="s" s="2"><v>' . $this->getStringIndex($sharedStrings, $header) . '</v></c>';
        }
        $xml .= '</row>';

        $rowNum = 3;

        foreach ($this->rows as $row) {
            $xml .= '<row r="' . $rowNum . '">';
            foreach ($row as $colIndex => $value) {
                $cellRef = $colLetters[$colIndex] . $rowNum;
                $strValue = (string) $value;
                if ($strValue === '') {
                    $xml .= '<c r="' . $cellRef . '" t="inlineStr" s="0"><is><t></t></is></c>';
                } else {
                    $xml .= '<c r="' . $cellRef . '" t="s" s="0"><v>' . $this->getStringIndex($sharedStrings, $strValue) . '</v></c>';
                }
            }
            $xml .= '</row>';
            $rowNum++;
        }

        $xml .= '</sheetData>
</worksheet>';

        return $xml;
    }

    protected function buildSharedStringsXml(array $strings): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<sst xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" count="' . count($strings) . '" uniqueCount="' . count($strings) . '">';

        foreach ($strings as $string) {
            $xml .= '<si><t>' . htmlspecialchars($string, ENT_XML1, 'UTF-8') . '</t></si>';
        }

        $xml .= '</sst>';

        return $xml;
    }

    protected function buildStyles(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <fonts count="3">
    <font><sz val="11"/><name val="Calibri"/></font>
    <font><b/><sz val="14"/><name val="Calibri"/><color rgb="FF1F3A5F"/></font>
    <font><b/><sz val="11"/><name val="Calibri"/><color rgb="FFFFFFFF"/></font>
  </fonts>
  <fills count="3">
    <fill><patternFill patternType="none"/></fill>
    <fill><patternFill patternType="gray125"/></fill>
    <fill><patternFill patternType="solid"><fgColor rgb="FF1F3A5F"/></patternFill></fill>
  </fills>
  <borders count="2">
    <border><left/><right/><top/><bottom/><diagonal/></border>
    <border>
      <left style="thin"><color auto="1"/></left>
      <right style="thin"><color auto="1"/></right>
      <top style="thin"><color auto="1"/></top>
      <bottom style="thin"><color auto="1"/></bottom>
      <diagonal/>
    </border>
  </borders>
  <cellStyleXfs count="1">
    <xf numFmtId="0" fontId="0" fillId="0" borderId="0"/>
  </cellStyleXfs>
  <cellXfs count="3">
    <xf numFmtId="0" fontId="0" fillId="0" borderId="0"/>
    <xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1"/>
    <xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1">
      <alignment horizontal="center" vertical="center" wrapText="1"/>
    </xf>
  </cellXfs>
</styleSheet>';
    }

    protected function getStringIndex(array $strings, string $value): int
    {
        $index = array_search($value, $strings, true);

        return $index !== false ? $index : 0;
    }

    protected function getColumnLetters(int $count): array
    {
        $letters = [];
        for ($i = 0; $i < $count; $i++) {
            $letters[] = $this->getColumnLetter($i);
        }

        return $letters;
    }

    protected function getColumnLetter(int $index): string
    {
        $letter = '';
        while ($index >= 0) {
            $letter = chr(65 + ($index % 26)) . $letter;
            $index = (int) ($index / 26) - 1;
        }

        return $letter;
    }
}
