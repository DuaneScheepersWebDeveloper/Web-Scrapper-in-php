<?php
// Specify the URL of the webpage containing the table
$url = 'https://www.worldometers.info/coronavirus/';

// Create a new DOMDocument object
$dom = new DOMDocument();

// Disable warnings caused by duplicate IDs
libxml_use_internal_errors(true);

// Load the HTML content from the URL
$dom->loadHTMLFile($url);

// Enable warnings again
libxml_use_internal_errors(false);

// Find the table element(s) in the DOM
$tables = $dom->getElementsByTagName('table');

// Initialize an empty array to store table data
$tableData = [];

// Loop through each table
foreach ($tables as $table) {
    // Initialize an empty array to store row data
    $rowData = [];

    // Get the rows of the table
    $rows = $table->getElementsByTagName('tr');

    // Loop through each row
    foreach ($rows as $row) {
        // Initialize an empty array to store cell data
        $cellData = [];

        // Get the cells of the row
        $cells = $row->getElementsByTagName('td');

        // Loop through each cell
        foreach ($cells as $cell) {
            // Get the cell content
            $cellData[] = trim($cell->textContent);
        }

        // Add the row data to the row array
        $rowData[] = $cellData;
    }

    // Add the row array to the table data array
    $tableData[] = $rowData;
}

// Convert the table data to JSON
$json = json_encode($tableData);

// Display the JSON
echo $json;