<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Dash;
use App\EChannel;
use App\Timeline;
use App\User;

class LiveSearch extends Controller
{
    function index()
    {
     return view('livesearch.live_search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('dashes')
         ->where('first_name', 'like', '%'.$query.'%')
         ->orWhere('second_name', 'like', '%'.$query.'%')
         ->orWhere('last_name', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->orWhere('address', 'like', '%'.$query.'%')
         ->orWhere('nic', 'like', '%'.$query.'%')
         ->orWhere('b_grp', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         
      }
      else
      {
       $data = DB::table('dashes')
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr >
         <td>'.$row->first_name.'</td>
         <td>'.$row->second_name.'</td>
         <td>'.$row->last_name.'</td>
         <td>'.$row->address.'</td>
         <td>'.$row->email.'</td>
         <td>'.$row->nic.'</td>
         <td>'.$row->b_grp.'</td>
         <td>'.$row->m_tp_no.'</td>
         <td><a href="/live_search/'.$row->user_id.'">View More..</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

    public function show($id){
      $users= Dash::all()->where('user_id',$id);
    //   dd($user);
      return view('livesearch.show')->with('users',$users);
     
  }
      public function showtwo($id){
     
        $timeline = Timeline::orderBy('created_at','desc')->where('user_id',$id)->paginate(10); 
        return view('livesearch.showtwo')->with('timeline',$timeline);
      
    
    }

    public function details($id)
    {   
        $timeline = Timeline::find($id); 
        return view('livesearch.details')->with('timeline',$timeline);
       
    }

    public function edit($id)
    {
        $timeline = Timeline::find($id);
        
        return view('livesearch.edit')->with('timeline',$timeline); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate ($request,[
            'title' => 'required',
            'hospital' => 'required',
            'body' => 'required',
            'treatment' => 'required',
            'status' => 'required',
            'file_name'=> 'nullable|max:1999'
        ]);
        if($request->hasFile('file_name')){
            $filenameWithExt = $request->file('file_name')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('file_name')->getClientOriginalExtension();
        
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        
            $path = $request->file('file_name')->storeAs('public/file',$fileNameToStore);
        }

        //creating new timline record
        $post = Timeline::find($id);
        $post -> title = $request->input('title');
        $post -> hospital = $request->input('hospital');
        $post -> body = $request->input('body');
        $post -> treatment = $request->input('treatment');
        $post -> status = $request->input('status');
        $post -> file_title = $request->input('file_title');
        if($request->hasFile('file_name')){
        $post -> file_name = $fileNameToStore;
        }
        $post -> save();

        return redirect('/live_search')->with('success','Timeline Event Updated');

    }

    public function create($id)
    {
        
        $timeline = User::find($id);
        // dd($timeline);
        return view('livesearch.create')->with('timeline',$timeline); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this -> validate ($request,[
            'title' => 'required',
            'hospital' => 'required',
            'body' => 'required',
            'treatment' => 'required', 
            'status' => 'required',
            'file_name'=> 'nullable|max:1999'
        ]);

        if($request->hasFile('file_name')){
            $filenameWithExt = $request->file('file_name')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('file_name')->getClientOriginalExtension();
        
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        
            $path = $request->file('file_name')->storeAs('public/file',$fileNameToStore);
        }else{
            $fileNameToStore = 'No.pdf';
        }

        //creating new timline record
        $post = new Timeline;
        $post -> title = $request->input('title');
        $post -> hospital = $request->input('hospital');
        $post -> body = $request->input('body');
        $post -> treatment = $request->input('treatment');
        $post -> status = $request->input('status');
        $post -> file_title = $request->input('file_title');
        $post -> file_name = $fileNameToStore;
        $post -> user_id = $id;
        $post -> save();


       
        return redirect('/live_search')->with('success','Timeline Event Added');
       

    }
}
