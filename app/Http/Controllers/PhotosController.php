<?php

namespace App\Http\Controllers;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotosController extends Controller
{
  public function env()
  {
    // return env('AWS_DEFAULT_REGION');
    return env('APP_SERVICE', 'http://127.0.0.1/sw1_p1/public/api/');
  }
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
      if (count($request['files']) < 2) {
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
      // if (count($vector) > 0) {
      //   DB::table('apareces')->insert([
      //     'paper_id' => $request['paper_id'],
      //     'paper_file_id' => $request['paper_file_id'],
      //     'url' => $request['url'],
      //     'urlP' => $request['urlP'],
      //   ]);
      // }
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
      // return response()->json([
      //   'message' => 'Error al subir el archivo',
      //   'data' => '2'
      // ]);
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
      return $vector;
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
