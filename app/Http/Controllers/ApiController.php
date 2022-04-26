<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rates;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    protected $main_rate = "";
    protected $display_filter_export = "display:none";
    protected $filters;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
    $this->main_rate = "USD";
    $url = 'https://v6.exchangerate-api.com/v6/ac412f0cf047e66083e55b82/latest/'.$this->main_rate;   
    $display_filter_export = $this->display_filter_export;
    $response = file_get_contents($url);
    $newData = json_decode($response);
    $data = Rates::all();
    $filterData = Rates::sortable()->paginate(30);
    $filterJson = Rates::all()->toJson();
    $this->display_filter_export;
    $filters = $this->filters;
   
    if(empty(DB::table('rates')->count())) {
        foreach ($newData->conversion_rates as $key => $value) {
            $newRate = new Rates;
            $newRate->rate = $key;
            $newRate->value = $value;
            $newRate->save();
        }
    }
    
    $id = 1;
    // update
    foreach ($newData->conversion_rates as $key => $value) {
        DB::update('UPDATE rates SET id = ?, rate = ?, value = ? WHERE id = ?', [$id, $key, $value, $id]);
        $id++;
    }
//    dd($filters);
   
    return view('home', compact('data', 'newData', 'filterData', 'filterJson', 'filters')); 
    }


    // Filter
    public function filter(Request $request) {

    $this->main_rate = $request->main_rate;
    if ($this->main_rate == null) $this->main_rate = 'USD';
    
    $url = 'https://v6.exchangerate-api.com/v6/ac412f0cf047e66083e55b82/latest/'.$this->main_rate;
    $response = file_get_contents($url);
    $newData = json_decode($response);
    $data = Rates::all();
    $filters = $request->query('filter');
    
    
    if(empty(DB::table('rates')->count())) {
        foreach ($newData->conversion_rates as $key => $value) {
            $newRate = new Rates;
            $newRate->rate = $key;
            $newRate->value = $value;
            $newRate->save();
        }
    }

    $id = 1;
    $data = Rates::find($id);
    foreach ($data as $key => $value) {
        $newRate = Rates::find($id);
        $newRate->rate = $key;
        $newRate->value = $value;

        $id++;
    }

    if (!empty($filters)) {
        $filterData = Rates::sortable()->where('rate', 'like', '%'.$filters.'%')->paginate(30);
        $this->filters = $filters;

    } else 
        $filterData = Rates::sortable()->paginate(30);
      
        $filterJson = $newData->conversion_rates;
    
    return view('home', compact('filterData', 'filters', 'data', 'newData', 'filterJson'));
   
}

    // Export csv
    public function export (Request $request) {
        $file_name = 'rates.csv';
        $rates = Rates::all();
       
        $handle = fopen($file_name, 'w+');
        fputcsv($handle, array('id', 'rate', 'value'));

        foreach($rates as $row) {
            fputcsv($handle, array($row['id'], $row['rate'], $row['value']));
        }
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
       
        return Response::download($file_name, 'Rates_'. date("d_m_y-h_i_s", time()) .'.csv', $headers);

    }

    // Export csv with filter
    public function export_filter (Request $request, $filter) {
        $file_name = 'rates.csv';    
        $filterData = Rates::sortable()->where('rate', 'like', '%'.$filter.'%')->paginate(30);
        $handle = fopen($file_name, 'w+');
        fputcsv($handle, array('id', 'rate', 'value'));

        foreach($filterData as $row) 
            fputcsv($handle, array($row['id'], $row['rate'], $row['value']));
        
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
       
        return Response::download($file_name, 'Rates_'. date("d_m_y-h_i_s", time()) .'_filtered.csv', $headers);

    }
        

        

}
