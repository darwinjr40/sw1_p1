<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
  public function subirFile(Request $request)
  {
    try {
      // return $request;
      if (!$request->hasFile('files')) {
        return response()->json([
          'message' => 'Error al subir el archivo, falta files',
          'data' => '2',
          400
        ]);
      }
      if ( count($request['files']) < 2) {
        return response()->json([
          'message' => 'Error! tiene que subir 2 archivos minimos',
          'data' => '3',
          400
        ]);
      }
      $client = new RekognitionClient([
        'region'    => env('AWS_DEFAULT_REGION'),
        'version'   => 'latest'
      ]);
      $bytes = array();
      $files = $request->file('files'); //retorna un object con los datos de los archivos
      foreach ($files as $f) {
        // $file = file_get_contents($f);
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
        'message' => 'Error al subir el archivo',
        'data' => '-1'
      ]);
    }
  }

  public function subirFile1(Request $request)
  {
    try {
      if (!$request->hasFile('files')) {
        return response()->json([
          'message' => 'Error al subir el archivo',
          'data' => '2'
        ]);
      }
      if (count($request->file('files')) < 2) {
        return response()->json([
          'message' => 'tiene que subir 2 archivos minimos',
          'data' => '3'
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
        'data' => '-1'
      ]);
    }
  }
}
