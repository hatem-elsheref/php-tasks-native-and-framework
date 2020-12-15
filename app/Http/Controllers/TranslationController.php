<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use  App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;

class TranslationController extends Controller
{


    private $unWritableFiles = [];
    private $locales = [];
    private $data = [];

    public function __construct(){
        $this->middleware(['auth:web','AdminOnly']);
        $this->unWritableFiles = ['auth', 'pagination', 'passwords', 'validation'];
        $this->locales = \LaravelLocalization::getSupportedLocales();
    }

    public function index(){
        $translation = [];
        foreach ($this->locales as $localeCode => $properties) {
            $allFiles = File::allFiles(resource_path('lang' . DIRECTORY_SEPARATOR . $localeCode));
            array_map(function ($file) use (&$translation, $localeCode) {
                if (!in_array($file->getFilenameWithoutExtension(), $this->unWritableFiles))
                    $translation[$localeCode][] = array('name' => $file->getFilenameWithoutExtension(), 'path' => $file->getPathname());
            }, $allFiles);
            foreach ($translation[$localeCode] as $file)
                $this->data[$localeCode][$file['name']] = File::getRequire($file['path']);
        }
        return view('setting.translation.index')->with('locales', $this->locales)->with('data', $this->data);
    }

    public function save(TranslationRequest $request){

        $files = $request->except(['newKey', 'newValue', 'translationFile', '_token']);

        // if you removed all keys in some file in some locale


        foreach ($files as $fileName => $fileLocales){
            foreach ($this->locales as $localeCode => $properties ){
                if (!in_array($localeCode,array_keys($fileLocales))){
                    $files[$fileName][$localeCode]=array();
                }
            }
        }

        if ($request->has('newKey') and !empty($request->newKey) and strlen($request->newKey) > 0) {
            foreach($this->locales as $localeCode => $properties){
              $files[$request->translationFile][$localeCode][$request->newKey] =$request->newValue[$localeCode];
            }
        }



        $this->writeTheNewData($files);
        self::Success();
        return redirect()->back();

    }

    private function writeTheNewData($newData){
        foreach ($newData as $fileName => $fileLocales){// loop to the allowed files
            foreach ($fileLocales as $fileLocale => $fileContent){
                $mainString='<?php return [ ';
                foreach ($fileContent as $key => $value){
                    $mainString.="'$key' => '$value',";
                }
                $mainString=trim($mainString,',').'];';
                File::put(resource_path('lang'.DIRECTORY_SEPARATOR.$fileLocale.DIRECTORY_SEPARATOR.$fileName.'.php'),$mainString);
            }
        }
    }

}

