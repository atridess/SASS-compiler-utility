<?php

define("MSG_GREETING", "SASS compiler v1.0.0");
define("MSG_FALTUREEXIT", "Falture: Compiller stoped...()");
define("MSG_HELP","Short parameter manual:

compile.php input <filename> [ path <directory>(default ./) | output <filename>(default build.css) | format <formatname>(default nested) ]

  help, -h
    view help manual

  path, -p (./ by default)
    input path to SCSS folder (example 'path assets/stylesheets')

  input, -i
    input SCSS filemane (example 'input mixins.scss')

  output, -o (build.css by default)
    output file (example 'output custom-build.css')

  format, -f expanded | nested(by default) | compressed | compact | crunched
    formating output CSS (example 'format compressed')\n
    ");

echo MSG_GREETING."\n";

require_once 'vendor/autoload.php';
use Leafo\ScssPhp\Compiler;

$path = './';
$input_file = FALSE;
$output_file = 'build.css';
$output_format = FALSE;

for($i=1;$i<count($argv);$i++){
  switch ($argv[$i]) {
    case 'help':
    case '-h':
      echo MSG_HELP;
      exit;
      break;

    case 'path':
    case '-p':
      $path = $argv[$i+1];
      break;

      case 'input':
      case '-i':
        $input_file = $argv[$i+1];
        break;

        case 'output':
        case '-o':
          $output_file = $argv[$i+1];
          break;

          case 'format':
          case '-f':
            //$output_format = ;
            switch ($argv[$i+1]) {
              case 'expanded':
                $output_format = 'Leafo\ScssPhp\Formatter\Expanded';
                break;

              case 'compressed':
                $output_format = 'Leafo\ScssPhp\Formatter\Compressed';
                break;

              case 'compact':
                $output_format = 'Leafo\ScssPhp\Formatter\Compact';
                break;

              case 'crunched':
                $output_format = 'Leafo\ScssPhp\Formatter\Crunched';
                break;

              case 'nested':
                break;

              default:
                exit("unknown format\n".MSG_FALTUREEXIT."\n");
                break;
            }
            break;

    default:
      //do nothing
      break;
  }
}

//verify
if(!$input_file)
  exit("input file not set\n".MSG_FALTUREEXIT."\n");

//if(file_exists ( $path.$input_file ))
//  exit("fail: input file not found\n");

$scss = new Compiler();
$scss->setImportPaths($path);
if($output_format)
  $scss->setFormatter($output_format);

$fp = fopen($output_file , 'w');
$of_size = (int)fwrite($fp, $scss->compile('@import "'.$input_file.'";'));
fclose($fp);

echo "build to file: $output_file (".($of_size/1000)." Kb)\n";
