<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
  public function subirFile(Request $request)
  {
    try {
      if (!$request->hasFile('files') || count($request->file('files')) < 2) {
        return response()->json([
          'message' => 'Error al subir el aaarchivo',
          'data' => '2'
        ]);
      }

      $client = new RekognitionClient([
        'region'    => env('AWS_DEFAULT_REGION'),
        'version'   => 'latest'
      ]);
      $bytes = array();
      $files = $request->file('files'); //retorna un object con los datos de los archivos
      foreach ($files as $f) {
        $i = fopen($f->getPathName(), 'r');
        $b = fread($i, $f->getSize());
        array_push($bytes, $b);
      }
      $results = $client->compareFaces([
        'SimilarityThreshold' => 75,
        'SourceImage' => [ //origen (foto individual)
          'Bytes' => $bytes[0]
        ],
        'TargetImage' => [ //destion (foto grande)
          'Bytes' => $bytes[1]
        ],
      ]);
      $vector = $results->get('FaceMatches');
      return count($vector) > 0 ?
        response()->json(['data' => '1']) :
        response()->json(['data' => '0']);
    } catch (\Throwable $th) {
      return response()->json([
        'message' => 'Error al subir el aaarchivo',
        'data' => '3'
      ]);
    }
  }
}
