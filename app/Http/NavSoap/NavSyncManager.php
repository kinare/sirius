<?php
namespace App\Http\NavSoap;

use App\Charge;
use App\CheckList;
use App\ExamCenter;
use App\Intake;
use App\Programme;
use App\ProgrammeUnit;
use App\Semester;
use App\Student;

use App\StudentCheckList;
use App\StudentProgramme;
use App\StudentType;
use App\StudentUnit;
use Carbon\Carbon;
use http\Url;
use App\Http\NavSoap\NTLMSoapClient;

class NavSyncManager{
    private $config;

    private $syncClasses;

    public static $NAV_HTTP_ERROR_CODE = 11002;

    public function __construct()
    {
        $this->config = include ('NavSyncConfig.php');
        $this->syncClasses = [
            Student::class => ["endpoint" => $this->config->NAV_SOAP_STUDENT, "search_fields" => ['No'] ],
            Charge::class => ["endpoint" => $this->config->NAV_SOAP_CHARGE, "search_fields" => ['Code'], "update" => false ],
            StudentType::class => ["endpoint" => $this->config->NAV_SOAP_STUDENT_TYPE, "search_fields" => ['Code'], "update" => false ],
            ExamCenter::class => ["endpoint" => $this->config->NAV_SOAP_EXAM_CENTER, "search_fields" => ['Code'], "update" => false ],
            Intake::class => ["endpoint" => $this->config->NAV_SOAP_INTAKE_LIST, "search_fields" => ['Code'], "update" => false ],
            Semester::class => ["endpoint" => $this->config->NAV_SOAP_SEMESTER_LIST, "search_fields" => ['Code'], "update" => false ],
            Programme::class => ["endpoint" => $this->config->NAV_SOAP_PROGRAMME_LIST, "search_fields" => ['Code'], "update" => false ],
            ProgrammeUnit::class => ["endpoint" => $this->config->NAV_SOAP_PROGAM_UNIT, "search_fields" => ['Code'], "update" => false ],
            CheckList::class => ["endpoint" => $this->config->NAV_SOAP_CHECK_LIST, "search_fields" => ['Code'], "update" => false ],
            // StudentCheckList::class => ["endpoint" => $this->config->NAV_SOAP_STUDENT_CHECK_LIST, "search_fields" => [], "update" => false ],
            StudentUnit::class => ["endpoint" => $this->config->NAV_SOAP_STUDENT_UNIT, "search_fields" => ['Code'], "update" => false ],
            StudentProgramme::class => ["endpoint" => $this->config->NAV_SOAP_STUDENTS_PROGRAM_REGISTRATION, "search_fields" => ['Registration_ID'], "update" => false ],
        ];
    }

    // Sync all
    public function sync(){
        print ("\n");
        print ("--------------- NAV SYNCING STARTED -----------------\n");
        print ("\n");
        print ("--------------- PULLING NAV DATA STARTED -----------------\n");
        foreach ($this->syncClasses as $model => $props){
            $this->getTable($model, $props["endpoint"], $props["search_fields"]);
        }
        print ("--------------- PULLING NAV DATA FINISHED -----------------\n");
        print ("\n");

        print ("\n");
        print ("--------------- CREATING NAV DATA STARTED -----------------\n");
        foreach ($this->syncClasses as $model => $props){
            $this->pushTable($model, $props["endpoint"]);
        }
        print ("--------------- CREATING NAV DATA FINISHED -----------------\n");
        print ("\n");

        print ("\n");
        print ("--------------- UPDATING NAV DATA STARTED -----------------\n");
        foreach ($this->syncClasses as $model => $props){
            $this->updateTable($model, $props["endpoint"], $props["search_fields"]);
        }
        print ("--------------- UPDATING NAV DATA FINISHED -----------------\n");
        print ("\n");

        print ("--------------- NAV SYNCING ENDED -----------------");
        print ("\n\n");
    }

    // Push records to nav
    public function pushTable($model, $endpoint){
        try {
            if( isset($this->syncClasses[$model]["update"]) && !$this->syncClasses[$model]["update"]) return;
            $records = $model::where(['Synched' => 1, 'Last_TimeStamp' => null])->get();

            foreach ($records as $record) {
                try {
                    $result = (array)$this->create($endpoint, (object)$record->toArray());

                    $record->fill((array)reset($result));
                    $record->Synched = false;
                    $record->Last_TimeStamp = Carbon::now();
                    $record->save();
                    print ("Successfully created ".$model." in NAV\n");
                } catch (\Exception $e) {
                    print ($e->getMessage() . "\n\n");
                }

            }
        }
        catch (\Exception $e){
            print $e->getMessage();
        }
    }

    public function updateTable($model, $endpoint, $filters)
    {

        print ("\n");
        print ("--------------- STARTED UPDATING $endpoint -----------------\n");

        try {
            if( isset($this->syncClasses[$model]["update"]) && !$this->syncClasses[$model]["update"]) return;
            $records = $model::where('Synched', 1)->whereNotNull('Last_TimeStamp')->get();
            foreach ($records as $record) {
                try {

                    $filter_array = [];

                    foreach ($filters as $filter) {
                        $filter_array[$filter] = $record[$filter];
                    }
                    $this->update($endpoint, $record->toArray(), $filter_array);

                    $record->Synched = false;
                    $record->Last_TimeStamp = date("Y-m-d");
                    print ("Successfully updated ".$model." in NAV\n");
                    $record->save();
                } catch (\Exception $e) {
                    print ($e->getMessage() . "\n\n");
                }
            }
        }
        catch (\Exception $e){print $e->getMessage();}

        print ("--------------- FININSHED UPDATING $endpoint -----------------\n");
        print ("\n");
    }

    public function getTable($model, $endpoint, $search_fields){

        try {

            print ("\n\n");
            print ("--------------- SNYNCING $endpoint ---------------\n");
			app($model)->getTable();


            if ($model::count() < 1) {
                $records = get_object_vars($this->get($endpoint));

            } else {
                try{
					if(\Schema::hasColumn(app($model)->getTable(), 'Synched')){
						 $records = get_object_vars($this->get($endpoint, null, ['Synched' => false]));
					}
					else{
						$records = get_object_vars($this->get($endpoint, null, []));
					}

                }catch (\Exception $e){
					print($e->getMessage()."\n");
					$records = [[]];
                }
            }



            $records = reset($records);

            if (!$records) return;
			print(count($records)."\n");
            $records = is_array($records) ? $records : [$records];
            foreach ($records as $record) {

                try {
                    $instance = new $model();
                    $data = (array)$record;
                    try {
                        unset($data["Key"]);
                    } catch (\Exception $e) {
						print($e->getMessage()."\n");
                    };
                    $instance->fill($data);

                    try{
                        $instance->save();
                    }catch (\Exception $e){
						print($e->getMessage()."\n");
                        if($e->getCode() == "23000"){
                            $filter_array = [];
                            $filters = $this->syncClasses[$model]['search_fields'];
                            foreach ($filters as $filter) {
                                $filter_array[$filter] = $data[$filter];
                            }
                            $instance = $model::where($filter_array)->a();
                            $instance->fill($data);
                            $instance->save();
                        }
                    }

                    if( isset($this->syncClasses[$model]["update"]) && !$this->syncClasses[$model]["update"]) continue;
                    $instance->Synched = false;
                    $instance->Synched = false;
                    $instance->Last_TimeStamp = Carbon::now();
                    $instance->save();


                    // Set NAV Synced to True NAV
                    $filters = array_flip($search_fields);
                    array_walk($filters, function (&$var, $key) use ($instance) {
                        $var = $instance[$key];
                    });

                    if( isset($this->syncClasses[$model]["update"]) && !$this->syncClasses[$model]["update"]) continue;
//                    $this->update($endpoint, $instance->toArray(), $filters);
					print("Saved record\n");

                } catch (\Exception $e) {
                    print ($e->getMessage() . "\n");
                }
            }
        }catch (\Exception $e){
            print ($e);
        }

        print ("\n\n");
        print ("--------------- END SNYNCING $endpoint ---------------\n");
    }

    public function get($endpoint,array $params= null, array $filters = null, $callback = null){
        $url = $this->config->NAV_BASE_URL."/$endpoint";
        $this->prepareWrapper();
        $client = new NTLMSoapClient($url, ['trace' => 1]);

        if($params){
            return $client->Read($params)->Item;
        }

        $criteria = array();
        if($filters){
            foreach ($filters as $key => $value){
                array_push($criteria, ["Field" => $key, "Criteria" => $value]);
            }
        }

        $res =  $client->ReadMultiple(['filter' => $criteria, 'setSize'=> 0])->ReadMultiple_Result;
        $this->restoreWrapper();
        return $res;
    }

    public function create($endpoint, $data){
        $url = $this->config->NAV_BASE_URL."/$endpoint";

        $this->prepareWrapper();
        $client = new NTLMSoapClient($url, ['trace' => 1]);
        $resource_name = explode("/", $endpoint);
        $resource_name = end($resource_name);
        $data = (array) $data;
        unset($data["Last_TimeStamp"]);
        $update = [$resource_name => (object)$data];

        $result =  $client->Create((object)$update);
        $this->restoreWrapper();
        return $result;
    }

    /**
     * The endpoint of the NAV resource
     * @param $endpoint
     * Should be of type stdClass  with property names as fields
     * @param $data
     * any filters for the record you are updating
     * @param $filters
     * @return mixed
     */
    public function update($endpoint, $data, $filters){
        $url = $this->config->NAV_BASE_URL."/$endpoint";
        $record = (array)$this->get($endpoint, null, $filters);
        $record = (array)reset( $record);
        array_walk($data, function (&$var, $key) use($data, &$record){
            try{
                $record[$key] = $var;
            } catch (\Exception $e){
                print ($e->getMessage());
            }
        });
        $this->prepareWrapper();
        $client = new NTLMSoapClient($url, ['trace' => 1]);
        $resource_name = explode("/", $endpoint);
        $resource_name = end($resource_name);
        $update = [$resource_name => (object)$record];

        $res =  $client->Update((object)$update);
        $this->restoreWrapper();
        return $res;

    }

    public  function delete($enponint, $key){

    }

    public function getBlob($service , $payload){

            $url = $this->config->NAV_BASE_URL."/".$this->config->NAV_SOAP_BLOB;
            $this->prepareWrapper();
            $client = new NTLMSoapClient($url, ['trace' => 1]);
            $params =[
                'returnString' => '',
                'payload' => $payload,
                'service' => $service,
            ];

            $res =  $client->ProcessBlobs($params)->returnString;
            $this->restoreWrapper();
            return $res;

    }

    public function getTimetable($student_no){
        // dd($student_no);
        return $this->getBlob('STUDENTTIMETABLE', $student_no);
    }

    public function getExamResults($student_no){
        return $this->getBlob('STUDENTEXAMRESULTS', $student_no);
    }

    public function prepareWrapper(){
        stream_wrapper_unregister('http');
        stream_wrapper_register('http', NTLMStream::class) or die("Failed to register protocol");
    }

    public function restoreWrapper(){
        stream_wrapper_restore('http');
    }
}

class NavHttpException extends \Exception {
}
