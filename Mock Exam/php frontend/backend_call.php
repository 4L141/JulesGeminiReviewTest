<?php
function callBackend($request)
{
    $inputFile  = __DIR__ . "/json/request.json";
    $outputFile = __DIR__ . "/json/response.json";

    file_put_contents($inputFile, json_encode($request, JSON_PRETTY_PRINT));

    // Added a leading backslash/forward slash to fix the path concatenation
    $exePath = __DIR__ . '/../console_backend/console_backend/bin/Debug/net8.0/console_backend.exe';

    $cmd = '"' . $exePath . '" ' . escapeshellarg($inputFile) . ' ' . escapeshellarg($outputFile);

    exec($cmd, $outputLines, $returnVar);

    $respJson = @file_get_contents($outputFile);
    if (!$respJson) {
        return ["Status" => "error", "Message" => "Response file not found"];
    }
    return json_decode($respJson, true);
}
?>